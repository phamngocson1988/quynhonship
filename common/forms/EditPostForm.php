<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Post;
use common\models\PostImage;
use common\models\PostCategory;
use common\models\PostContact;
use yii\helpers\ArrayHelper;

/**
 * UpdatePostForm is the model behind the contact form.
 */
class UpdatePostForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $organization;
    public $location_id;
    public $category_id;
    public $avatar;
    public $image = [];
    public $contact_name;
    public $contact_phone;
    public $contact_email;
    public $contact_facebook;

    private $_post;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content', 'category_id', 'location_id', 'contact_name', 'contact_phone'], 'required'],
            ['id', 'validatePost'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['id', 'title', 'content', 'organization', 'location_id', 'category_id', 'avatar', 'image', 'contact_name', 'contact_phone', 'contact_email', 'contact_facebook'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            try {
                $this->initPost();
                return $this->update();
            } catch (Exception $e) {

            }
        }
    }

    protected function update()
    {
        $transaction = Yii::$app->db->beginTransaction();
        $post = $this->getPost();
        try {
            $post->save();

            // Post Images
            $postImages = $post->postImages;
            $mainImageKey = 0;
            foreach ($postImages as $key => $postImage) {
                if ($postImage->is_main == PostImage::MAIN) {
                    $mainImageKey = $key;
                    // Main image
                    if ($this->avatar != $postImage->image_id) {
                        $postImage->image_id = $this->avatar;
                        $postImage->save();
                    }
                    break;
                }
            }
            unset($postImages[$mainImageKey]);
            $postImageIds = ArrayHelper::getColumn($postImages, 'image_id');
            $newPostImageIds = array_diff($this->getImage(), $postImageIds);
            $removePostImageIds = array_diff($postImageIds, $this->getImage());
            foreach ($newPostImageIds as $newPostImageId) {
                $mainImage = new PostImage();
                $mainImage->post_id = $post->id;
                $mainImage->image_id = $newPostImageId;
                $mainImage->save();
            }
            if (!empty($removePostImageIds)) {
                PostImage::deleteAll(['post_id' => $post->id, 'image_id' => $removePostImageIds]);
            }

            $transaction->commit();
            return true;
        } catch (Exception $e) {
            $transaction->rollBack();                
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }


    protected function initPost()
    {
        $post = $this->getPost();
        
        $post->title = $this->title;
        $post->content = $this->content;
        $post->organization = ($this->organization) ? Post::ORGANIZATION_COMPANY : Post::ORGANIZATION_PERSON;
        $post->location_id = $this->location_id;
        $post->category_id = $this->category_id;
        $post->updated_at = strtotime('now');
        $post->contact_name = $this->contact_name;
        $post->contact_phone = $this->contact_phone;
        $post->contact_email = $this->contact_email;
        $post->contact_facebook = $this->contact_facebook;
        $this->_post = $post;
    }

    public function loadPostData($id) 
    {
        $this->id = $id;
        $post = $this->getPost();
        $this->title = $post->title;
        $this->content = $post->content;
        $this->avatar = $post->getAvatarImage();
        $this->image = $post->getGallery();
        $this->organization = ($post->organization) ? Post::ORGANIZATION_COMPANY : Post::ORGANIZATION_PERSON;
        $this->location_id = $post->location_id;
        $this->category_id = $post->category_id;
        $this->contact_name = $post->contact_name;
        $this->contact_phone = $post->contact_phone;
        $this->contact_email = $post->contact_email;
        $this->contact_facebook = $post->contact_facebook;
    }

    public function validatePost($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $post = $this->getPost();
            if (!$post) {
                $this->addError($attribute, 'Invalid post.');
            } elseif ($post->getUserId() != Yii::$app->user->id) {
                $this->addError($attribute, 'Invalid post.');
            }
        }
    }

    public function getPost()
    {
        if ($this->_post === null) {
            $this->_post = Post::findOne($this->id);
        }

        return $this->_post;
    }

    protected function getImage()
    {
        return (array)$this->image;
    }

}

<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Post;
use common\forms\FetchCategoryForm;
use yii\helpers\ArrayHelper;

/**
 * EditPostForm
 */
class EditPostForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $category_id;
    public $image_id;
    public $status;

    private $_post;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content'], 'required'],
            ['id', 'validatePost'],
            ['status', 'default', 'value' => Post::STATUS_VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['id', 'title', 'content', 'category_id', 'image_id', 'status'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $post = $this->getPost();
            try {
                $post->title = $this->title;
                $post->content = $this->content;
                $post->category_id = $this->category_id;
                $post->image_id = $this->image_id;
                $result = $post->save();
                $transaction->commit();
                return $result;
            } catch (Exception $e) {
                $transaction->rollBack();                
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    protected function getPost()
    {
        if ($this->_post === null) {
            $this->_post = Post::findOne($this->id);
        }

        return $this->_post;
    }

    public function loadData($id)
    {
        $this->id = $id;
        $post = $this->getPost();
        $this->title = $post->title;
        $this->content = $post->content;
        $this->category_id = $post->category_id;
        $this->image_id = $post->image_id;
        $this->status = $post->status;
    }

    public function validatePost($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $post = $this->getPost();
            if (!$post) {
                $this->addError($attribute, 'Invalid user.');
            }
        }
    }

    public function getCategories()
    {
        $fetchCategoryForm = new FetchCategoryForm();
        $categories = $fetchCategoryForm->fetch();

        return ArrayHelper::map($categories, 'id', 'name');
    }

    public function hasImage()
    {
        $post = $this->getPost();
        return $post->image;
    }
    public function getImageUrl($size)
    {
        $post = $this->getPost();
        return $post->getImageUrl($size, '');
    }
}

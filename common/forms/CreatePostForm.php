<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Post;
use common\forms\FetchCategoryForm;
use yii\helpers\ArrayHelper;

/**
 * CreatePostForm
 */
class CreatePostForm extends Model
{
    public $title;
    public $content;
    public $category_id;
    public $image_id;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            ['status', 'default', 'value' => Post::STATUS_VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['title', 'content', 'category_id', 'image_id', 'status'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $post = $this->getPost();
            try {
                $post->save();
                $newId = $post->id;
                $transaction->commit();
                return $newId;
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
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->category_id = $this->category_id;
        $post->image_id = $this->image_id;
        $post->created_by = Yii::$app->user->id;
        $post->created_at = strtotime('now');
        $post->updated_at = strtotime('now');
        $post->status = $this->status;
        return $post;
    }

    public function getCategories()
    {
        $fetchCategoryForm = new FetchCategoryForm();
        $categories = $fetchCategoryForm->fetch();

        return ArrayHelper::map($categories, 'id', 'name');
    }
}

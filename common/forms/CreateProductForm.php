<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Product;
use common\models\ProductImage;
use yii\helpers\ArrayHelper;
use common\forms\FetchCategoryForm;

/**
 * CreateProductForm
 */
class CreateProductForm extends Model
{
    public $title;
    public $content;
    public $category_id;
    public $image_id;
    public $delivery_time;
    public $delivery_condition;
    public $price;
    public $status;
    public $gallery = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            ['status', 'default', 'value' => Product::STATUS_VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['title', 'content', 'category_id', 'image_id', 'delivery_time', 'delivery_condition', 'price', 'status', 'gallery'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $product = $this->getProduct();
            try {
                $product->save();
                $newId = $product->id;

                foreach ($this->getGallery() as $key => $imageId) {
                    $productImage = new ProductImage();
                    $productImage->image_id = $imageId;
                    $productImage->product_id = $newId;
                    $productImage->save();
                }
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

    protected function getProduct()
    {
        $product = new Product();
        $product->title = $this->title;
        $product->content = $this->content;
        $product->category_id = $this->category_id;
        $product->image_id = $this->image_id;
        $product->delivery_time = $this->delivery_time;
        $product->delivery_condition = $this->delivery_condition;
        $product->price = $this->price;
        $product->created_by = Yii::$app->user->id;
        $product->created_at = strtotime('now');
        $product->updated_at = strtotime('now');
        $product->status = $this->status;
        return $product;
    }

    public function getGallery()
    {
        $gallery = (array)$this->gallery;
        return array_filter($gallery);
    }

    public function getCategories()
    {
        $fetchCategoryForm = new FetchCategoryForm();
        $categories = $fetchCategoryForm->fetch();

        return ArrayHelper::map($categories, 'id', 'name');
    }
}

<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\Product;
use common\models\ProductImage;
use common\forms\FetchCategoryForm;
use yii\helpers\ArrayHelper;

/**
 * EditProductForm
 */
class EditProductForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $category_id;
    public $image_id;
    public $delivery_time;
    public $delivery_condition;
    public $price;
    public $status;
    public $gallery = [];

    private $_product;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content'], 'required'],
            ['id', 'validateProduct'],
            ['status', 'default', 'value' => Product::STATUS_VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['id', 'title', 'content', 'category_id', 'image_id', 'delivery_time', 'delivery_condition', 'price', 'status', 'gallery'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $product = $this->getProduct();
            try {
                $product->title = $this->title;
                $product->content = $this->content;
                $product->category_id = $this->category_id;
                $product->image_id = $this->image_id;
                $result = $product->save();

                ProductImage::DeleteAll(['product_id' => $product->id]);
                foreach ($this->getGallery() as $key => $imageId) {
                    $productImage = new ProductImage();
                    $productImage->image_id = $imageId;
                    $productImage->product_id = $product->id;
                    $productImage->save();
                }

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

    protected function getProduct()
    {
        if ($this->_product === null) {
            $this->_product = Product::findOne($this->id);
        }

        return $this->_product;
    }

    public function loadData($id)
    {
        $this->id = $id;
        $product = $this->getProduct();
        $this->title = $product->title;
        $this->content = $product->content;
        $this->category_id = $product->category_id;
        $this->image_id = $product->image_id;
        $this->delivery_time = $product->delivery_time;
        $this->delivery_condition = $product->delivery_condition;
        $this->price = $product->price;
        $this->status = $product->status;
    }

    public function validateProduct($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $product = $this->getProduct();
            if (!$product) {
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
        $product = $this->getProduct();
        return $product->image;
    }
    public function getImageUrl($size)
    {
        $product = $this->getProduct();
        return $product->getImageUrl($size, '');
    }

    public function getGallery()
    {
        $gallery = (array)$this->gallery;
        return array_filter($gallery);
    }

    public function getGalleryImages()
    {
        $product = $this->getProduct();
        return $product->gallery;
    }
}

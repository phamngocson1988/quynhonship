<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Category;
use common\models\User;

/**
 * Product model
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $category_id
 * @property integer $image_id
 * @property integer $delivery_time
 * @property string $delivery_condition
 * @property integer $price
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 */
class Product extends ActiveRecord
{
	const STATUS_INVISIBLE = 0;
    const STATUS_VISIBLE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_INVISIBLE => 'Invisible',
            self::STATUS_VISIBLE => 'Visible'
        ];
    }

    public function getCategory() 
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryName()
    {
        $category = $this->category;
        if ($category) {
            return $category->name;
        }
        return '';
    }

    public function getImage() 
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    public function getImageUrl($size = null, $default = '')
    {
        $image = $this->image;
        if ($image) {
            return $image->getUrl($size);
        }
        return $default;
    }

    public function getCreatedAt($format = false)
    {
        if ($format == true) {
            return date(Yii::$app->params['date_format'], $this->created_at);
        }
        return $this->created_at;
    }

    public function getUpdatedAt($format = false)
    {
        if ($format == true) {
            return date(Yii::$app->params['date_format'], $this->updated_at);
        }
        return $this->updated_at;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUserName()
    {
        $user = $this->user;
        if ($user) {
            return $user->name;
        }
        return '';
    }

    public function getGallery()
    {
        return $this->hasMany(Image::className(), ['id' => 'image_id'])
            ->viaTable(ProductImage::tableName(), ['product_id' => 'id']);
    }
}

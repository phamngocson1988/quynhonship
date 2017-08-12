<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Product;
use common\models\ProductCategory;

/**
 * Location model
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $parent_id
 * @property integer $visible
 */
class Location extends ActiveRecord
{
    const INVISIBLE = 0;
    const VISIBLE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%location}}';
    }

    public function getPosts()
    {
    	return $this->hasMany(Product::className(), ['id' => 'post_id'])
            ->viaTable(ProductCategory::tableName(), ['location_id' => 'id']);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getParentName()
    {
        $obj = $this->parent;
        if ($obj) {
            return $obj->name;
        }
    }

    public function getVisible()
    {
        return (int)$this->visible;
    }

    public function isVisible()
    {
        return $this->getVisible() === self::VISIBLE;
    }
}

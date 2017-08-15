<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Product;
use common\models\ProductCategory;

/**
 * Category model
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $parent_id
 * @property integer $visible
 */
class Category extends ActiveRecord
{
    const INVISIBLE = 0;
    const VISIBLE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    public function getPosts()
    {
    	return $this->hasMany(Product::className(), ['id' => 'post_id'])
            ->viaTable(ProductCategory::tableName(), ['category_id' => 'id']);
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

    public function isVisible()
    {
        return $this->visible === self::VISIBLE;
    }
}

<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\Category;
use common\components\helpers\StringHelper;
use yii\helpers\ArrayHelper;

/**
 * CreateCategoryForm is the model behind the contact form.
 */
class CreateCategoryForm extends Model
{
    public $name;
    public $parent_id;
    public $slug;
    public $visible;

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            ['slug', 'validateSlug'],
            ['visible', 'default', 'value' => Category::VISIBLE],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['name', 'parent_id', 'slug', 'visible'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            try {
                $category = new Category();
                $category->name = $this->name;
                $category->slug = $this->slug;
                $category->parent_id = $this->parent_id;
                $category->visible = $this->visible;
                return $category->save();
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

    public function validateSlug($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $slug = $this->$attribute;
            if (!preg_match('/^[a-z][-a-z0-9]*$/', $slug)) {
                $this->addError($attribute, "$slug does not match slug format!");
            }

            if (Category::find()->where(['slug' => $slug])->count() > 0) {
                $this->addError($attribute, "$slug already existed!");
            }
        }
    }

    public function getAvailableParent()
    {
        $locations = Category::find()->all();
        $locations = ArrayHelper::map($locations, 'id', 'name');
        return $locations;
    }
}

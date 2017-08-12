<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\Category;
use common\components\helpers\StringHelper;
use yii\helpers\ArrayHelper;

/**
 * EditCategoryForm is the model behind the contact form.
 */
class EditCategoryForm extends Model
{
    public $id;
    public $name;
    public $parent_id;
    public $slug;
    public $visible;

    private $_category;

    public function rules()
    {
        return [
            [['id', 'name', 'slug'], 'required'],
            ['slug', 'validateSlug'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_DEFAULT] = ['id', 'name', 'parent_id', 'slug', 'visible'];
        return $scenarios;
    }

    public function save()
    {
        if ($this->validate()) {
            try {
                $category = $this->getCategory();
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

            if (Category::find()->where(['slug' => $slug])->count() > 1) {
                $this->addError($attribute, "$slug already existed!");
            }
        }
    }

    public function loadData($id)
    {
        $this->id = $id;
        $category = $this->getCategory();
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->parent_id = $category->parent_id;
        $this->visible = $category->visible;
    }

    protected function getCategory()
    {
        if ($this->_category === null) {
            $this->_category = Category::findOne($this->id);
        }

        return $this->_category;
    }

    public function getAvailableParent()
    {
        $locations = Category::find()->all();
        $locations = ArrayHelper::map($locations, 'id', 'name');
        unset($locations[$this->id]);
        return $locations;
    }
}

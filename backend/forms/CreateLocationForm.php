<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\Location;
use common\components\helpers\StringHelper;
use yii\helpers\ArrayHelper;

/**
 * CreateLocationForm is the model behind the contact form.
 */
class CreateLocationForm extends Model
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
            ['visible', 'default', 'value' => Location::VISIBLE],
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
                $location = new Location();
                $location->name = $this->name;
                $location->slug = $this->slug;
                $location->parent_id = $this->parent_id;
                $location->visible = $this->visible;
                return $location->save();
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

            if (Location::find()->where(['slug' => $slug])->count() > 0) {
                $this->addError($attribute, "$slug already existed!");
            }
        }
    }

    public function getAvailableParent()
    {
        $locations = Location::find()->all();
        $locations = ArrayHelper::map($locations, 'id', 'name');
        return $locations;
    }
}

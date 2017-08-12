<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\Location;
use common\components\helpers\StringHelper;
use yii\helpers\ArrayHelper;


/**
 * EditLocationForm is the model behind the contact form.
 */
class EditLocationForm extends Model
{
    public $id;
    public $name;
    public $parent_id;
    public $slug;
    public $visible;

    private $_location;

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
                $location = $this->getLocation();
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

            if (Location::find()->where(['slug' => $slug])->count() > 1) {
                $this->addError($attribute, "$slug already existed!");
            }
        }
    }

    public function loadData($id)
    {
        $this->id = $id;
        $location = $this->getLocation();
        $this->name = $location->name;
        $this->slug = $location->slug;
        $this->parent_id = $location->parent_id;
        $this->visible = $location->visible;
    }

    protected function getLocation()
    {
        if ($this->_location === null) {
            $this->_location = Location::findOne($this->id);
        }

        return $this->_location;
    }

    public function getAvailableParent()
    {
        $locations = Location::find()->all();
        $locations = ArrayHelper::map($locations, 'id', 'name');
        unset($locations[$this->id]);
        return $locations;
    }
}

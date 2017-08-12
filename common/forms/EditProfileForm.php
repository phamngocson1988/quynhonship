<?php
namespace common\forms;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * EditProfileForm form
 */
class EditProfileForm extends Model
{
    public $username;
    public $email;
    public $name;
    public $phone;
    public $address;
    public $gender;
    public $year_of_birth;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 3, 'max' => 255],

            ['phone', 'trim'],
            ['phone', 'required'],

            [['address', 'gender', 'year_of_birth', 'username', 'email'], 'trim'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = $this->getUser();
        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->gender = $this->gender;
        $user->address = $this->address;
        $user->year_of_birth = $this->year_of_birth;
        $result = $user->save() ? $user : null;
        return $result;
    }

    protected function getUser()
    {
        return Yii::$app->user->getIdentity();
    }

    public function loadData()
    {
        $user = $this->getUser();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->address = $user->address;
        $this->year_of_birth = $user->year_of_birth;
    }

    public function getAvailableGender()
    {
        return User::getAvailableGender();
    }
}

<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\ArrayHelper;
/**
 * ChangeUserRoleForm is the model behind the contact form.
 */
class ChangeUserRoleForm extends Model
{
	
    public $id;
    public $name;
    public $role;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['role', 'trim'],
            ['id', 'required'],
            ['id', 'validateUser']
        ];
    }

    public function changeRole()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $auth = Yii::$app->authManager;
            $roles = $auth->getRolesByUser($user->id);
            if (!array_key_exists($this->role, $roles)) {
                foreach ($roles as $role) {
                    $auth->revoke($role, $user->id);
                }

                if ($this->role) {
                    $newRole = $auth->getRole($this->role);
                    $auth->assign($newRole, $user->id);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function validateUser($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, 'Invalid user.');
            }
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findIdentity($this->id);
        }

        return $this->_user;
    }




	public function getAvailableRoles()
	{
		$auth = Yii::$app->authManager;
		$roles = $auth->getRoles();
		$names = ArrayHelper::map($roles, 'name', 'description');
		return $names;
	}

    public function loadData($id)
    {
    	$this->id = $id;
        $user = $this->getUser();
        $this->name = $user->name;
        $roles = $user->getRoles();
        if (!empty($roles)) {
            $this->role = key($roles);
        }
    }
}

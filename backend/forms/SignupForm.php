<?php

namespace backend\forms;

use Yii;
use yii\base\Model;
use common\models\User;
use common\forms\SignupForm as BaseSignupForm;
use yii\helpers\ArrayHelper;
/**
 * InsertStaffForm is the model behind the contact form.
 */
class SignupForm extends BaseSignupForm
{
	public $role;

	public function getAvailableRoles()
	{
		$auth = Yii::$app->authManager;
		$roles = $auth->getRoles();
		$names = ArrayHelper::map($roles, 'name', 'description');
		return $names;
	}

    public function signup()
    {
    	$user = parent::signup();
    	if ($user) {
    		if ($this->role) {
    			$auth = Yii::$app->authManager;
    			$role = $auth->getRole($this->role);
    			if ($role) {
		            $auth->assign($role, $user->id);
		        }
    		}
    	}
    	return $user;
    }
}

<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;
use yii\base\InvalidParamException;

/*
 * Need to run this commandline first
 * yii migrate --migrationPath=@yii/rbac/migrations
 */
class RbacController extends Controller
{
    /**
     * Create all default roles and permissions of the system
     * [Roles]
     * Root: Biggest role. It can do everything and manage role/permission
     * Admin: Can do everything in system without role/permission
     * User Manager: Manage user
     * Content Manager: Manage content
     *
     * [Permissions]
     * 
     * yii rbac/init
     */
    public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // Role: root
        $root = $auth->createRole('root');
        $root->description = 'Root Admin';
        $auth->add($root);

        // Role: admin
        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $auth->add($admin);

        $auth->addChild($root, $admin);

        // Init the first user
        $auth->assign($root, 1);
    }

    /**
     * yii rbac/assign $userId $roleName
     */
    public function actionAssign($userId, $roleName)
    {
        if (!$this->confirm("Are you sure?")) {
            return self::EXIT_CODE_NORMAL;
        }
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);
        if ($role) {
            $auth->assign($role, $userId);
        }
        
    }
}
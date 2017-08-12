<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\forms\FetchUserForm;
use backend\forms\SignupForm;
use backend\forms\ChangeUserRoleForm;

use yii\data\Pagination;
use yii\helpers\Url;
use common\forms\UpdateProfileForm;
use common\forms\ChangePasswordForm;
use common\forms\ChangeAvatarForm;
use yii\web\Response;
use common\forms\FetchPostForm;

/**
 * UserController
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Show the list of posts
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $form = new FetchUserForm();
        $models = $form->fetch();
        $total = $form->count();
        $pages = new Pagination(['totalCount' => $total]);
        return $this->render('index.tpl', [
            'models' => $models,
            'pages' => $pages
        ]);
    }

    public function actionCreate()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $this->redirect(['user/create']);
            }
        }

        return $this->render('create.tpl', [
            'model' => $model,
        ]);

    }

    public function actionEdit($id)
    {
        $model = new ChangeUserRoleForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->changeRole()) {
                return $this->redirect(['user/index']);
            }
        } else {
            $model->loadData($id);
        }

        return $this->render('edit.tpl', [
            'model' => $model,
        ]);

    }
}

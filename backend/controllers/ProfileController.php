<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use common\forms\EditProfileForm;
use common\forms\ChangePasswordForm;
use common\forms\ChangeAvatarForm;

/**
 * ProfileController
 */
class ProfileController extends Controller
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     *
     * @return string
     */
    public function actionIndex()
    {
        
        $user = Yii::$app->user->getIdentity();
        $links = [
            'change_avatar' => Url::to(['profile/change-avatar']),
            'password' => Url::to(['profile/password']),
            'edit' => Url::to(['profile/edit']),
            'upload_image' => Url::to(['image/ajax-upload']),
        ];
        $this->view->registerJsFile('@web/js/ajax_action.js', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
        return $this->render('index.tpl', [
            'user' => $user,
            'links' => $links
        ]);
    }


    public function actionEdit()
    {
        $request = Yii::$app->request;
        $post = $request->post();
        $profile = new EditProfileForm();
        if ($profile->load($post)) { 
            $profile->save();
            $profile->username = Yii::$app->user->getIdentity()->username;
            $profile->email = Yii::$app->user->getIdentity()->email;
        } else {
            $profile->loadData();
        }
        return $this->render('edit.tpl', ['model' => $profile]);
    }

    public function actionPassword()
    {
        $request = Yii::$app->request;

        $post = $request->post();
        $model = new ChangePasswordForm();
        
        if ($model->load($post) && $model->change()) {
            // Reset form change password
            $model = new ChangePasswordForm();
        }

        return $this->render('password.tpl', ['model' => $model]);
    }

    public function actionChangeAvatar()
    {
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            return;
        }

        $imageId = $request->post('image_id');
        $model = new ChangeAvatarForm([
            'image_id' => $imageId
        ]);
        
        return $this->renderJson($model->change(), [], $model->getErrors());
    }

}

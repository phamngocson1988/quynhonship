<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\AccessControl;
use common\forms\FetchLocationForm;
use backend\forms\CreateLocationForm;
use backend\forms\EditLocationForm;

/**
 * LocationController
 */
class LocationController extends Controller
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
        $form = new FetchLocationForm();
        $models = $form->fetch();
        return $this->render('index.tpl', [
            'models' => $models,
        ]);
    }

    public function actionEdit($id)
    {
        $model = new EditLocationForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->redirect(['location/index']);
            }
        } else {
            $model->loadData($id);
        }

        $this->view->registerJsFile(
            'vendors/iCheck/icheck.min.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );

        $this->view->registerCssFile(
            'vendors/iCheck/skins/flat/green.css',
            ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
        );

        return $this->render('edit.tpl', [
            'model' => $model,
        ]);

    }

    public function actionCreate()
    {
        $model = new CreateLocationForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->redirect(['location/index']);
            }
        }

        $this->view->registerJsFile(
            'vendors/iCheck/icheck.min.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );

        $this->view->registerCssFile(
            'vendors/iCheck/skins/flat/green.css',
            ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
        );

        return $this->render('create.tpl', [
            'model' => $model,
        ]);
    }
}

<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\AccessControl;
use common\forms\FetchCategoryForm;
use backend\forms\CreateCategoryForm;
use backend\forms\EditCategoryForm;

/**
 * CategoryController
 */
class CategoryController extends Controller
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
        $form = new FetchCategoryForm();
        $models = $form->fetch();
        return $this->render('index.tpl', [
            'models' => $models,
        ]);
    }

    public function actionEdit($id)
    {
        $model = new EditCategoryForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->redirect(['category/index']);
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
        $model = new CreateCategoryForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->redirect(['category/index']);
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

<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\forms\FetchProductForm;
use common\forms\CreateProductForm;
use common\forms\EditProductForm;

/**
 * ProductController
 */
class ProductController extends Controller
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
     * Show the list of products
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $form = new FetchProductForm();
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
        $this->view->registerJsFile('@web/js/ckeditor/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/iCheck/icheck.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerCssFile('@web/vendors/iCheck/skins/flat/green.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
        $this->view->registerJsFile('@web/js/ajax_action.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/jquery.tagsinput/src/jquery.tagsinput.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/jquery.autocomplete/src/jquery.autocomplete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $model = new CreateProductForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['product/index']);
            }
        }

        return $this->render('create.tpl', [
            'model' => $model
        ]);
    }

    public function actionEdit($id)
    {
        $this->view->registerJsFile('@web/js/ckeditor/ckeditor.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/iCheck/icheck.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerCssFile('@web/vendors/iCheck/skins/flat/green.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
        $this->view->registerJsFile('@web/js/ajax_action.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/jquery.tagsinput/src/jquery.tagsinput.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/jquery.autocomplete/src/jquery.autocomplete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

        $model = new EditProductForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['product/index']);
            }
        } else {
            $model->loadData($id);
        }

        return $this->render('edit.tpl', [
            'model' => $model
        ]);
    }
}

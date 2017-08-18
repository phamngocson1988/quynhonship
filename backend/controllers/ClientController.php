<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\forms\FetchClientForm;
use common\forms\CreateClientForm;
use common\forms\EditClientForm;

/**
 * ClientController
 */
class ClientController extends Controller
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
     * Show the list of clients
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $form = new FetchClientForm();
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
        $model = new CreateClientForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['client/index']);
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

        $model = new EditClientForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['client/index']);
            }
        } else {
            $model->loadData($id);
        }

        return $this->render('edit.tpl', [
            'model' => $model
        ]);
    }
}

<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\AccessControl;
use yii\data\Pagination;
use common\forms\FetchPostForm;
use common\forms\CreatePostForm;
use common\forms\EditPostForm;

/**
 * PostController
 */
class PostController extends Controller
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
        $form = new FetchPostForm();
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
        $this->view->registerJsFile(
            '@web/js/ckeditor/ckeditor.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );

        $this->view->registerJsFile(
            '@web/vendors/iCheck/icheck.min.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );

        $this->view->registerCssFile(
            '@web/vendors/iCheck/skins/flat/green.css',
            ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
        );

        $this->view->registerJsFile('@web/js/ajax_action.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/jquery.tagsinput/src/jquery.tagsinput.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $this->view->registerJsFile('@web/vendors/jquery.autocomplete/src/jquery.autocomplete.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
        $model = new CreatePostForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['post/index']);
            }
        }

        return $this->render('create.tpl', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id)
    {
        $this->view->registerJsFile(
            '@web/js/ckeditor/ckeditor.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );

        $this->view->registerJsFile(
            'vendors/iCheck/icheck.min.js',
            ['depends' => [\yii\web\JqueryAsset::className()]]
        );

        $this->view->registerCssFile(
            'vendors/iCheck/skins/flat/green.css',
            ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]
        );

        $this->view->registerJsFile('js/uploadimage.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

        $fetchCategoryForm = new FetchCategoryForm();
        $categories = $fetchCategoryForm->fetch();

        $fetchLocationForm = new FetchLocationForm();
        $locations = $fetchLocationForm->fetch();

        $model = new UpdatePostForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['post/index']);
            }
        } else {
            $model->loadPostData($id);
        }

        return $this->render('update.tpl', [
            'model' => $model,
            'categories' => $categories,
            'locations' => $locations
        ]);
    }
}

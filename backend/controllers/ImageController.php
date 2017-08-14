<?php
namespace backend\controllers;

use Yii;
use common\components\override\Controller;
use yii\filters\AccessControl;
use common\forms\FetchImageForm;
use yii\helpers\Url;
use common\forms\UploadImageForm;
use yii\web\UploadedFile;
use common\forms\DeleteImageForm;

/**
 * ImageController
 */
class ImageController extends Controller
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

    public function actionIndex()
    {
        $request = Yii::$app->request;
        
        $links = [
            'ajax_load' => Url::to(['image/ajax-load']),
            'image_popup' => Url::to(['image/popup']),
        ];
        $this->view->registerJsFile('@web/js/ajax_action.js', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
        return $this->render('index.tpl', ['links'=> $links]);
    }    

    public function actionAjaxLoad()
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            $offset = $request->get('offset', 1);
            $limit = $request->get('limit', 8);
            $data = [
                'offset' => $offset,
                'limit' => $limit
            ];
            $form = new FetchImageForm($data);
            $models = $form->fetch();
            $total = $form->count();
            $html = "";
            $template = $request->get('template', '_item');
            foreach ($models as $model) {
                $html .= $this->renderPartial("$template.tpl",['model' => $model]);
            }
            $data = [
                'items' => $html,
                'total' => $total
            ];
            return $this->renderJson(true, $data);
        }
    }    

    public function actionUpload()
    {
        $this->view->registerCssFile('vendors/dropzone/dist/min/dropzone.min.css', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
        $this->view->registerJsFile('vendors/dropzone/dist/min/dropzone.min.js', ['depends' => [\yii\bootstrap\BootstrapAsset::className()]]);
        return $this->render('upload.tpl');
    }

    public function actionAjaxUpload()
    {
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            return;
        }
        $model = new UploadImageForm();
        $attribute = $request->post('name', 'imageFiles');
        $model->imageFiles = UploadedFile::getInstancesByName($attribute);
        $result = false;
        $data = [];
        $errors = [];
        if ($model->validate() && $model->upload()) {
            $result = true;
            if ($request->post('review_width') && $request->post('review_height')) {
                $images = $model->getImages();
                $size = sprintf("%sx%s", $request->post('review_width'), $request->post('review_height'));

                $imageArray = [];
                foreach ($images as  $image) {
                    $info = [];
                    $info['id'] = $imageId = $image->getId();
                    $info['thumb'] = $image->getUrl($size);
                    $info['src'] = $image->getUrl();
                    foreach (Yii::$app->params['thumbnails'] as $thumbnail) {
                        $info['size'][$thumbnail] = $image->getUrl($thumbnail);
                    }
                    $imageArray[$imageId] = $info;
                }

                $data = $imageArray;
            }
        } else {
            $errors = $model->getErrors();
        }
        
        return $this->renderJson($result, $data, $errors);
    }

    public function actionAjaxDelete($id)
    {
        $request = Yii::$app->request;
        if (!$request->isAjax) {
            return;
        }
        $model = new DeleteImageForm(['id' => $id]);
        
        if ($model->delete()) {
            $result['status'] = true;
        } else {
            $result['status'] = false;
            $result['error'] = $model->getErrors();
        }
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionPopup()
    {
        $request = Yii::$app->request;
        $result = ['status' => false];
        $defaultThumbnail = '150x150';
        return $this->renderPartial('popup.tpl', ['default_thumbnail' => $defaultThumbnail]);
    }
}

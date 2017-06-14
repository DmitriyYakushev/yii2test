<?php

namespace backend\controllers;

use common\components\pinxter\CImageHandler;
use common\models\Region;
use common\models\Setting;
use Yii;
use yii\helpers\Json;
use yii\web\HttpException;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class AjaxController extends BaseController
{
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        if (!Yii::$app->request->isAjax) {
            throw new HttpException(400, 'Ajax only');
        }
        return parent::beforeAction($action);
    }

    public function actionSimpleImage()
    {
        $file = UploadedFile::getInstanceByName('file');

        $availableExtensions = ['jpg', 'jpeg', 'png'];

        if (!in_array(strtolower($file->getExtension()), $availableExtensions)) {
            return Json::encode(['error' => 'It is not image']);
        }

        $fName = uniqid() . '.' . $file->getExtension();

        $res = Yii::$app->upload->uploadFile($fName, $file->tempName);

        if (empty($res['url']) || empty($res['storage_item_id'])) {
            throw new HttpException(500, 'Storage error');
        }

        return Json::encode([
            'url'   => $res['url'],
            'error' => false,
        ]);
    }
}

<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\generated\News as Model;
use \keygenqt\breadcrumbsPanel\BreadcrumbsPanel;
use \dosamigos\switchinput\SwitchBox;
use backend\widgets\Alert;
use \backend\helpers\Helper;

/**
 * @var yii\web\View $this
 * @var Model $model
 */

$this->title = ($model->isNewRecord ? 'Create' : 'Update') . ' news';

BreadcrumbsPanel::setParams([
    [
        'label' => 'News',
        'url'   => ['news/index']
    ], [
        'label' => $this->title
    ],
], 'fa fa-newspaper-o');

echo Alert::widget();

$form = ActiveForm::begin(Helper::getFormParams());

echo $form->field($model, 'title');
echo $form->field($model, 'description');
echo $form->field($model, 'text')->textarea();
echo $form->field($model, 'img_url');
echo $form->field($model, 'news_date')->widget(\keygenqt\datePicker\DatePicker::className(), ['dateFormat' => 'php:j-M-Y']);
echo $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::getColumn(
    \yii\helpers\ArrayHelper::index(
        \common\models\Users::find()->select(['user_id', 'user_fname', 'user_lname'])->asArray()->all(),
        'user_id'
    ),
    function ($value) {
        return $value['user_fname'] . ' ' . $value['user_lname'];
    }
)
);

echo Html::tag('div', Html::submitButton('Save', ['class' => 'btn btn-success']), ['class' => 'form-save']);

ActiveForm::end();



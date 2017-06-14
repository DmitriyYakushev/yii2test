<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\News as Model;
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

echo $form->field($model, 'news_title');
echo $form->field($model, 'news_text')->textarea();
echo $form->field($model, 'news_link');
echo $form->field($model, 'news_image')->widget(keygenqt\imageAjax\ImageAjax::className(), [
    'url' => ['ajax/simple-image']
]);
echo $form->field($model, 'news_video');
echo $form->field($model, 'news_video_code');
echo $form->field($model, 'news_type')->dropDownList(Model::getTypes());
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

echo $form->field($model, 'news_status')->widget(SwitchBox::className(), [
    'clientOptions' => [
        'inverse'  => true,
        'size'     => 'normal',
        'onColor'  => 'success',
        'offColor' => 'danger',
        'onText'   => 'ON',
        'offText'  => 'OFF'
    ]
]);

echo Html::tag('div', Html::submitButton('Save', ['class' => 'btn btn-success']), ['class' => 'form-save']);

ActiveForm::end();



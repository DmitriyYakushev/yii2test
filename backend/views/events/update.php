<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Events as Model;
use keygenqt\breadcrumbsPanel\BreadcrumbsPanel;
use dosamigos\switchinput\SwitchBox;
use backend\widgets\Alert;
use backend\helpers\Helper;
use kartik\datetime\DateTimePicker;
use keygenqt\imageAjax\ImageAjax;
use yii\helpers\ArrayHelper;
use common\models\EventCategories;

/**
 * @var yii\web\View $this
 * @var Model $model
 */

$this->title = ($model->isNewRecord ? 'Create' : 'Update') . ' event';

BreadcrumbsPanel::setParams([
    [
        'label' => 'Events',
        'url'   => ['events/index']
    ], [
        'label' => $this->title
    ],
], 'fa fa-leaf');

echo Alert::widget();

$form = ActiveForm::begin(Helper::getFormParams());

echo $form->field($model, 'event_title');
echo $form->field($model, 'event_description')->textarea();
echo $form->field($model, 'event_start')->widget(DateTimePicker::className(), [
    'layout'        => '{picker}{input}',
    'options'       => [
        'value' => $model->event_start ? date('d M Y H:i', $model->event_start) : null,
    ],
    'pluginOptions' => [
        'format'         => 'dd M yyyy hh:ii',
        'todayHighlight' => true
    ]
]);
echo $form->field($model, 'event_end')->widget(DateTimePicker::className(), [
    'layout'        => '{picker}{input}',
    'options'       => [
        'value' => $model->event_end ? date('d M Y H:i', $model->event_end) : null,
    ],
    'pluginOptions' => [
        'format'         => 'dd M yyyy hh:ii',
        'todayHighlight' => true
    ]
]);

echo $form->field($model, 'event_image')->widget(ImageAjax::className(), [
    'url' => ['ajax/simple-image']
]);

echo $form->field($model, 'event_country');
echo $form->field($model, 'event_state');
echo $form->field($model, 'event_city');
echo $form->field($model, 'event_city');
echo $form->field($model, 'event_zip');
echo $form->field($model, 'event_place');
echo $form->field($model, 'event_address');
echo $form->field($model, 'event_help_link');
echo $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(EventCategories::findAll(['category_status' => true]), 'category_id', 'category_name'));

echo $form->field($model, 'event_status')->widget(SwitchBox::className(), [
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



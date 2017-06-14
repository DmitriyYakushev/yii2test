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

$this->title = ($model->isNewRecord ? 'Create' : 'Update') . ' setting';

BreadcrumbsPanel::setParams([
    [
        'label' => 'Settings',
        'url'   => ['settings/index']
    ], [
        'label' => $this->title
    ],
], 'fa fa-cogs');

echo Alert::widget();

$form = ActiveForm::begin(Helper::getFormParams());

echo $form->field($model, 'setting_name');
echo $form->field($model, 'setting_value');

echo Html::tag('div', Html::submitButton('Save', ['class' => 'btn btn-success']), ['class' => 'form-save']);

ActiveForm::end();



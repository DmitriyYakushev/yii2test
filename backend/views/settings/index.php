<?php
use \yii\helpers\Html;
use yii\helpers\Url;
use \backend\models\SettingsSearch as Model;

/**
 * @var yii\web\View $this
 * @var Model $model
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = 'Settings';

\keygenqt\breadcrumbsPanel\BreadcrumbsPanel::setParams([
    $this->title
], 'fa fa-cogs');

echo \yii\bootstrap\Button::widget([
    'tagName'     => 'a',
    'label'       => Html::tag('i', '', ['class' => 'fa fa-plus-square']) . ' Add',
    'encodeLabel' => false,
    'options'     => [
        'class' => 'btn-success btn-add',
        'href'  => Url::toRoute(['settings/update'])
    ],
]);

echo backend\widgets\Alert::widget();

echo \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'filterModel'  => $model,
    'summary'      => false,
    'columns'      => [
        'setting_name', 'setting_value',
        [
            'header'         => 'Settings',
            'content'        => function (Model $model) {
                return \yii\bootstrap\Button::widget([
                    'tagName'     => 'a',
                    'label'       => Html::tag('i', '', ['class' => 'fa fa-pencil-square-o']),
                    'encodeLabel' => false,
                    'options'     => [
                        'class' => 'btn-primary',
                        'href'  => Url::toRoute(['settings/update', 'name' => $model->setting_name])
                    ],
                ]);
            },
            'headerOptions'  => ['class' => 'settings', 'style' => 'width: 75px;'],
            'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 75px;text-align: center;vertical-align: middle;'],
        ],
    ]
]);
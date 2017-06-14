<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use \backend\models\EventsSearch as Model;
use \keygenqt\breadcrumbsPanel\BreadcrumbsPanel;
use \yii\bootstrap\Button;
use \backend\widgets\Alert;
use \yii\grid\GridView;
use \keygenqt\datePicker\DatePicker;

/**
 * @var yii\web\View $this
 * @var Model $model
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = 'Events';

BreadcrumbsPanel::setParams([
    $this->title
], 'fa fa-leaf');

echo Button::widget([
    'tagName'     => 'a',
    'label'       => Html::tag('i', '', ['class' => 'fa fa-plus-square']) . ' Add',
    'encodeLabel' => false,
    'options'     => [
        'class' => 'btn-success btn-add',
        'href'  => Url::toRoute(['events/update'])
    ],
]);

echo Alert::widget();

echo GridView::widget([
    'dataProvider' => $provider,
    'filterModel'  => $model,
    'summary'      => false,
    'columns'      => [
        'event_title', 'event_country', 'event_state', 'event_city', 'event_zip', 'event_place', 'event_address',
        [
            'header' => 'Category',
            'value'  => function (Model $model) {
                return $model->category ? $model->category->category_name : null;
            }
        ],
        [
            'attribute'      => 'event_start',
            'format'         => 'raw',
            'value'          => function (Model $model) {
                return date('d M Y, H:i', $model->event_start);
            },
            'filter'         => DatePicker::widget([
                'model'      => $model,
                'attribute'  => 'event_start',
                'language'   => 'en-US',
                'dateFormat' => 'php:d M Y',
            ]),
            'contentOptions' => ['style' => 'text-align: center;vertical-align: middle;']
        ],
        [
            'attribute'      => 'event_end',
            'format'         => 'raw',
            'value'          => function (Model $model) {
                return date('d M Y, H:i', $model->event_end);
            },
            'filter'         => DatePicker::widget([
                'model'      => $model,
                'attribute'  => 'event_end',
                'language'   => 'en-US',
                'dateFormat' => 'php:d M Y',
            ]),
            'contentOptions' => ['style' => 'text-align: center;vertical-align: middle;']
        ],
        [
            'filter'         => [
                '0' => 'Deleted',
                '1' => 'Active',
            ],
            'attribute'      => 'event_status',
            'header'         => 'Status',
            'format'         => 'html',
            'value'          => function (Model $model) {
                return Html::tag('span', $model->event_status ? 'Active' : 'Deleted', ['class' => ($model->event_status ? 'label label-success' : 'label label-danger')]);
            },
            'contentOptions' => ['style' => 'width: 135px;text-align: center;vertical-align: middle;'],
            'headerOptions'  => ['style' => 'width: 135px;'],
        ],
        [
            'header'         => 'Settings',
            'content'        => function (Model $model) {
                return Button::widget([
                    'tagName'     => 'a',
                    'label'       => Html::tag('i', '', ['class' => 'fa fa-pencil-square-o']),
                    'encodeLabel' => false,
                    'options'     => [
                        'class' => 'btn-primary',
                        'href'  => Url::toRoute(['events/update', 'id' => $model->event_id])
                    ],
                ]);
            },
            'headerOptions'  => ['class' => 'settings', 'style' => 'width: 75px;'],
            'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 75px;text-align: center;vertical-align: middle;'],
        ],
    ]
]);
<?php
use \yii\helpers\Html;
use \yii\helpers\Url;
use common\models\Polls as Model;
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

$this->title = 'Polls';

BreadcrumbsPanel::setParams([
    $this->title
], 'fa fa-check-circle-o');

echo Button::widget([
    'tagName'     => 'a',
    'label'       => Html::tag('i', '', ['class' => 'fa fa-plus-square']) . ' Add',
    'encodeLabel' => false,
    'options'     => [
        'class' => 'btn-success btn-add',
        'href'  => Url::toRoute(['polls/update'])
    ],
]);

echo Alert::widget();

echo GridView::widget([
    'dataProvider' => $provider,
    'filterModel'  => $model,
    'summary'      => false,
    'columns'      => [
        'poll_text',
        [
            'attribute'      => 'poll_date',
            'format'         => 'raw',
            'value'          => function (Model $model) {
                return date('d M Y, H:i', $model->poll_date);
            },
            'filter'         => DatePicker::widget([
                'model'      => $model,
                'attribute'  => 'poll_date',
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
            'attribute'      => 'poll_status',
            'header'         => 'Status',
            'format'         => 'html',
            'value'          => function (Model $model) {
                switch ($model->poll_status) {
                    case Model::POLL_DELETED:
                        return Html::tag('span', 'Deleted', ['class' => 'label label-danger']);
                    case Model::POLL_ACTIVE:
                        return Html::tag('span', 'Active', ['class' => 'label label-success']);
                    case Model::POLL_PENDING:
                        return Html::tag('span', 'Pending', ['class' => 'label label-warning']);
                }
                return null;
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
                        'href'  => Url::toRoute(['polls/update', 'id' => $model->poll_id])
                    ],
                ]);
            },
            'headerOptions'  => ['class' => 'settings', 'style' => 'width: 75px;'],
            'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 75px;text-align: center;vertical-align: middle;'],
        ],
    ]
]);
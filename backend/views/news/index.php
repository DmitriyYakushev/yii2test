<?php
use backend\models\NewsSearch as Model;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var Model $model
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = 'News';

\keygenqt\breadcrumbsPanel\BreadcrumbsPanel::setParams([
    $this->title
], 'fa fa-newspaper-o');

echo \yii\bootstrap\Button::widget([
    'tagName' => 'a',
    'label' => Html::tag('i', '', ['class' => 'fa fa-plus-square']) . ' Add',
    'encodeLabel' => false,
    'options' => [
        'class' => 'btn-success btn-add',
        'href' => Url::toRoute(['news/update'])
    ],
]);

echo backend\widgets\Alert::widget();

echo \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'filterModel' => $model,
    'summary' => false,
    'columns' => [
        [
            'attribute' => 'title',
        ],
        [
            'attribute' => 'news_date',
            'format' => 'raw',
            'filter' => false,
            'value' => function (Model $model) {
                return date('j-M-Y', $model->news_date);
            },
            'contentOptions' => ['style' => 'text-align: center;vertical-align: middle;']
        ],
        [
            'header' => 'Settings',
            'content' => function (Model $model) {
                return \yii\bootstrap\Button::widget([
                    'tagName' => 'a',
                    'label' => Html::tag('i', '', ['class' => 'fa fa-pencil-square-o']),
                    'encodeLabel' => false,
                    'options' => [
                        'class' => 'btn-primary',
                        'href' => Url::toRoute(['news/update', 'id' => $model->news_id])
                    ],
                ]);
            },
            'headerOptions' => ['class' => 'settings', 'style' => 'width: 75px;'],
            'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 75px;text-align: center;vertical-align: middle;'],
        ],
    ]
]);
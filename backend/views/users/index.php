<?php
use \backend\models\UsersSearch as Model;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var Model $model
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = 'Users';

\keygenqt\breadcrumbsPanel\BreadcrumbsPanel::setParams([
    $this->title
], 'fa fa-users');

echo \yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'filterModel'  => $model,
    'summary'      => false,
    'columns'      => [
        'user_login', 'user_fname', 'user_lname', 'user_state', 'user_city', 'user_company', 'user_occupation', 'user_industry',
        [
            'filter'    => Model::readableStatuses(),
            'attribute' => 'user_status',
            'value'     => function (Model $model) {
                return $model->readableStatus();
            }
        ],
        [
            'header' => 'View',
            'content' => function (Model $model) {
                return \yii\bootstrap\Button::widget([
                    'tagName' => 'a',
                    'label' => Html::tag('i', '', ['class' => 'fa fa-pencil-square-o']),
                    'encodeLabel' => false,
                    'options' => [
                        'class' => 'btn-primary',
                        'href' => Url::toRoute(['users/view-events', 'userId' => $model->user_id])
                    ],
                ]);
            },
            'headerOptions' => ['class' => 'settings', 'style' => 'width: 75px;'],
            'contentOptions' => ['class' => 'grid-btn', 'style' => 'width: 75px;text-align: center;vertical-align: middle;'],
        ],
    ],
]);
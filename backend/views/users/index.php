<?php
use \backend\models\UsersSearch as Model;

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
        ]
    ],
]);
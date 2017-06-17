<?php
use \backend\models\UsersSearch as Model;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var Model $model
 * @var \yii\data\ActiveDataProvider $provider
 */

$this->title = $user->user_login;

?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'Events',
                'format' => 'raw',
                'value' => function($model) {
                    $list = '
                    <ul class="list-group">';
                    foreach ($model as $item) {
                        $list .= '
                            <li class="list-group-item">
                            ' . $item->event_title . '
                            </li>';
                    }
                    $list .= '</ul>';

                    return $list;
                }
            ]
        ],
    ]) ?>

</div>

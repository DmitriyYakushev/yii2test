<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Polls as Model;
use keygenqt\breadcrumbsPanel\BreadcrumbsPanel;
use dosamigos\switchinput\SwitchBox;
use backend\widgets\Alert;
use backend\helpers\Helper;
use kartik\datetime\DateTimePicker;

/**
 * @var yii\web\View $this
 * @var Model $model
 * @var \common\models\PollsAnswers $emptyAnswer
 */

$this->title = ($model->isNewRecord ? 'Create' : 'Update') . ' poll';

BreadcrumbsPanel::setParams([
    [
        'label' => 'Polls',
        'url'   => ['polls/index']
    ], [
        'label' => $this->title
    ],
], 'fa fa-check-circle-o');

echo Alert::widget();

$form = ActiveForm::begin(Helper::getFormParams());

echo $form->field($model, 'poll_text');

echo $form->field($model, 'poll_date')->widget(DateTimePicker::className(), [
    'layout'        => '{picker}{input}',
    'options'       => [
        'value' => $model->poll_date ? date('d M Y H:i', $model->poll_date) : null,
    ],
    'pluginOptions' => [
        'format'         => 'dd M yyyy hh:ii',
        'todayHighlight' => true
    ]
]);

echo $form->field($model, 'user_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Users::find()->all(), 'id', 'user_login'));

$model->poll_status = (boolean)$model->poll_status;
echo $form->field($model, 'poll_status')->widget(SwitchBox::className(), [
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

//new answers
if (!$model->isNewRecord) { ?>
    <div class="row">
        <div class="col-md-2 text-right">
            <h3>Add answer</h3>
        </div>
    </div>
    <hr>

    <?
    $form = ActiveForm::begin(array_merge(Helper::getFormParams(), ['action' => ['polls/update-answer']]));

    echo Html::activeHiddenInput($emptyAnswer, 'poll_id', ['value' => $model->poll_id]);
    echo $form->field($emptyAnswer, 'poll_answer');
    echo $form->field($emptyAnswer, 'poll_answer_count');

    echo Html::tag('div', Html::submitButton('Add', ['class' => 'btn btn-success']), ['class' => 'form-save']);

    ActiveForm::end();
}


//update answers
if ($model->answersIdDesc) { ?>

    <div class="row">
        <div class="col-md-2 text-right">
            <h3>Update Answers</h3>
        </div>
    </div>
    <hr>

    <?

    foreach ($model->answersIdDesc as $answer) {
        if (isset($editedAnswer) && ($answer->poll_answer_id == $editedAnswer->poll_answer_id)) {
            $answer = $editedAnswer;
        }
        $form = ActiveForm::begin(array_merge(Helper::getFormParams(), ['action' => ['polls/update-answer', 'id' => $answer->poll_answer_id]]));

        echo Html::activeHiddenInput($answer, 'poll_id', ['value' => $model->poll_id]);
        echo $form->field($answer, 'poll_answer');
        echo $form->field($answer, 'poll_answer_count');

        echo Html::tag('div', Html::submitButton('Update', ['class' => 'btn btn-success']), ['class' => 'form-save']);

        ActiveForm::end();
        echo Html::tag('p');
    }
}




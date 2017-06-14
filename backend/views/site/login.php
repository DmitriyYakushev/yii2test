<?php

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var \backend\models\LoginForm $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\assets\LayoutPageAsset;

$this->title = 'Login';

LayoutPageAsset::register($this);

?>

<?php $this->beginPage() ?>
    <!DOCTYPE html>

    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="/images/old/favicon.png" sizes="16x16">
        <title><?= $this->title ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <style>
        .form-control {
            background: #EFEFEF;
        }
    </style>

    <?php $this->beginBody() ?>
    <table class="table-body">
        <tr>
            <td>
                <div class="panel-login well">
                    <h1 class="logo">
                        <div></div>
                        <div><?= Yii::$app->name ?></div>
                    </h1>
                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['autocomplete' => 'off']]); ?>
                    <?= $form->field($model, 'username', ['options' => ['class' => $model->username ? 'has-success' : '']]) ?>
                    <?= $form->field($model, 'password', ['options' => ['class' => $model->password ? 'has-success' : '']])->passwordInput() ?>
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    <div class="form-group">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </td>
        </tr>
    </table>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
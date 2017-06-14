<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var string $name
 * @var string $message
 * @var Exception $exception
 */

$this->title = 'Error';

\keygenqt\breadcrumbsPanel\BreadcrumbsPanel::setParams([
    $this->title
], 'fa fa-cogs');

?>

<?php if (Yii::$app->user->isGuest): ?>
    <?php
        Yii::$app->layout = false;
        \backend\assets\LayoutPageAsset::register($this);
    ?>

    <?php $this->beginPage() ?>
    <!DOCTYPE html>

    <html lang="<?= Yii::$app->language ?>">
        <style>
            .field-loginform-rememberme {
                margin-top: 10px;
            }
        </style>
        <head>
            <meta charset="<?= Yii::$app->charset ?>"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="icon" type="image/png" href="/favicon.png" sizes="16x16">
            <title><?= $this->title ?></title>
            <?php $this->head() ?>
        </head>
        <body>
            <?php $this->beginBody() ?>
            
            <style>
                .panel-login {
                    width: 800px;
                }
            </style>
            
            <table class="table-body">
                <tr>
                    <td>
                        <div class="panel-login well">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1>
                                        <?= Html::encode($this->title) ?>
                                    </h1>
                                    <div class="alert alert-danger">
                                        <?= nl2br(Html::encode($message)) ?>
                                    </div>
                                    <p>
                                        The above error occurred while the Web server was processing your request.
                                    </p>
                                    <p>
                                        Please contact us if you think this is a server error. Thank you.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <?php $this->endBody() ?>
        </body>
    </html>
    <?php $this->endPage() ?>
     
<?php else: ?>
    <div class="body">
        <div class="row">
            <div class="col-lg-12">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>
                <div class="alert alert-danger">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
                <p>
                    The above error occurred while the Web server was processing your request.
                </p>
                <p>
                    Please contact us if you think this is a server error. Thank you.
                </p>
            </div>
        </div>
    </div>
<?php endif; ?>





<?php

use \backend\assets\LayoutAsset;
use \keygenqt\verticalMenu\VerticalMenu;
use \keygenqt\breadcrumbsPanel\BreadcrumbsPanel;

LayoutAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/images/favicon.png" sizes="16x16">
    <title><?= $this->title ?></title>

    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<div class="body-content">
    <?= VerticalMenu::widget([
        'title'      => 'Clowder',
        'subtitle'   => 'Admin panel',
        'titleUrl'   => ['users/index'],
        'itemsFront' => [
            [
                'url'     => ['site/logout'],
                'icon'    => 'fa fa-sign-out',
                'options' => [
                    'style' => '
                                        padding-top: 18px;
                                        -webkit-transform: rotate(-180deg); 
                                        -moz-transform: rotate(-180deg);
                                        -ms-transform: rotate(-180deg);
                                        -o-transform: rotate(-180deg);'
                ],
            ],
        ],
        'items'      => [
            [
                'label' => 'News',
                'url'   => ['news/index'],
            ],
            [
                'label' => 'Users',
                'url'   => ['users/index'],
            ],
            [
                'label' => 'Settings',
                'url'   => ['settings/index'],
            ],
            [
                'label' => 'Polls',
                'url'   => ['polls/index'],
            ],
            [
                'label' => 'Events',
                'url'   => ['events/index'],
            ]
        ]
    ]);
    ?>

    <?= BreadcrumbsPanel::widget([
        'content' => $content
    ]) ?>

</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php

namespace console\controllers;

use yii\console\Controller;
use common\models\Users;
use common\models\Credits;
use common\models\Transactions;

class CronController extends Controller {
    public function actionIndex()
    {
                echo "cron service running\n";
    }
}
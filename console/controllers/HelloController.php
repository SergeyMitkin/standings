<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.09.2021
 * Time: 1:31
 */

namespace app\console\controllers ;

use yii\console\ExitCode;

class HelloController extends \yii\console\Controller
{
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }
}
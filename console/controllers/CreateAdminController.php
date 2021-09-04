<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 04.09.2021
 * Time: 10:01
 */

namespace console\controllers;


use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class CreateAdminController extends Controller
{
    public function actionIndex(){

        $user = User::findOne(['status' => 1]);

        echo $user->id;

        return ExitCode::OK;
        /*
        $am = \Yii::$app->authManager;

        $admin = $am->createRole('admin');
        $admin->description = 'Администратор';

        $am->add($admin);

        $permission_admin_access = $am->createPermission('adminAccess');

        $am->add($permission_admin_access);

        $am->addChild($admin, $permission_admin_access);

        $am->assign($admin, 1);
        */

    }
}
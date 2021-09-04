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

class AdminPermissionsController extends Controller
{
    public function actionIndex(){

        // Получаем id пользователя со статусом админа
        $admin_id = User::findOne(['status' => User::STATUS_ADMIN])->id;

        // Добавляем админу разрешения
        $am = \Yii::$app->authManager;

        $admin = $am->createRole('admin');
        $admin->description = 'Администратор';

        $am->add($admin);

        $permission_admin_access = $am->createPermission('adminAccess');
        $permission_teams_crud = $am->createPermission('teamsCrud');
        $permission_games_crud = $am->createPermission('gamesCrud');

        $am->add($permission_admin_access);
        $am->add($permission_teams_crud);
        $am->add($permission_games_crud);

        $am->addChild($admin, $permission_admin_access);
        $am->addChild($admin, $permission_teams_crud);
        $am->addChild($admin, $permission_games_crud);

        if ($am->assign($admin, $admin_id)){
            echo 'admin permissions added';
            return ExitCode::OK;
        }

    }
}
<?php

namespace app\commands;

use app\models\User;
use PDO;
use Yii;
use yii\base\Security;
use yii\console\Controller;

class SeedController extends Controller
{

    public function actionIndex()
    {
        $username = 'admin';
        $db = Yii::$app->db;
        $command = $db->createCommand('SELECT COUNT(*) FROM {{%user}} WHERE username = :username');
        $command->bindValue(':username', $username, PDO::PARAM_STR);
        $exist = $command->queryScalar();
        if (!$exist) {
            $now = time();
            $security = new Security;
            $columns = [
                'type' => User::TYPE_BACKEND,
                'username' => $username,
                'nickname' => 'admin',
                'auth_key' => $security->generateRandomString(),
                'password_hash' => $security->generatePasswordHash('admin'),
                'password_reset_token' => null,
                'email' => 'admin@example.com',
                'role' => 10,
                'status' => User::STATUS_ACTIVE,
                'register_ip' => '::1',
                'login_count' => 0,
                'last_login_ip' => null,
                'last_login_time' => null,
                'created_by' => 0,
                'created_at' => $now,
                'updated_by' => 0,
                'updated_at' => $now,
                'deleted_by' => null,
                'deleted_at' => null,
            ];
            $db->createCommand()->insert('{{%user}}', $columns)->execute();
        } else {
            echo "'{$username}' is exists.\r\n";
        }

        echo "Done";
    }

}

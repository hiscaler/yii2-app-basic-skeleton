<?php

use yii\db\Schema;
use yii\db\Migration;

class m140901_012145_creata_user_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'nickname' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'register_ip' => Schema::TYPE_STRING . ' NOT NULL',
            'login_count' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'last_login_ip' => Schema::TYPE_STRING,
            'last_login_time' => Schema::TYPE_INTEGER,
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_at' => Schema::TYPE_INTEGER,
            'deleted_by' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');

        return false;
    }

}

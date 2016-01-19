<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * User login log table
 */
class m141027_135835_create_user_login_log_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%user_login_log}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'login_ip' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'client_informations' => Schema::TYPE_STRING . ' NOT NULL',
            'login_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user_login_log}}');
    }

}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m140901_152314_create_ip_access_rule_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%ip_access_rule}}', [
            'id' => Schema::TYPE_PK,
            'ip_address' => Schema::TYPE_STRING . ' NOT NULL',
            'final_date' => Schema::TYPE_INTEGER,
            'type' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'enabled' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'tenant_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'deleted_by' => Schema::TYPE_INTEGER,
            'deleted_at' => Schema::TYPE_INTEGER,
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%ip_access_rule}}');
    }

}

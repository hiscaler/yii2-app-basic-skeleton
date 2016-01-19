<?php

use yii\db\Schema;
use yii\db\Migration;

class m140907_084634_create_group_option_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%group_option}}', [
            'id' => Schema::TYPE_PK,
            'group_name' => Schema::TYPE_STRING . ' NOT NULL',
            'text' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING,
            'enabled' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'defaulted' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'ordering' => Schema::TYPE_INTEGER . ' NOT NULL',
            'description' => Schema::TYPE_STRING,
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
        $this->dropTable('{{%group_option}}');
    }

}

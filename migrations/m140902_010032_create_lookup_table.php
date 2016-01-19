<?php

use yii\db\Schema;
use yii\db\Migration;

class m140902_010032_create_lookup_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%lookup}}', [
            'id' => Schema::TYPE_PK,
            'label' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_STRING,
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
            'return_type' => Schema::TYPE_STRING . ' NOT NULL',
            'enabled' => Schema::TYPE_BOOLEAN . ' NOT NULL',
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
        $this->dropTable('{{%lookup}}');
    }

}

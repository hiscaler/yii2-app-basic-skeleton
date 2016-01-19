<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Grid view column config table
 */
class m140911_150535_create_grid_column_config_table extends Migration
{

    public function up()
    {
        $this->createTable('{{%grid_column_config}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'attribute' => Schema::TYPE_STRING . ' NOT NULL',
            'css_class' => Schema::TYPE_STRING,
            'css_style' => Schema::TYPE_STRING,
            'visible' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 1',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'tenant_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%grid_column_config}}');
    }

}

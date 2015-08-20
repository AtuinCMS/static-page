<?php

use \yii\db\Schema;

class m150323_114250_atuin_static_page_migration extends \yii\db\Migration
{

    private function staticPluginTableName()
    {
        return \atuin\static_page\models\StaticPlugin::tableName();
    }


    public function safeUp()
    {
        $tableOptions = NULL;
        if (Yii::$app->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        /**
         * Static Plugin for Static Pages
         */
        $this->createTable($this->staticPluginTableName(), [
            'id' => \yii\db\Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'text' => Schema::TYPE_TEXT,
            'creation_date' => Schema::TYPE_DATETIME,
            'update_date' => Schema::TYPE_DATETIME,
            'author_id' => Schema::TYPE_INTEGER,
            'last_editor_id' => Schema::TYPE_INTEGER
        ], $tableOptions);


    }


    public function safeDown()
    {
        $this->dropTable($this->staticPluginTableName());
    }

}

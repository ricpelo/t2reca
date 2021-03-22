<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%aeropuertos}}`.
 */
class m210322_181145_create_aeropuertos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%aeropuertos}}', [
            'id' => $this->bigPrimaryKey(),
            'codigo' => $this->string(3)->notNull()->unique(),
            'denominacion' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%aeropuertos}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%track}}`.
 */
class m250917_054402_create_track_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%track}}', [
            'id' => $this->primaryKey()->comment('Первичный ключ'),
            'track_number' => $this->string()->notNull()->unique()->comment('Номер трека'),
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата и время создания записи'),
            'updated_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->comment('Дата и время последнего обновления записи'),
            'status' => $this->string()->notNull()->defaultValue('new')->comment('Статус трека'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%track}}');
    }
}

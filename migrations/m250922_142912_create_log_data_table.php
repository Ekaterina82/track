<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log_data}}`.
 */
class m250922_142912_create_log_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log_data}}', [
            'id' => $this->primaryKey(),
            'model_name' => $this->string()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'attribute' => $this->string()->notNull(),
            'old_value' => $this->text(),
            'new_value' => $this->text(),
            'changed_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log_data}}');
    }
}

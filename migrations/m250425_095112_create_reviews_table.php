<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 */
class m250425_095112_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
            'photo' => $this->string()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('fk-reviews-user_id', 'reviews', 'user_id', 'user', 'id', 'CASCADE');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');
        $this->dropForeignKey('fk-reviews-user_id', 'reviews');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorites}}`.
 */
class m250526_163458_create_favorites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    $this->createTable('favorites', [
        'id' => $this->primaryKey(),
        'user_id' => $this->integer()->notNull(),
        'product_id' => $this->integer()->notNull(),
        'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
    ]);

    $this->addForeignKey(
        'fk-favorites-user_id',
        'favorites',
        'user_id',
        'user',
        'id',
        'CASCADE'
    );
}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favorites}}');
    }
}

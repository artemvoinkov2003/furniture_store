<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart_items}}`.
 */
class m250429_111327_create_cart_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart_items}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
            'price' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('fk-cart_items-user_id', 'cart_items', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk-cart_items-product_id', 'cart_items', 'product_id', 'products', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart_items}}');
        $this->dropForeignKey('fk-cart_items-user_id', 'cart_items');
        $this->dropForeignKey('fk-cart_items-product_id', 'cart_items');
    }
}

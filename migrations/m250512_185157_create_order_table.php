<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m250512_185157_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    
       public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull()->defaultValue(1),
            'price' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'delivery_address' => $this->string(255)->notNull(),
            'delivery_method' => $this->string(50)->notNull(),
            'delivery_date' => $this->date()->notNull(),
            'phone' => $this->string(20)->notNull(),
            'delivery_comment' => $this->text(),
            'status' => $this->string(20)->defaultValue('new'),
        ]);

        $this->addForeignKey('fk-order-user_id', '{{%order}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-order-product_id', '{{%order}}', 'product_id', '{{%products}}', 'id', 'CASCADE');
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order-user_id', '{{%order}}');
        $this->dropForeignKey('fk-order-product_id', '{{%order}}');
        $this->dropTable('{{%order}}');
    }
}

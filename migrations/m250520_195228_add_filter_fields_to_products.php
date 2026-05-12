<?php

use yii\db\Migration;

/**
 * Class m250520_195228_add_filter_fields_to_products
 */
class m250520_195228_add_filter_fields_to_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'material', "ENUM('wood', 'metal', 'fabric') NOT NULL");
        $this->addColumn('products', 'size', "ENUM('small', 'medium', 'large') NOT NULL");
        $this->addColumn('products', 'price', 'INT(11) NOT NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'material');
        $this->dropColumn('products', 'size');
        $this->dropColumn('products', 'price');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250520_195228_add_filter_fields_to_products cannot be reverted.\n";

        return false;
    }
    */
}

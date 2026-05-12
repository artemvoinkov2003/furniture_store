<?php

use yii\db\Migration;

/**
 * Class m250523_193526_add_category_material_size_to_products_table
 */
class m250523_193526_add_category_material_size_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%products}}', 'category', $this->string(255));
        $this->addColumn('{{%products}}', 'material', $this->string(50));
        $this->addColumn('{{%products}}', 'size', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250523_193526_add_category_material_size_to_products_table cannot be reverted.\n";

        $this->dropColumn('{{%products}}', 'category');
        $this->dropColumn('{{%products}}', 'material');
        $this->dropColumn('{{%products}}', 'size');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250523_193526_add_category_material_size_to_products_table cannot be reverted.\n";

        return false;
    }
    */
}

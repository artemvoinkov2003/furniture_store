<?php

use yii\db\Migration;

/**
 * Class m250519_160831_add_password_reset_fields_to_user
 */
class m250519_160831_add_password_reset_fields_to_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'password_reset_code', $this->string(4));
        $this->addColumn('user', 'password_reset_code_expires_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'password_reset_code');
        $this->dropColumn('user', 'password_reset_code_expires_at');      
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250519_160831_add_password_reset_fields_to_user cannot be reverted.\n";

        return false;
    }
    */
}

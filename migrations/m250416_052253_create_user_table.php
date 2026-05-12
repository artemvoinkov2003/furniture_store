<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250416_052253_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'password' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'auth_key' => $this->string(32)->notNull()->defaultValue(null)->append('COMMENT "Ключ для аутентификации"'),
            'password_reset_token' => $this->string(255)->defaultValue(null),
            'email_confirm_token' => $this->string(255)->defaultValue(null),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(10), 
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}

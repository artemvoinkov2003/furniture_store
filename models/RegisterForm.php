<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $phone;

    public function rules()
    {
        return [
            [['username', 'first_name', 'last_name', 'email', 'password', 'phone'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Логин уже занят'],
            ['phone', 'match', 'pattern' => '/^\+7\.\d{3}\.\d{3}-\d{2}-\d{2}$/', 'message' => 'Формат: +7.XXX.XXX-XX-XX'],
        ];
    }

    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User();
        $user->username = $this->username;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->email = $this->email;
        $user->password = Yii::$app->security->generatePasswordHash($this->password);
        $user->phone = $this->phone;

        if ($user->save()) {
            return $user;
        }

        $this->addErrors($user->errors);
        return false;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Имя пользователя',
            'email' => 'Почта',
            'password' => 'Пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон'
        ];
    }
}
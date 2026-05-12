<?php
namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            
            if ($user->save()) {
                $auth = Yii::$app->authManager;
                $userRole = $auth->getRole('user');
                $auth->assign($userRole, $user->id);
                return $user;
            }
        }
        return null;
    }
}
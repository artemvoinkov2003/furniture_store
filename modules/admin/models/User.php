<?php
namespace app\modules\admin\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $password;
    public $newPassword;

    public static function tableName()
    {
        return 'user';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['username', 'email', 'password'],
            self::SCENARIO_UPDATE => ['username', 'email', 'newPassword'],
        ];
    }

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['password'], 'required', 'on' => self::SCENARIO_CREATE],
            ['email', 'email'],
            [['username', 'email'], 'unique'],
            [['newPassword'], 'string', 'min' => 6, 'on' => self::SCENARIO_UPDATE],
        ];
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    // Реализация методов IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'newPassword' => 'Новый пароль',
        ];
    }
}
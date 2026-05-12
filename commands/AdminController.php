<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;
use yii\web\NotFoundHttpException;
use Exception;

class AdminController extends Controller
{
    public function actionCreate($username, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $username . '@admin.ru';
        $user->setPassword($password);
        $user->generateAuthKey();

        if ($user->save()) {
            try {
                $auth = Yii::$app->authManager;
                $adminRole = $auth->getRole('admin');
                
                if ($adminRole === null) {
                    throw new NotFoundHttpException('Роль "admin" не найдена.');
                }
                
                $auth->assign($adminRole, $user->id);
                echo "Админ создан\n";
            } catch (Exception $e) {
                echo "Ошибка: " . $e->getMessage() . "\n";
            }
        } else {
            echo "Ошибки:\n";
            foreach ($user->getErrors() as $errors) {
                echo implode("\n", $errors);
            }
        }
    }
}
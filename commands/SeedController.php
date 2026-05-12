<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class SeedController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;  
        $auth->removeAll();
 
        $userRole = $auth->createRole('user');
        $userRole->description = 'Обычный пользователь';
        $auth->add($userRole);


        $adminRole = $auth->createRole('admin');
        $adminRole->description = 'Администратор';
        $auth->add($adminRole);
        
        $accessAdminPanel = $auth->createPermission('accessAdminPanel');
        $accessAdminPanel->description = 'Доступ к админ-панели';
        $auth->add($accessAdminPanel);

    
        $auth->addChild($adminRole, $accessAdminPanel);
        
        echo "Роли и разрешения успешно созданы.\n";
    }
}
<?php
namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\controller;
use app\models\Authority;
use app\models\User;

class RoleController extends Controller
{

    /*
     * 角色管理
     *
     */
    public function actionAdd(){
    	$this->layout = 'admin';
    	$auth = new Authority();
    	$post = Yii::$app->request->post();
    	if($auth->load($post)){
			$auth->createRole($auth->role);
    	}
    	$roles = $auth->getRoles();
    	return $this->render('add',[
    		'auth' => $auth,
    		'roles' => $roles,
    	]);
    }
    public function actionDeleterole($name){
    	$auth = Yii::$app->authManager;
    	$auth->remove($auth->getRole($name));
    	return $this->redirect(Url::toRoute('role/add'));
    }

	public function actionEdit($userid){
		$this->layout = 'admin';
		$auth = new Authority();
		$roles = $auth->getRoles();

		$user = User::findOne($userid);
		$post = Yii::$app->request->post();
		if($auth->load($post)){
			if(!$auth->checkAccess($userid,$auth->role)){
				$auth->assign($auth->role, $userid);
				Yii::$app->session->setFlash('message', '成功将用户 ' . $user->name . ' 赋予角色：' . $auth->role);
			}
			else{
				Yii::$app->session->setFlash('message', '用户 ' . $user->name . ' 已经属于角色：' . $auth->role);
			}
		}
		return $this->render('edit', [
			'auth'	=> $auth,
			'user'	=> $user,
			'roles'	=> $roles,
		]);
	}
}
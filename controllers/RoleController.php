<?php
namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\controller;
use app\models\Authority;
use app\models\User;

class RoleController extends Controller
{

    public function actionUser(){
    	$this->layout = 'admin';
    	$users = User::find()->where('1=1')->all();
    	return $this->render('user',[
    		'users' => $users,
    	]);
    }
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
		$auth = Yii::$app->authManager;
		$roles = $auth->getRoles();

		$user = User::findOne($userid);
		return $this->render('edit', [
			'user' => $user,
			'roles' => $roles,
		]);
	}
}
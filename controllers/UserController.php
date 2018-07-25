<?php

namespace app\controllers;

use Yii;
use yii\helpers\VarDumper;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Tools;
use app\models\LoginForm;
use app\models\User;
use yii\base\Exception;
use yii\data\Pagination;

use yii\Roc\IO;
use yii\Roc\Session;
use yii\Roc\Sms\Sms;
use yii\Roc\Captcha\Captcha;

class UserController extends Controller
{
	public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

	/*
	 * 用户列表
	 */
	public function actionIndex(){
		$query = User::find()->orderBy('id desc');
        $count	= $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = 18;
        $users		= $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
        return $this->render('list', [
                    'users'     => $users,
                    'pagination'    => $pagination,
                    ]);
	}

	// 用户登录
	public function actionRegister(){
		$this->layout	= 'login';
		$loginForm		= new LoginForm(['scenario' => 'register1']);
		$post = Yii::$app->request->post();
		if($loginForm->load($post)){
			if(Yii::$app->session->get('captcha') <> $loginForm->verifyCode){
				Yii::$app->session->setFlash('message', '验证码不正确');
				return $this->render('register', [
					'loginForm' => $loginForm,
				]);
			}
			if(User::checkMobile($loginForm->mobile)){
				Yii::$app->session->setFlash('message', '手机号已被注册');
				return $this->render('register', [
					'loginForm' => $loginForm,
				]);
			}
			$smsCode = rand(100000,999999);
			Yii::$app->session->set('smscode', $smsCode);
			//public static function send($number, $code, $sign='廊坊房管局') {
			//Sms::send($loginForm->mobile, $smsCode);
			$loginForm->scenario = 'register2';
			return $this->render('verifycode', ['loginForm' 	=> $loginForm]);
		}
		return $this->render('register', ['loginForm' => $loginForm]);
	}

	public function actionCaptcha(){
		$captcha = new Captcha();  //实例化一个对象
		$captcha->doimg();
		Yii::$app->session->set('captcha', $captcha->getCode());//验证码保存到SESSION中
		exit; // Added by Roc at 2018/7/22, without this, yii2 will send header twice, it whill throw a exception
	}

	public function actionGetSms(){
		$this->layout = 'login';
		$session = Yii::$app->session;
		$post = Yii::$app->request->post();
		$loginForm = new loginForm(['scenario' => 'register2']);
		if($loginForm->load($post)){
			if($loginForm->smsCode == Yii::$app->session->get('smscode')){
				$user = User::register($loginForm);
				if(!$user){
					Yii::$app->session->setFlash('message',"注册失败。请与管理员联系。");
				}
				else{
					Yii::$app->session->setFlash('message',"注册成功，请登录。");
				}
				return $this->redirect(Url::toRoute('user/login'));
			}
			else {
			 	Yii::$app->session->setFlash('message',"验证码错误");
			 	return $this->render('verifycode', ['loginForm' => $loginForm]);
			}
		}
		else{
			Yii::$app->session->setFlash('message',"user读取失败，请联系管理员。");
		}
	}

	public function actionLogin(){
		$this->layout = 'login';

		$loginForm = new LoginForm(['scenario' => 'login']);
		if($loginForm->load(Yii::$app->request->post()) && $loginForm->login()){
			return $this->goBack();
		}

		return $this->render('login', [
				'loginForm' => $loginForm,
		]);
	}

	// 修改密码
	public function actionChpass(){
		try{
			$userLoad = new User(['scenario' => 'changepassword']);
			if($userLoad->load(Yii::$app->request->post())){
				$user = User::findOne(Yii::$app->session->get('userid'));
				$user->changePassword($userLoad);
				Yii::$app->session->setFlash('message', '密码修改成功');
			}
		}
		catch(Exception $e){
			Yii::$app->session->setFlash('message', $e->getMessage());
		}
		return $this->render('chpass', [
			'user'	=> $userLoad,
			]);
	}

	public function actionLogout(){
		Yii::$app->user->logout();
        return $this->goHome();
	}
}

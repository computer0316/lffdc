<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;


class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	$this->layout = 'admin';
        return $this->render('index');
    }

	public function actionAdd()
    {
    	$this->layout = 'admin';
    	$article = new Article();
    	$post = Yii::$app->request->post();
    	if($article->load($post)){

    	}
        return $this->render('add',[
        	'model' => $article,
        ]);
    }

	public function actionWangeditor() {
		$files = $_FILES;
		$imags = [];
		$errors = [];
		foreach($files as $file) {
			// 移动到框架应用根目录/public/uploads/ 目录下
			$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
			if ($info) {
				// 成功上传后 获取上传信息
				// 输出 jpg
				//echo $info->getExtension();
				// 输出 42a79759f284b767dfcb2a0197904287.jpg
				//echo $info->getFilename();
				$path = 'public/uploads/'.$info->getSaveName();
				array_push($imags, $path);
			} else {
				// 上传失败获取错误信息
				//echo $file->getError();
				array_push($errors, $file->getError());
			}
		}
		$imgs = ['1.jpg'];
		if (!$errors) {
			$msg['errno'] = 0;
			$msg['data'] = $imags;
			return json_encode($msg);
		} else {
			$msg['errno'] = 1;
			$msg['data'] = $imags;
			$msg['msg'] = "上传出错";
			return json_encode($msg);
		}
	}
}

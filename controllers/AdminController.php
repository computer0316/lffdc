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

    public function actionList(){
    	$this->layout = 'admin';
    	return $this->render('list');
    }

    public function actionEnclosure(){
    	$this->layout = 'admin';
    	return $this->render('enclosure');
    }

    public function actionCategory(){
    	$this->layout = 'admin';
    	return $this->render('category');
    }

    public function actionAddcategory(){
    	$this->layout = 'admin';
    	return $this->render('addcategory');
    }

    public function actionUser(){
    	$this->layout = 'admin';
    	return $this->render('user');
    }
    public function actionRole(){
    	$this->layout = 'admin';
    	return $this->render('role');
    }
    public function actionSite(){
    	$this->layout = 'admin';
    	return $this->render('site');
    }
}

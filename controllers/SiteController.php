<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Article;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
	        'upload' => [
    	        'class' => 'yii\widgets\ueditor\UEditorAction',
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
    	$article = new Article();
    	$post = Yii::$app->request->post();

		if($article->load($post)){
			$article->updatetime = date("Y-m-d H:i:s", time());
			$article->times = 1;
		}
        return $this->render('index',[
        	'model' => $article,
        ]);
    }

	// ��ʾ����
	public function actionShow($id){
		$article = Article::findOne($id);
		if($article){
			return $this->render('show', [
				'article'	=> $article,
			]);
		}
	}
	
	/*
	 * Ϊ��ƥ�� yii2 ��Ĭ�ϵ�¼����
	 * yii2 Ĭ�ϵ�¼����Ϊ�� site/login���ҵĵ�¼����Ϊ��user/login
	 */
    public function actionLogin(){
    	return $this->redirect(['user/login']);
    }

}

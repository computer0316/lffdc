<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\Article;
use app\models\Category;
use app\models\CategoryArticle;

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

    /*
     * 文章列表
     *
     * $category 当前文章分类ID
     */
    public function actionList($category = 0){
    	$condition = '';
    	if($category == 0){
    		$condition = "categoryid>0";
    	}
    	else{
    		$cateArray = Category::getChildren($category);
    		$cateStr = implode($cateArray, ',');
    		$condition = "categoryid in (" . $cateStr . ')';
    	}
		$query = CategoryArticle::find()->orderBy('updatetime desc')->where($condition);
        $count	= $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = 18;
        $articles	= $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
        return $this->render('list', [
        	'category'		=> $category,
        	'articles'		=> $articles,
            'pagination'    => $pagination,
                    ]);
    }

	// 显示文章
	public function actionShow($category=0, $id){
		$article = Article::findOne($id);
		if($article){
			$article->times++;
			$article->save();
			return $this->render('show', [
				'category'	=> $category,
				'article'	=> $article,
			]);
		}
	}

	/*
	 * 为了匹配 yii2 的默认登录设置
	 * yii2 默认登录方法为： site/login，我的登录方法为：user/login
	 */
    public function actionLogin(){
    	return $this->redirect(['user/login']);
    }

}

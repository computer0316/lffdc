<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Category;
use app\models\Text;

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
                //'only' => ['logout'], 	// 不写 only 则对所有 Action 生效
                'rules' => [
                    [
                        // 'actions' => ['logout'],	// 不写 actions 则对所有 Action 生效
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

	/*
	 * 添加文章
	 *
	 */
	public function actionAdd()
    {
    	$this->layout = 'admin';
    	$article = new Article();
    	$post = Yii::$app->request->post();
    	$user = Yii::$app->user->identity;
    	if($article->load($post)){

    	}
        return $this->render('add',[
        	'model' => $article,
        	'user'	=> $user,
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

	/*
	 * 文章分类列表
	 *
	 */
    public function actionCategory(){
    	$this->layout = 'admin';
    	$categories = Category::getAll();
    	return $this->render('category', [
    		'categories' => $categories,
    	]);
    }

	/*
	 * 添加文章分类
	 *
	 */
    public function actionAddcategory($id){
    	$this->layout = 'admin';
    	$category = Category::findOne($id);
    	$text = new Text();
    	$post = Yii::$app->request->post();
    	if($text->load($post)){
    		$cate = Category::add($text->name, $category->id);
    		return $this->redirect(Url::toRoute(['admin/category']));
    	}
    	return $this->render('addcategory', [
    		'category'	=> $category,
    		'text'		=> $text,
    	]);
    }

	public function actionTest(){
		echo strpos('123', '/');
	}
    public function actionSite(){
    	$this->layout = 'admin';
    	return $this->render('site');
    }
}

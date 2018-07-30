<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Article;
use app\models\Category;
use app\models\CategoryUser;
use app\models\CategoryArticle;
use app\models\Common;

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
    	$category = new Common();

    	$post = Yii::$app->request->post();

    	$user = Yii::$app->user->identity;
    	$categories = CategoryUser::getNames($user->id);

    	if($article->load($post) && $category->load($post)){
			$article->creater = $user->id;
			$article->save();

			$cr = new CategoryArticle();
			$cr->categoryid = $category->id;
			$cr->articleid = $article->id;
			$cr->save();
			if(empty($article->errors) && empty($cr->errors)){
				Yii::$app->session->setFlash('message', '添加文章成功');
				return $this->redirect(Url::toRoute('admin/add'));
			}
			else{
				empty($article->errors) ? var_dump($article->errors): var_dump($cr->errors);
				exit;
			}
    	}
        return $this->render('add',[
        	'model'			=> $article,
        	'user'			=> $user,
        	'categories'	=> $categories,
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
    	$common = new Common();
    	$post = Yii::$app->request->post();
    	if($common->load($post)){
    		$cate = Category::add($common->name, $category->id);
    		return $this->redirect(Url::toRoute(['admin/category']));
    	}
    	return $this->render('addcategory', [
    		'category'	=> $category,
    		'common'		=> $common,
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

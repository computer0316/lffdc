<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
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
use app\models\News;
use app\models\Data;
use app\models\Classs;


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

    public function actionList($category = 0){
    	$this->layout = 'admin';
    	$condition = '';
    	if($category == 0){
    		$condition = "categoryid>0";
    	}
    	else{
    		$condition = "categoryid = " . $category;
    	}
		$query = CategoryArticle::find()->orderBy('articleid desc')->where($condition);
        $count	= $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $pagination->pageSize = 18;
        $articles	= $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
        return $this->render('list', [
                    'articles'     => $articles,
                    'pagination'    => $pagination,
                    ]);
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
    	$father = Category::findOne($id);
    	$category = new Category();
    	$category->fatherid = $father->id;
    	$post = Yii::$app->request->post();
    	if($category->load($post)){
    		$cate = Category::add($category);
    		return $this->redirect(Url::toRoute(['admin/category']));
    	}
    	return $this->render('addcategory', [
    		'category'	=> $category,
    	]);
    }

	public function actionDeleteCategory($id){
		$this->layout = 'admin';
		$cate = Category::findOne($id);
		$cate->delete();
		return $this->redirect(Url::toRoute(['admin/category']));
	}

    public function actionSite(){
    	$this->layout = 'admin';
    	return $this->render('site');
    }

    public function actionPull(){
    	die('用于从原来网站的数据库导入数据到新网站的数据库');
    	$cate = [
    		2 => 21,
    		3 => 22,
    		8 => 30,
    		9 => 31,
			10 => 32,
			11 => 33,
			12 => 34,
			67 => 35,
			13 => 37,
			14 => 41,
			21 => 28,
			22 => 51,
			23 => 58,
			25 => 23,
			26 => 24,
			33 => 47,
			35 => 48,
			36 => 49,
			37 => 59,
			39 => 50,
			41 => 26,
			44 => 60,
			45 => 60,
			46 => 60,
			47 => 60,
			48 => 60,
			49 => 60,
			53 => 53,
			56 => 25,
			63 => 54,
			64 => 55,
			65 => 56,
			66 => 57,
    	];

		$news = News::find()->where('ismember = 0')->all();

		ob_start();
		$i = 1;
		foreach($news as $n){
			$data = Data::findOne($n->id);
			$a = new Article();
			$ca = new CategoryArticle();
			$a->title = $n->title;
			$a->text = $this->strip_word_html($data->newstext);
			$a->updatetime = date("Y-m-d H:i:s", $n->truetime);
			$a->times = $n->onclick;
			$a->ontop = $n->istop;
			$a->creater = 1;
			if($a->save()){
				echo '<meta charset="utf-8">';
				$n->ismember = 1;
				$n->save();
				$ca->categoryid = $cate[$n->classid];
				$ca->articleid = $a->id;
				$ca->save();
				echo $i++ . ' ' . Category::findOne($ca->categoryid)->name . ' - ' . Classs::findOne($n->classid)->classname . ' ' . $a->title . '<br />';
				ob_flush();
				flush();
			}
			else{
				echo '<meta charset="utf-8">';
				echo '出错文章：' . $a->title . '<br />';
				echo '原始编号：' . $n->id;
				die();
			}
		}
    }
    
    // 去掉新数据库文章中word的垃圾
    public function actionRepareArticle(){
    	$artis = Article::find()->where('ontop =0')->all();    	
    	ob_start();
    	echo '<meta charset="utf-8">';
    	foreach($artis as $a){
    		$old = strlen($a->text);
    		$a->text = $this->strip_word_html($a->text);
    		$new = strlen($a->text);
    		$a->ontop = 1;
    		$a->save();
    		echo ($old-$new) . ' ' . $a->title . '<br />';
    		ob_flush();
    		flush();
    	}
    	exit;
    }
    
    public function actionDeleteArticles(){
    	die('清空新网站的所有文章，慎用！！！');
    	CategoryArticle::deleteAll('articleid>-1');
    	Article::deleteAll('id>-1');
    	echo 'done';
    }

    public function actionTest(){
    	$arti = Article::find()->where('id>0')->all();
    	//$pattern = '/(?<=\/)\w{32,32}\.(doc|docx|xls|xlsx)/';
    	$pattern = '/<xml>[\S\s]*<\/xml>/';
    	$red = 1;
    	$blue = 1;
    	try{
	    	echo '<meta charset="utf-8">';
			ob_start();
	    	foreach($arti as $a){
	    		$str = $a->text;
	    		//$str = str_replace("\r\n", '', $str);
	    		if(preg_match_all($pattern, $str, $matches) == 0){
	    			echo  '<p style="color:blue;">' . $blue++ . ' ' . $a->id . ' ' . $a->title . '</p>';
	    		}
	    		else{
	    			echo '<p style="color:red;">' . $red++ . ' ' . $a->id . ' ' . $a->title . '</p>';
	    		}
	    		if(!empty($matches[0])){
	    			var_dump($matches[0]);
	    		}
	    		ob_flush();
	    		flush();
	    		if($red > 10 || $blue > 10){
	    			exit;
	    		}
	    	}
	    }
	    catch(Exception $exp){
	    	
	    }
    	
    	exit;
    }

	function strip_word_html($text){
		$pattern = '\"';
		$text = str_ireplace($pattern, '"', $text);

		$pattern = '/(style|class|align|lang|width|nowrap)="[^"]*?"/';
		$text = preg_replace($pattern, '', $text);
		
		$pattern = '/<xml>[\S\s]*<\/xml>/';
		$text = preg_replace($pattern, '', $text);

		$pattern = '/<style>[\S\s]*<\/style>/';
		$text = preg_replace($pattern, '', $text);
		
		$pattern = '/<o:p><\/o:p>/';
		$text = preg_replace($pattern, '', $text);

		$pattern = '/ *?(?=>)/';
		$text = preg_replace($pattern, '', $text);

		$pattern = '<span></span>';
		$text = str_ireplace($pattern, '', $text);
		$pattern = '<b></b>';
		$text = str_ireplace($pattern, '', $text);
		$pattern = '<>';
		$text = str_ireplace($pattern, '', $text);
		return $text;
	}
}

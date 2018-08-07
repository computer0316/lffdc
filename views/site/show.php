<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\DateHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Category;
use app\models\CategoryArticle;
use app\models\User;
use app\models\Department;
use app\models\DepartmentUser;

?>

<style>
	.article-info{
		text-align:center;
		line-height:36px;
		font-size:14px;
		border-top:1px dashed #ddd;
		border-bottom:1px dashed #ddd;
	}
	.article-info span{
		margin-right:30px;
	}
	.content img{
		padding:auto;
		margin:10px auto;
		clear:both;
		text-align:center;
	}
	.content a{
		line-height:36px;
		float:left;
		clear:both;
		color:blue;
	}
</style>
<?php
if($category == 0){
	$category = CategoryArticle::find()->where('articleid = ' . $article->id)->one()->categoryid;
}
//$this->params['breadcrumbs'][] = Category::findOne($category)->name;
$this->params['breadcrumbs'] = breadcrumb($category);

function breadcrumb($id){
	$cate = Category::findOne($id);
	$bread[] = ['label' => $cate->name, 'url' => Url::toRoute(['site/list', 'category' => $cate->id])];
	if($cate->fatherid <> 0){		
		$father = Category::findOne($cate->fatherid);
		$bread = array_merge(breadcrumb($father->id), $bread);
	}
	return $bread;
	
}

echo '<p class="sub-title">' . $article->title_before . '</p>';
echo '<p class="title">' . $article->title . '</p>';
echo '<p class="sub-title">' . $article->title_after . '</p>';

echo '<p class="article-info">';
	echo '<span>发布时间：' . DateHelper::getDate($article->updatetime) . '</span>';
	echo '<span>部门：' . DepartmentUser::getUserDepartment($article->creater) . '</span>';
	//echo '<span>责任编辑：' . User::findOne($article->creater)->name . '</span>';
	echo '<span>阅读次数：' . $article->times . '</span>';
echo '</p>';

echo '<div class="content">' . $article->text . '</div>';


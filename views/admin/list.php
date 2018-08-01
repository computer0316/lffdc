<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\models\CategoryArticle;
use app\models\Category;
use app\models\Article;

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;

	echo '<table class="table-list">';
	echo '<tr>';
		echo '<td>ID</td>';
		echo '<td>分类</td>';
		echo '<td>标题</td>';		
	echo '</tr>';
	foreach($articles as $a){
		echo '<tr>';
			echo '<td>' . $a->articleid . '</td>';
			echo '<td>' . Category::findOne($a->categoryid)->name . '</td>';
			echo '<td><a href="' . Url::toRoute(['site/show', 'category' => $a->categoryid, 'id' => $a->articleid]) . '">' . Article::findOne($a->articleid)->title . '</a></td>';			
		echo '</tr>';
	}
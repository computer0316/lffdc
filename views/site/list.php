<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

use app\models\Article;
use app\models\Category;

$this->title = Category::findOne($category)->name . ' - ' . Yii::$app->params['siteName'];
$this->params['breadcrumbs'][] = Category::findOne($category)->name;


foreach($articles as $a){
	echo '<a href="' . Url::toRoute(['site/show', 'category' => $category, 'id' => $a->articleid]) . '">' . Article::findOne($a->articleid)->title . '</a><br />';
}
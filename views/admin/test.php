<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use app\models\CategoryArticle;
use app\models\Category;
use app\models\Article;

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;

echo 'count1:' . $count1 . '<br />';
echo 'count2:' . $count2 . '<br />';
echo $text;
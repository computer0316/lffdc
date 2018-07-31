<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Category;

$this->title = Category::findOne($category)->name . ' - ' . Yii::$app->params['siteName'];
$this->params['breadcrumbs'][] = Category::findOne($category)->name;



echo '<p class="title">' . $article->title . '</p><br />';
echo '<p class="sub-title">' . $article->title_after . '</p><br />';
echo '<div class="content">' . $article->text . '</div>';

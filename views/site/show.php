<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::$app->params['siteName'];



echo $article->title . '<br />';
echo $article->title_after . '<br />';
echo $article->text;


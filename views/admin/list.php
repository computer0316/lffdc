<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;


foreach($articles as $a){
	echo '<a href="' . Url::toRoute(['site/show', 'id' => $a->id]) . '">' . $a->title . '</a><br />';
}
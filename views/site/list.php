<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\LinkPager;

use app\models\Article;
use app\models\Category;

$this->title = Category::findOne($category)->name . ' - ' . Yii::$app->params['siteName'];
$this->params['breadcrumbs'][] = Category::findOne($category)->name;

?>
<style>
.list-left{
	float:left;
	width:25%;
	background:#ddd;
}
.list-right{
	float:left;
	width:75%;
}
.list-div{
	width:95%;
	margin:20px;
}
.list-ul, .list-ul li{
	float:left;
	width:100%;
}
.list-ul li{
	margin-top:10px;
}
.list-date{
	float:right;
	color:#666;
}
.line{
	float:left;
	border-bottom:1px solid red;
	margin-bottom:20px;
}
</style>
<div class="list-left">
234
</div>
<div class="list-right">
	<div class="list-div">
		<ul class="list-ul">
		<?php
		$i = 0;
		foreach($articles as $a){
			echo '<li>';
				echo '<a href="' . Url::toRoute(['site/show', 'category' => $category, 'id' => $a->articleid]) . '">' . Article::findOne($a->articleid)->title . '</a>';
				echo '<span class="list-date">' . Article::findOne($a->articleid)->updatetime . '</span>';
			echo '</li>' . "\n";
			if($i++ % 6 == 5){
				echo '<li class="line">&nbsp;</li>';
			}
		}
		?>
		</ul>
		<?= LinkPager::widget(['pagination' => $pagination,]) ?>
	</div>
</div>
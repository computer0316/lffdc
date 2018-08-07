<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Datehelper;
use yii\widgets\LinkPager;

use app\models\Article;
use app\models\Category;

$this->title = Category::findOne($category)->name . ' - ' . Yii::$app->params['siteName'];

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
?>
<style>
	.list-left{
		float:left;
		height:830px;
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
	.margin10{
		margin-left:30px;		
	}
	.margin20{
		margin-left:60px;
	}
	.primary-category{
		float:left;
		width:100%;
		text-align:center;
		font-size:20px;
		line-height:48px;
		border-bottom:1px solid #eee;
	}
	.sub-category{
		float:left;
		width:100%;
		line-height:48px;
		border-bottom:1px solid #eee;		
	}
	.sub-category:hover{
		background:#f3f6f9;
	}
</style>
<div class="list-left">
	<?php 
		$curr = Category::findOne($category);
		echo '<p class="primary-category">' . $curr->name . '</p>';
		showSons($category, 1);
		
		function showSons($id, $level){
			$sons = Category::find()->where('fatherid = ' . $id)->all();
			foreach($sons as $son){
				// 控制显示效果
				echo '<p class="sub-category"><span class="margin' . $level * 10 . '">';
				echo  '<a href="' . Url::toRoute(['site/list', 'category' => $son->id]) . '">' . $son->name . '</a>';
				echo '</span></p>';
				showSons($son->id, $level + 1);
			}
		}
	?>
</div>
<div class="list-right">
	<div class="list-div">
		<ul class="list-ul">
		<?php
		$i = 0;
		foreach($articles as $a){
			echo '<li>';
				echo '<a href="' . Url::toRoute(['site/show', 'category' => $category, 'id' => $a->articleid]) . '">' . Article::findOne($a->articleid)->title . '</a>';
				echo '<span class="list-date">' . DateHelper::getDate(Article::findOne($a->articleid)->updatetime) . '</span>';
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
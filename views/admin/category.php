<?php

use yii\helpers\Url;
use app\models\Category;

$this->title = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;

	echo '<table class="table-list" style="width:auto;">';
		echo '<tr class="table-title">';
			echo '<td>顺序</td>';
			echo '<td>ID</td>';
			echo '<td>FatherID</td>';
			echo '<td>名称</td>';
			echo '<td>操作</td>';
		echo '</tr>';
		showSub(-1, 0);
	echo '</table>';

	function showSub($id, $level){
		$cates = Category::find()->where('fatherid = ' . $id)->all();
		if($cates){
			foreach($cates as $cate){
				show($cate, $level);
				showSub($cate->id, $level + 1);
			}
		}
		else{
			return;
		}
	}

	function show($cate, $level){
			echo '<tr>';
				echo '<td>0</td>';
				echo '<td>' . $cate->id . '</td>';
				echo '<td>' . $cate->fatherid . '</td>';
				echo '<td>' . str_pad("", $level * 8, "~") . ($cate->name==null ? $cate->url : $cate->name) . '</td>';
				echo '<td>';
					echo '<a href="' . Url::toRoute(['admin/addcategory', 'id' => $cate->id]) . '">添加</a>';
					echo ' 修改';
					echo ' 删除';
				echo '</td>';
			echo '</tr>';
	}
?>

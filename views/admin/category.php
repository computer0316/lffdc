<?php

use yii\helpers\Url;
use app\models\Category;

$this->title = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;

	echo '<table class="table-list" style="float:left;width:auto;">';
		echo '<tr class="table-title">';
			echo '<td>顺序</td>';
			echo '<td>ID</td>';
			echo '<td>FatherID</td>';
			echo '<td>名称</td>';
			echo '<td>url</td>';
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
				echo '<td>' . str_pad("", $level * 8, "-") . $cate->name . '</td>';
				echo '<td>' . $cate->url . '</td>';
				echo '<td>';
					echo '<a href="' . Url::toRoute(['admin/addcategory', 'id' => $cate->id]) . '">添加</a>';
					echo ' 修改';
					echo ' <a onclick="' . 'javascript:return confirm(' . "'确认要删除“" . $cate->name . "”分类吗？')" . '" href="' . Url::toRoute(['admin/delete-category', 'id' => $cate->id]) . '">删除</a>';
				echo '</td>';
			echo '</tr>';
	}
?>

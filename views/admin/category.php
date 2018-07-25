<?php

use yii\helpers\Url;

$this->title = '栏目管理';
$this->params['breadcrumbs'][] = $this->title;

	echo '<table class="table-list">';
		echo '<tr class="table-title">';
			echo '<td>顺序</td>';
			echo '<td>ID</td>';
			echo '<td>名称</td>';
			echo '<td>操作</td>';
		echo '</tr>';
		foreach($categories as $category){
			echo '<tr>';
				echo '<td>0</td>';
				echo '<td>' . $category->id . '</td>';
				echo '<td>' . $category->name . '</td>';
				echo '<td>';
					echo '<a href="' . Url::toRoute(['admin/addcategory', 'id' => $category->id]) . '">添加</a>';
					echo ' 修改';
					echo ' 删除';
				echo '</td>';
			echo '</tr>';
		}
	echo '</table>';
?>

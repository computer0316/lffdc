<?php


use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(['action' => ['test/getpost'],'method'=>'post',]);

echo '<table class="table-list">';
	echo '<tr class="table-title">';
		echo '<td>用户名</td>';
		echo '<td>手机号</td>';
		echo '<td>所属部门</td>';
		echo '<td>最后登录</td>';
		echo '<td>用户角色</td>';
	echo '</tr>';

	foreach($users as $user){
		echo '<tr>';
			echo '<td>' . $user->name . '</td>';
			echo '<td>' . $user->mobile . '</td>';
			echo '<td>所属部门</td>';
			echo '<td>' . $user->updatetime . '</td>';
			echo '<td>管理员 <a href="' . Url::toRoute(['role/edit', 'userid' => $user->id]) . '">编辑</a></td>';
		echo '</tr>';
	}
echo '</table>';

ActiveForm::end();
?>




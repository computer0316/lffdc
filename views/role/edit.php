<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\helpers\ArrayHelper;
	use yii\widgets\LinkPager;


/* @var $this yii\web\View */

$this->title = '用户角色编辑';
$this->params['breadcrumbs'][] = $this->title;
?>
		<div class="form">
<?php

	$form = ActiveForm::begin();

?>
	<?= $form->field($auth, 'role')->dropDownList(ArrayHelper::map($roles,'name','name')) ?>

	<div class="form-group button-group">
		<div class="control-label">&nbsp;</div>
		<?= Html::submitButton('添加', ['class' => 'submit']) ?>
	</div>

<?php
				ActiveForm::end();
?>
		</div>

<?php
	$auth = Yii::$app->authManager;
	$roles = $auth->getRolesByUser($user->id);
	echo '<p class="tip-red">';
	if(!empty($roles)){
		echo $user->name;
		echo '所属角色：<br />';
		foreach($roles as $role){
			echo $role->name . '<br />';
		}
	}
	else{
		echo $user->name . '还没有分配任何角色';
	}
	echo '</p>';
?>
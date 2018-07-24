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
	$auth = Yii::$app->authManager;

	$form = ActiveForm::begin();

?>
	<?= $form->field($user, 'name')->dropDownList(ArrayHelper::map($roles,'name','name')) ?>

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
	$role = $auth->getRolesByUser($user->id);
	if(!empty($role)){
		echo $user->name . '所属角色：' . $role->name;
	}
	else{
		echo '<p class="tip-red">' . $user->name . '还没有分配任何角色';
	}

?>
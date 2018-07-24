<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;

/* @var $this yii\web\View */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>
		<div class="form">
<?php

				$form = ActiveForm::begin();

?>
				<?= $form->field($auth, 'role')?>

				<div class="form-group button-group">
					<div class="control-label">&nbsp;</div>
					<?= Html::submitButton('添加', ['class' => 'submit']) ?>
				</div>

<?php
				ActiveForm::end();
?>
		</div>

		<ul class="ul-list">
			<?php
			if(isset($roles) && $roles != null){
				foreach($roles as $role){
					echo '<li>' . $role->name . '<a href="' . Url::toRoute(['admin/deleterole', 'name' => $role->name]) . '">删除</a></li>';
				}
			}
			?>
		</ul>



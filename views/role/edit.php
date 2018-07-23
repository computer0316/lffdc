<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\helpers\ArrayHelper;
	use yii\widgets\LinkPager;


/* @var $this yii\web\View */

$this->title = '用户角色编辑';
$this->params['breadcrumbs'][] = $this->title;
	echo '编辑：' . $user->name . ' 角色<br />';

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

		<ul class="ul-list">
			<?php
			if(isset($roles) && $roles != null){
				foreach($roles as $role){
					echo '<li>' . $role->name . '<a href="' . Url::toRoute(['admin/deleterole', 'name' => $role->name]) . '">删除</a></li>';
				}
			}
			?>
		</ul>



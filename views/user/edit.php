<?php
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;
	use yii\captcha\Captcha;

	use app\models\Authority;
	use app\models\Department;
	use app\models\DepartmentUser;
	use app\models\Text;
	// 客户信息窗体


$this->title = '用户编辑';
$this->params['breadcrumbs'][] = $this->title;

?>

		<div class="form">

			<?php $form = ActiveForm::begin() ?>

			<?= $form->field($user, 'name')->textInput(['autofocus' => true]) ?>

			<?= $form->field($du, 'departmentid')->label("&nbsp;")->dropDownList(['0' => '请选择部门'] + ArrayHelper::map(Department::find()->where('id>0')->all(),'id', 'name')) ?>

			<?= $form->field($text, 'name')->label("&nbsp;")->dropDownList(['0' => '请选择角色'] + ArrayHelper::map(Authority::getRoles(), 'name', 'name')) ?>

			<?= $form->field($user, 'id')->hiddenInput()->label(false) ?>

			<div class="form-group button-group">

				<?= Html::submitButton('提交', ['class' => 'submit']) ?>

			</div>

			<?php	ActiveForm::end() ?>
		</div>

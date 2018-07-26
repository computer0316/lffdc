<?php
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;
	use yii\captcha\Captcha;

	use app\models\Department;
	use app\models\DepartmentUser;
	use app\models\Text;
	use app\models\Role;
	// 客户信息窗体


$this->title = '用户编辑';
$this->params['breadcrumbs'][] = $this->title;

?>

		<div class="form">

			<?php $form = ActiveForm::begin() ?>

			<?= $form->field($user, 'name')->textInput(['autofocus' => true]) ?>

			<?= $form->field(new DepartmentUser(), 'departmentid')->label('所属部门')->dropDownList(ArrayHelper::map(Department::find()->where('id>0')->all(),'id', 'name')) ?>

			<?= $form->field(new Text(), 'name')->dropDownList(ArrayHelper::map(Role::find()->where('id>0')->all(),'id', 'name')) ?>

			<?= $form->field($user, 'id')->hiddenInput()->label(false) ?>

			<div class="form-group button-group">

				<?= Html::submitButton('提交', ['class' => 'submit']) ?>

			</div>

			<?php	ActiveForm::end() ?>
		</div>

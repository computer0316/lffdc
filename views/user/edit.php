<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;
	use yii\captcha\Captcha;
	// 客户信息窗体

?>
<style>
	.form-group{
		width:100%;
		margin:20px;
	}
	input {
		width:200px;
		height:35px;
		padding:0 5px;
	}
	.control-label{
		float:left;
		width:100px;
	}
	button{
		margin-left:100px;
	}
</style>

		<div class="form">

			<?php $form = ActiveForm::begin() ?>
			<?= $form->field($user, 'name')->textInput(['autofocus' => true, 'class' => 'menu1']) ?>
			<?= $form->field($user, 'company')?>
		
			<div class="form-group button-group">

				<?= Html::submitButton('提交', ['class' => 'submit']) ?>

			</div>

			<?php	ActiveForm::end() ?>
		</div>

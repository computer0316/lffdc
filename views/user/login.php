<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;
	use yii\captcha\Captcha;
	// 客户信息窗体

?>

	<div class="form1">
		<div class="form">
			<div id="logintitle"><?= Yii::$app->params['siteName'] ?> - 用户登录</div>
<?php

	$form = ActiveForm::begin([
		'id' => 'clientform',
		'enableAjaxValidation'   => false,
    	'enableClientValidation' => false,
	]);

?>

	<?= $form->field($loginForm, 'mobile')->textInput(['autofocus' => true, 'class' => 'menu1']) ?>

	<?= $form->field($loginForm, 'password')->passwordInput() ?>


<div class="form-group button-group">

	<?= Html::submitButton('提交', ['class' => 'submit']) ?>
	<a href="<?= Url::toRoute('user/register') ?>">用户注册</a>

</div>

<?php
	ActiveForm::end();
?>
</div></div>

<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;

	// 客户信息窗体

?>

	<div class="form1">
		<div class="form">
			<div id="logintitle"><?= Yii::$app->params['siteName'] ?> - 用户注册</div>
<?php

	$form = ActiveForm::begin([
		'id' => 'clientform',
	]);

?>

	<?= $form->field($loginForm, 'mobile')->textInput(['autofocus' => true, 'class' => 'menu1']) ?>

	<?= $form->field($loginForm, 'verifyCode') ?>
	<img style="float:left;margin-left:130px;" title="点击刷新" src="<?= Url::toRoute('user/captcha') ?>" align="absbottom" onclick="this.src='<?= Url::toRoute('user/captcha') ?>'+'&'+Math.random();"></img>


<div class="form-group button-group">

	<?= Html::submitButton('提交', ['class' => 'submit']) ?>
	<a href="<?= Url::toRoute('user/login') ?>">登录</a>
</div>

<?php
	ActiveForm::end();
?>
</div></div>

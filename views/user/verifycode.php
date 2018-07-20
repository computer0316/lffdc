<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;
	use yii\captcha\Captcha;
	// 客户信息窗体

?>
<SCRIPT type="text/javascript">
            var maxtime = 6; //一个小时，按秒计算，自己调整!
            function CountDown() {
            	if(maxtime >= 0){
                	document.all["timer"].innerHTML = maxtime;
                	--maxtime;
                }
            }
            timer = setInterval("CountDown()", 1000);
</SCRIPT>

	<div class="form1">
		<div class="form">
			<div id="logintitle"><?= Yii::$app->params['siteName'] ?> - 用户注册</div>
<?php

	$form = ActiveForm::begin(['action' => Url::toRoute('user/get-sms'), 'id' => 'clientform']);
?>

		<?= $form->field($loginForm, 'mobile')->hiddenInput()->label(false) ?>


		<?= $form->field($loginForm, 'smsCode')->textInput(['placeholder' => Yii::$app->session->get('smscode')]) ?>
		<?= $form->field($loginForm, 'password')->passwordInput() ?>
		<?= $form->field($loginForm, 'passwordCompare')->passwordInput() ?>




<div class="form-group button-group">

	<?= Html::submitButton('提交', ['class' => 'submit']) ?>

</div>

<?php
	ActiveForm::end();
?>
</div></div>

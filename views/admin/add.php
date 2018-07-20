<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\redactor\RedactorModule;


$this->title = '添加文章';
$this->params['breadcrumbs'][] = $this->title;

?>

    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->field($model,'title_before'); ?>

		<?php echo $form->field($model,'title')->textInput(['value' => '这里是标题']); ?>

		<?php echo $form->field($model,'title_after'); ?>

		<?php echo $form->field($model,'department')->textInput(['value' => '1']); ?>

		<?php echo $form->field($model,'creater')->textInput(['value' => '1']); ?>

		<?php echo $form->field($model,'updatetime')->textInput(['value' => date("Y-m-d H:i:s", time())]); ?>

<div class="text-area">
		<?= $form->field($model, 'text')->label(false)->widget(\yii\redactor\widgets\Redactor::className(), [
		    'clientOptions' => [
		        'imageManagerJson' => ['/redactor/upload/image-json'],
		        'imageUpload' => ['/redactor/upload/image'],
		        'fileUpload' => ['/redactor/upload/file'],
		        'lang' => 'zh_cn',
		        'plugins' => ['clips', 'fontcolor','imagemanager'],
		        'minHeight' => 400,
		        'maxHeight' => 400,
		        'maxWidth' => 1200,
		    ]
		]) ?>
</div>

        <div class="form-group">
        	<div class="control-label">&nbsp;</div>
                <?= Html::submitButton('提交') ?>
        </div>

    <?php ActiveForm::end(); ?>

	<div>
		<?php  echo $model->text; ?>
	</div>

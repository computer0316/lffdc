<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\ckeditor\CKEditor;

$this->title = '添加文章';
?>
<?php echo $model->text; ?>

    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->field($model,'title_before'); ?>

		<?php echo $form->field($model,'title'); ?>

		<?php echo $form->field($model,'title_after'); ?>

		<?php echo $form->field($model,'department'); ?>

		<?php echo $form->field($model,'creater'); ?>

		<?php echo $form->field($model,'updatetime')->textInput(['value' => date("Y-m-d H:i:s", time())]); ?>

		<?= $form->field($model, 'text')->widget(CKEditor::className(), [
	        'options' => ['rows' => 6],
	        'preset' => 'basic'
	    ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('提交') ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
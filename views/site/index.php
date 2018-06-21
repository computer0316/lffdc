<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<?php echo $model->text; ?>

    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->field($model,'title_before'); ?>

		<?php echo $form->field($model,'title'); ?>

		<?php echo $form->field($model,'title_after'); ?>

		<?php echo $form->field($model,'department'); ?>

		<?php echo $form->field($model,'creater'); ?>

		<?php echo $form->field($model,'text')->widget('yii\widgets\ueditor\UEditor',[]); ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('提交') ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

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

		<?php echo $form->field($model,'text')->widget('yii\widgets\ueditor\UEditor',[
			'clientOptions' => [
		        //编辑区域大小
		        'initialFrameWidth' => '100%',
		        'initialFrameHeight' => '200',
		        //设置语言
		        'lang' =>'zh-cn', //中文为 zh-cn
		        //定制菜单
		        'toolbars' => [
		            [
		                'fullscreen', 'source', 'undo', 'redo', '|',
		                'fontsize',
		                'bold', 'italic', 'underline', '|',
		                'justifyleft', 'justifycenter', 'justifyright', '|',
		                'fontborder', 'strikethrough', 'removeformat',
		                'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
		                'forecolor', 'backcolor', '|',
		                'lineheight', '|',
		                'indent', '|'
		            ],
		        ],
			],
		]); ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('提交') ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
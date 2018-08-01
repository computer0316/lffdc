<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Category;

$this->title = '添加栏目';
$this->params['breadcrumbs'][] = $this->title;

	echo '在 ' . Category::findOne($category->fatherid)->name . ' 下添加栏目：';

?>
<style>
	.control-label[for=category-addmenu]{
		margin-left:110px;
		margin-top:20px;
		width:auto;
	}
	.control-label[for=category-addmenu] input{
		margin:5px;
	}
</style>

    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->field($category,'name')->label('名称')->textInput(['style'=> 'width:100px;']); ?>

		<?php echo $form->field($category,'url')->label('网址')->textInput(['style'=> 'width:600px;']); ?>

		<?php echo $form->field($category,'addmenu')->label('栏目是否出现在导航条')->checkBox(); ?>

		<?php echo $form->field($category,'fatherid')->label(false)->hiddenInput(); ?>



        <div class="form-group">
        	<div class="control-label">&nbsp;</div>
                <?= Html::submitButton('提交') ?>
        </div>

    <?php ActiveForm::end(); ?>

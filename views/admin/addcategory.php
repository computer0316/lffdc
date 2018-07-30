<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->title = '添加栏目';
$this->params['breadcrumbs'][] = $this->title;

	echo '在 ' . $category->name . ' 下添加栏目：';

?>

    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->field($common,'name')->label('名称或者url')->textInput(['style'=> 'width:600px;']); ?>



        <div class="form-group">
        	<div class="control-label">&nbsp;</div>
                <?= Html::submitButton('提交') ?>
        </div>

    <?php ActiveForm::end(); ?>

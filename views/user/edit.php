<?php
	use yii\helpers\Html;
	use yii\helpers\ArrayHelper;
	use yii\widgets\ActiveForm;
	use yii\helpers\Url;
	use yii\widgets\LinkPager;
	use yii\captcha\Captcha;

	use app\models\Authority;
	use app\models\Department;
	use app\models\DepartmentUser;
	use app\models\Text;
	use app\models\Category;
	// 客户信息窗体


$this->title = '用户编辑';
$this->params['breadcrumbs'][] = $this->title;

?>

		<div class="form">

			<?php $form = ActiveForm::begin() ?>

			<?= $form->field($user, 'name')->textInput(['autofocus' => true]) ?>

			<?= $form->field($du, 'departmentid')->label("&nbsp;")->dropDownList(['0' => '请选择部门'] + ArrayHelper::map(Department::find()->where('id>0')->all(),'id', 'name')) ?>

			<?= $form->field($text, 'name')->label("&nbsp;")->dropDownList(['0' => '请选择角色'] + ArrayHelper::map(Authority::getRoles(), 'name', 'name')) ?>

			<?= $form->field($user, 'id')->hiddenInput()->label(false) ?>

<?php
	echo '<table class="table-list" style="width:auto;margin-left:115px;">';
		echo '<tr class="table-title">';
			echo '<td>ID</td>';
			echo '<td>名称</td>';
			echo '<td>选择</td>';
		echo '</tr>';
		showSub(-1, 0, $form);
	echo '</table>';

	function showSub($id, $level, $form){
		$cates = Category::find()->where('fatherid = ' . $id)->all();
		if($cates){
			foreach($cates as $cate){
				show($cate, $level, $form);
				showSub($cate->id, $level + 1, $form);
			}
		}
		else{
			return;
		}
	}

	function show($cate, $level, $form){
			echo '<tr>';
				echo '<td>' . $cate->id . '</td>';
				echo '<td>' . str_pad("", $level * 8, "~") . ($cate->name==null ? $cate->url : $cate->name) . '</td>';
				echo '<td><input type="checkbox" name="checkbox" id="checkbox" value="' . $cate->id . '"></td>' . "\n";
			echo '</tr>';
	}
?>

			<div class="form-group button-group">

				<?= Html::submitButton('提交', ['class' => 'submit']) ?>

			</div>

			<?php	ActiveForm::end() ?>
		</div>
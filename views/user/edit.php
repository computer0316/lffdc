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
	use app\models\Common;
	use app\models\Category;
	// 客户信息窗体


$this->title = '用户编辑';
$this->params['breadcrumbs'][] = $this->title;

?>

		<div class="form">

			<?php $form = ActiveForm::begin() ?>

			<?= $form->field($user, 'name')->textInput(['autofocus' => true]) ?>

			<?= $form->field($du, 'departmentid')->label("&nbsp;")->dropDownList(['0' => '请选择部门'] + ArrayHelper::map(Department::find()->where('id>0')->all(),'id', 'name')) ?>

			<?= $form->field($common, 'name')->label("&nbsp;")->dropDownList(['0' => '请选择角色'] + ArrayHelper::map(Authority::getRoles(), 'name', 'name')) ?>

			<?= $form->field($user, 'id')->hiddenInput()->label(false) ?>

<?php
	echo '<table class="table-list" style="width:auto;margin-left:115px;">';
		echo '<tr class="table-title">';
			echo '<td>ID</td>';
			echo '<td>名称</td>';
			echo '<td>选择</td>';
		echo '</tr>';
		showSub(-1, 0, $form, $common);
	echo '</table>';

	function showSub($id, $level, $form, $common){
		$cates = Category::find()->where('fatherid = ' . $id)->all();
		if($cates){
			foreach($cates as $cate){
				show($cate, $level, $form, $common);
				showSub($cate->id, $level + 1, $form, $common);
			}
		}
		else{
			return;
		}
	}

	function show($cate, $level, $form, $common){
			echo '<tr>';
				echo '<td>' . $cate->id . '</td>';
				echo '<td>' . str_pad("", $level * 8, "~") . ($cate->name==null ? $cate->url : $cate->name) . '</td>';
				if(in_array($cate->id, $common->arr)){
					echo '<td><input type="checkbox" checked name="Common[arr][' . $cate->id . ']" value="' . $cate->id . '"></td>' . "\n";
				}
				else{
					echo '<td><input type="checkbox" name="Common[arr][' . $cate->id . ']" value="' . $cate->id . '"></td>' . "\n";
				}

			echo '</tr>';
	}
?>

			<div class="form-group button-group">

				<?= Html::submitButton('提交', ['class' => 'submit']) ?>

			</div>

			<?php	ActiveForm::end() ?>
		</div>
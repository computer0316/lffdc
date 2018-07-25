<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\models\User;

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/admin.css" />
    <script src="js/jquery-1.12.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="header">
	<p class="logo"><?= Yii::$app->params['siteName'] ?></p>
	<?php
		echo '<p class="login">';
			$user = Yii::$app->user->getIdentity();
			echo $user->name;
			echo '&nbsp;<a href="?r=user/logout">退出</a>';
		echo '</p>';
	?>
</div>
<div class="slide">
	<?php
		showMenu('文章管理', 'account.png');
			showItem('添加文章', 'admin/add');
			showItem('文章列表', 'admin/list');
			showItem('附件管理', 'admin/enclosure');
		showMenu('栏目管理', 'account.png');
			showItem('所有栏目', 'admin/category');
		showMenu('权限管理', 'account.png');
			showItem('用户管理', 'role/user');
			showItem('角色管理', 'role/add');
		showMenu('网站管理', 'account.png');
			showItem('访问记录', 'admin/site');
	?>
</div>
<div class="slideRight">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<?= Alert::widget() ?>
	<div class="content">
		<?= $content ?>
	</div>
</div>

<?php $this->endBody() ?>
</body>
</html>

<?php
	function showItem($name, $action = ''){
		echo '<p class="menuItem">';
			echo '<a href="' . Url::toRoute([$action]) . '">' . $name . '</a>';
		echo '</p>';
	}
	function showMenu($name, $icon){
		echo '<div class="menuDiv">';
			echo '<img src="images/icon/' . $icon . '" />';
			echo '<p>' . $name . '</p>';
		echo '</div>';
	}

	$this->endPage();
	if(Yii::$app->session->hasFlash('message')){
		echo "<script>alert('" . Yii::$app->session->getFlash('message') . "')</script>";
	}
?>
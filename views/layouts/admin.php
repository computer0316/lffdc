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
		if(Yii::$app->user->isGuest){
			echo '<p style="float:right;"><a href="' . Url::toRoute('user/login') . '">登录</a></p>';
		}
		else{
			$user = Yii::$app->user->getIdentity();
			echo '<p style="float:right;">' . $user->name;
			echo '<a href="?r=user/logout">退出</a></p>';
		}
	?>
</div>
<div class="slide">
<a href="<?= Url::toRoute(['admin/add']) ?>">添加文章</a>
</div>
<div class="content">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<?= Alert::widget() ?>

	<?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

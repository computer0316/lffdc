<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" href="css/front.css" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="header">
	<p class="logo"><?= Yii::$app->params['siteName'] ?></p>
</div>
<div class="nav">
<ul>
	<li>首页</li>
	<a href="#"><li>政策法规</li></a>
	<a href="#"><li>房产新闻</li></a>
	<a href="#"><li>群众办事</li></a>
	<a href="#"><li>公示公告</li></a>
</ul>
</div>
<div class="container">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<?= $content ?>
</div>
<footer class="footer">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
</footer>
<?= Alert::widget() ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

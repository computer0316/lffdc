<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

use app\models\Category;

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
	<p class="logo"></p>
</div>
<div class="nav">
<ul>
	<a href="http://www.lffdc.gov.cn"><li>首页</li></a>
	<?php
		$cates = Category::find()->where('fatherid=0 and addmenu=1')->all();
		foreach($cates as $c){
			echo '<a href="' . Url::toRoute(['site/list', 'category' => $c->id]) . '"><li>' . $c->name . '</li></a>';
		}
	?>
</ul>

</div>
<div class="container">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<?= $content ?>
</div>
<footer class="footer">
			<span>&copy; <?= Yii::$app->params['siteName'] ?> <?= date('Y') ?></span>
			<span>政府网站标识码 1310000050</span>
			<span>冀ICP备09050832号-1</span>
			<span><a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=13100302000636">冀公网安备 13100302000636号</a></span>
			<div class="container">
				<!--政府网站找错入口-->
				<script id="_jiucuo_" sitecode='1310000050' src='http://pucha.kaipuyun.cn/exposure/jiucuo.js'></script>
				<!--事业单位网站认证图标-->
				<script type="text/javascript">document.write(unescape("%3Cspan id='_ideConac' %3E%3C/span%3E%3Cscript src='http://dcs.conac.cn/js/05/103/0000/41157126/CA051030000411571260001.js' type='text/javascript'%3E%3C/script%3E"));</script>
			</div>
</footer>
<?= Alert::widget() ?>
<?php $this->endBody() ?>
</body>
</html>

<?php
	$this->endPage();
	if(Yii::$app->session->hasFlash('message')){
		echo "<script>alert('" . Yii::$app->session->getFlash('message') . "')</script>";
	}
?>
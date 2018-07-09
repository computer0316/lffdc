<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use backend\models\BaseRole;
use backend\models\BaseAuthority;
use backend\components\TableWidget;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
td{
	padding:10px 15px;
}
</style>
<div class="content">
<?php
	echo '发送的验证码为：' . $num . '<br />';
	echo '发送到的手机号：' . $mobile;
?>
</div>

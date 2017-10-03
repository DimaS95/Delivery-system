<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<div class="news-item">
    <h2><a href  = "http://popost/admin/delivery/view?id=<?= $model->id ?>"><?= Html::encode($model->title) ?></a></h2>

</div>
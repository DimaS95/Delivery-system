<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<article class="item" data-key="<?= $model->courier_id; ?>">
    <h2 class="title">
        <?= Html::a(Html::encode($model->name), Url::toRoute(['courier/view', 'id' => $model->courier_id]), ['title' => $model->name]) ?>
    </h2>


</article>
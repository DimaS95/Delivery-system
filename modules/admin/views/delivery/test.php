<?php


use app\models\Category;

use app\models\Courier;
use app\models\User;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

$this->title = 'Deliveries';

?>
<div class="delivery-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
<?php
use yii\widgets\DetailView;
?>

<?=

DetailView::widget([
    'model' => $courier,
    'attributes' => [
        'courier_id',
        'name',

        ['label' => 'Total Deliveries',

            'value' => $count

        ],
    ],
]) ?>
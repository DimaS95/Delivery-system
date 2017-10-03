<?php


use app\models\Category;

use app\models\Courier;
use app\models\User;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Deliveries';

?>
<div class="delivery-index">
    <p>
        <?= Html::a('Create Delivery', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            'title',
            'description',
            ['label' => 'Courier',

                'value' => function($data){
                    $model = Courier::find()->where(['courier_id' => $data->courier_id])->one();
                    if($model->name == null){
                        return 'No info yet';
                    }
                    return $model->name;
                }

            ],
            ['label' => 'Category',

                'value' => function($data){
                    $model = Category::find()->where(['category_id' => $data->category_id])->one();
                    if($model->name == null){
                        return 'No info yet';
                    }
                    return $model->name;
                }

            ],
            ['label' => 'Delivered?',
                'value' => function($data){
                    switch($data->isDelivered){
                        case null:
                            return 'No info yet';
                            break;
                        case 1:
                            return 'Failt';
                            break;
                        case 2:
                            return 'Done';
                            break;

                    }
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
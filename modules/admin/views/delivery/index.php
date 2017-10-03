<?php

use app\models\Category;
use app\models\Courier;


use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deliveries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Delivery', ['create'], ['class' => 'btn btn-success']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            ['label' => 'User',

                'value' => function($data){
                    $model = User::find()->where(['id' => $data->user_id])->one();
                    return $model->username;
                }

            ],
            ['label' => 'Category',

                'value' => function($data){
                     $model = Category::find()->where(['category_id' => $data->category_id])->one();
                     return $model->name;
                }

            ],
            ['label' => 'Courier',

                'value' => function($data){
                    $model = Courier::find()->where(['courier_id' => $data->courier_id])->one();
                    return $model->name;
                }

            ],

            ['label' => 'Delivered?',
                'value' => function($data){
                  switch($data->isDelivered){
                      case 0:
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
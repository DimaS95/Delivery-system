<?php

use app\models\Category;
use app\models\Courier;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Delivery */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivery-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
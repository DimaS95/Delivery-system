<?php


namespace app\controllers;


use App\Controller\AppController;
use app\models\Courier;
use app\models\Delivery;
use yii\web\Controller;

class CourierController extends Controller
{
    public function actionView($id){
        $count = (int)Delivery::find()->where(['courier_id' => $id])->count();
        $courier = Courier::find()->where(['courier_id' => $id])->one();
        return $this->render('view', ['courier' => $courier, 'count' => $count]);
    }

}
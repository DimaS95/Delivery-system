<?php
/**
 * Created by PhpStorm.
 * User: Дима
 * Date: 19.09.2017
 * Time: 17:19
 */

namespace app\modules\api\controllers;


use app\models\Delivery;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class DeliveryController extends  ActiveController
{
    public $modelClass = 'app\models\Delivery';

    public function checkAccess($action, $model = null, $params = [])
    {

        if ($action === 'update' || $action === 'delete' || $action === 'view') {
            if ($model->user_id !== \Yii::$app->user->id)
                throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }

    public function actionIndex()
    {
        return new ActiveDataProvider([
            'query' => Delivery::find(),
        ]);
    }
    public function actionView($id)
    {
        return Delivery::findOne($id);
    }
}
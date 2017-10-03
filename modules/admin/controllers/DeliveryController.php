<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\Courier;
use Yii;
use app\models\Delivery;
use app\models\DeliverySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliverapiController implements the CRUD actions for Delivery model.
 */
class DeliveryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Delivery models.
     * @return mixed
     */
    public function actionIndex()
    {


        $searchModel = new DeliverySearch();
       $dataProvider = $searchModel->search(Yii::$app->request->queryParams);




        return $this->render('index', [

            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Delivery model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Delivery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      //  $items = new Category();

       $categories = ArrayHelper::map(Category::find()->all(),'category_id','name');
       $couriers = ArrayHelper::map(Courier::find()->all(),'courier_id','name');

        $model = new Delivery();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if ($model->validate() && $model->save()) {
                return $this->redirect(['index']);
            }
        }
        else
            return $this->render('create',['model'=>$model, 'categories' => $categories, 'couriers' => $couriers]);

    }

    /**
     * Updates an existing Delivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $courier = new Courier();
        $model = $this->findModel($id);
        $categories = ArrayHelper::map(Category::find()->all(),'category_id','name');
        $couriers = ArrayHelper::map(Courier::find()->all(),'courier_id','name');


      /*  if(!Yii::$app->user->can('updateOwnPost',['post'=>$model]))
        {
            throw new ForbiddenHttpException("Вам сюда нельзя :D");

        }
      */

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'couriers' => $couriers
            ]);
        }
    }

    /**
     * Deletes an existing Delivery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionBest()
    {
        $couriers = Courier::find()->all();

        $arr = array("count" => 0, "id" => 0);
        $max = 0;
        foreach ($couriers as $courier){
            $arr["id"] = $courier['courier_id'];
            $arr["count"] = (int)Delivery::find()->where(['courier_id' => $courier['courier_id']])->count();
            if($arr["count"] > $max) {
                $max = $arr["count"];
                $id = $arr["id"];
            }
        }
        $courier = Courier::find()->where(['courier_id' => $id])->one();
        return $this->render('best', ['courier' => $courier]);
    }

    /**
     * Finds the Delivery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Delivery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Delivery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

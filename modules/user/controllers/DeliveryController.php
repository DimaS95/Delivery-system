<?php

namespace app\modules\user\controllers;

use Yii;
use app\models\Delivery;
use app\models\DeliverySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DeliveryController implements the CRUD actions for Delivery model.
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
        $user_id = Yii::$app->user->identity->id;

        //$searchModel = new DeliverySearch();
        // $data = $searchModel->search(Yii::$app->request->queryParams);
        // $data = new Delivery();
        //$dataProvider = Delivery::()->where(['user_id' => $user_id]);
        /* $dataProvider = (new Query())
             ->from('delivery')
             ->where(['user_id' => $user_id]);
         $rows = $dataProvider->all();
        */

        //$data = Delivery::find()->where(['user_id' => $user_id])->all();
        // $dataProvider = new ActiveDataProvider( $data;

        $dataProvider = new ActiveDataProvider([
            'query' => Delivery::find()->where(['user_id' => $user_id])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);



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
        if(!Yii::$app->user->can('viewOwnDeliveries',['post'=>$this->findModel($id)]))
        {
            throw new ForbiddenHttpException("You can view only your deliveries");

        }

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
        $model = new Delivery();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if ($model->validate() && $model->save()) {
                return $this->redirect(['index']);
            }
        }

            return $this->render('create',['model'=>$model]);

    }

    /**
     * Updates an existing Delivery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if(!Yii::$app->user->can('updateOwnPost',['post'=>$model]))
        {
            throw new ForbiddenHttpException("You can edit only your deliveries");

        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        if(!Yii::$app->user->can('deleteOwnDeliveries',['post'=>$this->findModel($id)]))
        {
            throw new ForbiddenHttpException("You can delete only your deliveries");

        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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

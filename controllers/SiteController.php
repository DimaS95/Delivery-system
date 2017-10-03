<?php

namespace app\controllers;

use app\models\Courier;
use app\models\Delivery;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm as Login;
use app\models\ContactForm;
use app\models\Signup;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       // $courier = new Courier();
        $courier = $this->best();
        return $this->render('index', ['best' => $courier['name']]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }
        $model = new Login();
        $request = Yii::$app->getRequest();
        if ($model->load($request->post()) && $model->login()) {




                return $this->redirect('/user/delivery');


        } else {
            return $this->render('login', [
                'model' => $model,
            ]);

        }
    }
    public function actionSignup()
    {
        $model = new Signup();
        $request = Yii::$app->getRequest();
        if ($model->load($request->post())) {
            if ($user = $model->signup()) {
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCouriers(){
        $dataProvider = new ActiveDataProvider([
            'query' => Courier::find(),
        ]);

        return $this->render('couriers', ['dataProvider' => $dataProvider]);
    }

    public function best()
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
        return  $courier;
    }

}

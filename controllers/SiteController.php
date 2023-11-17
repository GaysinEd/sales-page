<?php

namespace app\controllers;

use app\models\User1;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;




class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        //Method N1
        $user = new User1();
//        $user->on(User1::USER_REGISTERED, function (){
//            var_dump('Письмо отправлено');
//        });

        // 1
//        $user->on(User1::USER_REGISTERED, function ($event){
//            var_dump($event->name);
//        });

        //2
//        $user->on(User1::USER_REGISTERED, function ($event){
//            var_dump($event->sender);
//        });

        //3
        $user->on(User1::USER_REGISTERED, function ($event){
            var_dump($event->data);
        }, ['asd' => 'foo']);

        //4
        //handled -прерывает последовательность действий


        $user->on(User1::USER_REGISTERED, function ($event){
            var_dump($event->data);
        }, ['asd' => 'foo']);

//        //Method N2
//        $user->on(User1::USER_REGISTERED, [$user, 'methodFromObject']);
//
//        //Method N3
//        $user->on(User1::USER_REGISTERED, ['app\models\Mail', 'staticMethod']);
//
//        //Method N4
//        $user->on(User1::USER_REGISTERED, 'get_class');

        $user->trigger(User1::USER_REGISTERED);
        die();

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
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

    public function actionTest()
    {
        return $this->render('test.php');
    }

    public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            return $this->render('entry-confirm', ['model'=>$model]);
        } else
        {
            return $this->render('entry', ['model'=>$model]);
        }

    }


}

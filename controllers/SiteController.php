<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Filterkey;
use app\models\Category;
use app\models\Articles;
use app\models\Atribute;


class SiteController extends Controller
{
    public $layout = 'site';
    
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
                'view' => '@app/views/site/my_error_404.php'
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
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
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
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

/*-----------------  list articles  --------------------------*/
    public function actionArticles($id) //id - category.
    {
        $filter = Filterkey::find()
                    ->where(['category_id' => $id])
                    ->andWhere(['enable' => true])->all();

        $model = Articles::find()
            ->where(['category_id' => $id])
            ->all();

        return $this->render('articles',
            [
                'filter' => $filter,
                'model' => $model,
            ]);
    }

    /*-----------------  Test  --------------------------*/
    public function actionTest($id)
    {
        $filter = Filterkey::find()
            ->where(['category_id' => $id])
            ->andWhere(['enable' => true])->all();

        return $this->render('test', ['filter' => $filter]);
        
    }
    /*--------------------------------------------------*/
    public function actionCategory($id) //id - категория.
    {
        $model = Articles::find()
            ->where(['category_id' => $id])
            ->all();


        return $this->render('test',
            ['model' => $model,

            ]);

    }    
    
}

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
        /*----------  боковая панель фильтра  ---------------*/
        $filter = Filterkey::find()
                    ->where(['category_id' => $id])
                    ->andWhere(['enable' => true])->all();

        /*----------  боковая панель фильтра  ---------------*/
        $session = Yii::$app->session;
        $my_array = $session[$filter[0]->category->title]; //массив "категория" в сессии.


        /*----------  вывод списка товаров ----------------------*/
        $model = Articles::find()
            ->where(['category_id' => $id])
            ->all();

        return $this->render('articles',
            [
                'filter' => $filter,
                'model' => $model,
                'my_array' => $my_array,
            ]);
    }

    /*-----------------  Test  --------------------------*/
    public function actionTest()
    {
  
          return $this->render('test');
       
    }
    /*--------------------------------------------------*/
    public function actionCategory($id) //id - категория.
    {
        $model = Articles::find()
            ->where(['category_id' => $id])
            ->all();


        return $this->render('test',
            [
                'model' => $model,
            ]);

    }

    /*------- click on checkbox  ----------------*/
    public function actionCheckbox($category, $key, $value)
    {
        $session = Yii::$app->session;
        /*$session->remove($category);*/
        $my_array = $session[$category]; //массив "категория" в сессии.
         if(isset($my_array[$key])) //есть такой ключ?
           {
             //есть такое значение?
             $id = array_search($value, $my_array[$key]); //пробуем найти его ключ?
             if ($id !== false) //ключ значения существует - удалить пару (ключ-значение).
                { unset($my_array[$key][$id]);
                    if (sizeof($my_array[$key])== 0) {unset($my_array[$key]);} //если пустой ключ - удалить.
                }
            else
                { $my_array[$key][] = $value; } //если значения нет - добавить.
           }
            else //нет такого ключа - создать ключ и значение
           { $my_array[$key][] = $value; }

        $session[$category] = $my_array ; //сохранить изменения в сессию.

        return $this->redirect(Yii::$app->request->referrer);

        /*return $this->redirect(['test',

              'category_id' => $category,
              'key' => $key,
              'value' => $value,

          ]);*/
    }
    public function actionDelsession()
    {
        $session = Yii::$app->session;
        $session->remove('Наушники');

        return $this->redirect(Yii::$app->request->referrer);
    }
}

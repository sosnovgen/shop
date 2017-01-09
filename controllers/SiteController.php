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
        //боковая панель фильтра
        $filter = Filterkey::find()
                    ->where(['category_id' => $id])
                    ->andWhere(['enable' => true])->all();

        //получить переменную сессии по имени категории
        $session = Yii::$app->session;
        $my_array = $session[$filter[0]->category->title]; //массив "категория" в сессии.

       /*--------  вывод списка товаров -------- */
        $model = Articles::find()/**/
            ->where(['category_id' => $id])
            /*->joinWith('atributes')->where(['and', ['key' => 'длина шнура', 'value' => '1,1 метра']])*/
            ->all();

        //есть фильтрация?
        if(!is_null($my_array)) {
            $list = array(); //пустой.

            //Фильтр работает так:
            // 1.Перебирая массив сохранённый в сессии ($my_array) отбираем товар
            //   по условию из таблицы атрибутов пары: ключ->значение в массив $List.
            //   Считаем кол. ключей фильтра ($n).
            // 2.Ищем в массиве повторения и сохраняем в массиве $items [id][кол.повторений].
            // 3.Оставляем только те строки, число повторений которых равно числу ключей
            //   в фильтре, т.е. удовлетворяющих условию всех ключей.
            // 4.Для этого создаём одномерный массив $temp с id отобранных записей.
            // 5.из массива $list копируем отобранные записи в $strings (используя $temp).

            /*-----------------------------------------------------------------*/
            //создать массив строк товаров, отобранных по условию фильтра
            // в $list - отобранные товары.

            $n = 0; //счётчик кол. ключей
            foreach ($my_array as $key => $str) {
                $n = $n + 1;
                foreach ($str as $st) {
                    foreach ($model as $row) {
                        $attr = $row->atributes;
                        foreach ($attr as $atr) {
                            if (($atr->key == $key) and ($atr->value == $st)) {
                                $list[] = $row;
                            }
                        }
                    }
                }
            }
            
            //создание массива: [id][кол.повторений]
            $items = array();
            foreach ($list as $lis) {
                $m = 0;
                foreach ($list as $lip) { //подсчёт повторений строки.
                    if ($lis->id == $lip->id) {
                        $m = $m + 1;
                    }
                }
                $items[$lis->id] = $m; //кол.повторений
            }
            
            
            //создание массива:[id],с числом повторений
            //равных числу ключей фильтра.
            $temp = array();
            foreach ($items as $it => $col) {
                if ($col == $n) {
                    $temp[] = $it; //список отюранных записей товара (их id)
                }
            }

            //из массива $list копируем отобранные записи.
            //(строки товараов отобранных фильтром)
            $strings = array();
            foreach ($list as $row) {
                foreach ($temp as $it){
                    if($row->id == $it){
                        $strings[] = $row;
                    }
                }

            }
        }

        else
            {
                $strings = $model;
            }

        return $this->render('articles',
            [
                'filter' => $filter,
                'model' => $strings,
                'my_array' => $my_array,
            ]);
    }

    /*-----------------  Test  --------------------------*/
    public function actionTest()
    {

          return $this->render('test');
       
    }

    /*-----------------  Cond  --------------------------*/
    public function actionCondition()
    {
        //получить переменную сессии по имени категории
        $session = Yii::$app->session;
        $my_array = $session['Наушники']; //массив "Наушники" в сессии.

        //сформировать строку условия.
        $conditions ='';
        foreach ($my_array as $key => $str) {

            $conditions .= $key.'<br>';
            $val = '';
            foreach ($str as $st){
                $conditions .= '&nbsp; &nbsp;'.$st.'<br>';
            }
        }

        return $this->render('cond', 
            [
                'conditions' => $conditions,

            ]);
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



    /*------- delete  ----------------*/
    public function actionDelsession()
    {
        $session = Yii::$app->session;
        $session->remove('Наушники');

        return $this->redirect(Yii::$app->request->referrer);
    }



    /*------- list of sessions  ----------------*/
    public function actionSes()
    {
        $category = Filterkey::find()
            ->select(['category_id'])
            ->distinct()
            ->all();

        return $this->render('ses',
            [
                'category' => $category,
            ]
        );
    }



}

<?php

namespace app\controllers;

use app\models\Atribute;
use Yii;
use app\models\Filterkey;
use app\models\FilterkeySearch;
use app\models\Filtervalue;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Category;

/**
 * FilterController implements the CRUD actions for Filterkey model.
 */
class FilterController extends Controller
{

    public $layout = 'admin';

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
     * Lists all Filterkey models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FilterkeySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /*----------------------------------------------------------*/
    public function actionView($id) //id - category
    {
        $categories = Category::find() ->orderBy('title')->all();

        if ($id == '-411'){ //411 - признак, показать всё;
            $dataProvider = new ActiveDataProvider([
                'query' => Filterkey::find()/* ->orderBy('key')*/,
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
        } else {

            $dataProvider = new ActiveDataProvider([
                'query' => Filterkey::find() -> where(['category_id' => $id])/*->orderBy('key')*/,
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
        }

          return $this->render('view',
            [
                'dataProvider' => $dataProvider,
                'categories' => $categories,
                'id' => $id,
            ]);
    }


    /*---------------------  create  -----------------------------------*/

    public function actionCreate()
    {
        $param = ['options' =>[ '' => ['Selected' => false]]];

        $plans = Category::find() ->orderBy('title')->all();
        foreach ($plans as $plan):
            $list[$plan ->id] = $plan ->title ;
        endforeach;

        
        //Create the tree catagory
        $cats = array(); //new array

        foreach($plans as $cat) {   //feel it:
            $cats_ID[$cat['id']][] = $cat;
            $cats[$cat['parent_id']][$cat['id']] =  $cat;
        }
        
        /*-------------------------------------------------*/
        $model = new Filterkey();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $atribute = Atribute::find()->where(['category_id' => $model->category_id])
                ->groupBy('key')->all();

            //удалить записи по условию: текущую категорию
            Filterkey::deleteAll(['category_id' => $model -> category_id ]);

            foreach($atribute as $row) {
              $filterkey = new Filterkey();
              $filterkey ->key = $row ->key;
              $filterkey ->category_id = $row ->category_id;
              $filterkey ->save();
            }

            /*return $this->render('test',['filterkey' => $filterkey]);*/


            $dataProvider = new ActiveDataProvider([
                'query' => Filterkey::find() -> where(['category_id' => $model ->category_id]),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);            
            
            return $this->redirect(['filter/view',
                'id' => $model ->category_id,

            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'list' => $list,
                'param' => $param,
                'cats' => $cats,

            ]);
        }
    }

    /**
     * Updates an existing Filterkey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Filterkey model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Filterkey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Filterkey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Filterkey::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

 /*------------------------------------------------------------------------------*/
    public function actionTest($id)
    {
        $keys = Atribute::find() -> where(['category_id' => $id])
            -> andWhere(['<>', 'articles_id' , '-377'])->groupBy('key')->all(); //не равно.

        $dataProvider = new ActiveDataProvider([
            'query' => Atribute::find() -> where(['category_id' => $id])
                -> andWhere(['<>', 'articles_id' , '-377'])->groupBy('key'),
            'pagination' => [
                'pageSize' => 12,
                'sort' => ['key'=>SORT_ASC],
            ],
        ]);


        return $this->render('create',
            [
                'keys' => $keys,
            ]);
        
    }

    /*--------------------------------------------------------------*/
    /*Изменить чекбокс*/
    public function actionCheck($id, $id2)
    {
        $model = $this->findModel($id); //id - FilterKey, id2 - category_id.

        if ($model->enable) {$model->enable = 0;}
         else {$model->enable = 1;}

        $model->save();
        
        return $this->redirect(['view','id' => $id2,]);
        
    }

    /*--------------------------------------------------------------*/
    /*Изменить значение priznak*/
    public function actionType($id, $id2, $id3) //id - filterkey, id2 - category, id3 - priznak.
    {
        $model = $this->findModel($id);
        $model ->priznak = $id3;
        $model->save();

        return $this->redirect(['view','id' => $id2,]);

    }

    /*--------------------------------------------------*/
    /*Перечень значений свойства*/
    public function actionModal($id) //id - 
    {
        $this->layout = false;

        /*$model = Filtervalue::find() ->select(['value'])
            ->where(['filterkey_id' => $id])->all();*/
        $model = $this->findModel($id); //текущая строка FilterKey.
        $category = $model->category_id; //получить текущую категорию.
        $key = $model->key; //получить имя ключа (Key).

        $model = Atribute::find()->select(['value'])
            ->where(['category_id'=>$category])
            ->andWhere(['key'=>$key])
            ->andWhere(['<>', 'articles_id' , '-377']) //исключить шаблон.
            ->groupBy(['value'])
            ->all();


        return $this->render('modal', ['body' => $model]);

    }    
    
}

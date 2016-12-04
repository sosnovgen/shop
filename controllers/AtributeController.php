<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\Articles;
use app\models\Atribute;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


class AtributeController extends \yii\web\Controller
{
    public $layout = 'admin';

    public function actionCreate($id) // id товара. 
    {
        $model = new Atribute();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model -> articles_id = $id; //id товара.
            $article = Articles::findOne($id); //сам товар.
            $model -> category_id = $article -> category_id; //id категории.
            $model->save();

            $dataProvider = new ActiveDataProvider([
                'query' => Atribute::find() -> where(['articles_id' => $id]),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);

            return $this->render('view', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'id' => $id,
            ]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id' => $id,
            ]);
        }
    }

    /*-----------------------------------------------------------*/
    public function actionView($id)
    {
       $attr = Atribute::find() -> where(['articles_id' => $id]) ;
       $col = $attr -> count();
        /*return $this->render('test', ['attr' => $attr]);*/

        if (!empty($col)) {
           $dataProvider = new ActiveDataProvider([
                'query' => $attr,
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
            return $this->render('view', 
                [
                    'dataProvider' => $dataProvider,
                    'id' => $id,
                ]);
        }
        else {
                return $this->redirect(['create', 'id' => $id]);
        }
    }

    /*----------------------------  all -------------------------------*/
    public function actionViewf()
    {
            $dataProvider = new ActiveDataProvider([
                'query' => Atribute::find(),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
            return $this->render('viewf', ['dataProvider' => $dataProvider,]);
    }

    /*-------------------------- template ---------------------------------*/
    public function actionViewt($id)
    {

        $categories = Category::find() ->orderBy('title')->all();
        
        if ($id == '-211'){ //211 - признак, показать всё; 377 - признак шаблона.
            $atribute = Atribute::find() -> where(['articles_id' => '-377'])->all();

            $dataProvider = new ActiveDataProvider([
                'query' => Atribute::find() -> where(['articles_id' => '-377']),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
        } else {
            $atribute = Atribute::find() -> where(['articles_id' => '-377'])
                ->andWhere(['category_id' => $id])->all();

            $dataProvider = new ActiveDataProvider([
                'query' => Atribute::find() -> where(['articles_id' => '-377'])
                           ->andWhere(['category_id' => $id]),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);
        }

        return $this->render('viewt',
            [
                'dataProvider' => $dataProvider,
                'categories' => $categories,
                'atribute' => $atribute,
                'id' => $id,
            ]);
    }

    /*-----------------------------------------------------------*/

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->save();

            return $this->redirect(['view', 'id' => $model->articles_id]);
        } else {
            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

    /*-----------------------------------------------------------*/
    public function actionDelete($id, $id2)
    {
        $model = Atribute::findOne($id);
        $model -> delete();

        return $this->redirect(['view', 'id' => $id2]); //id товара.

    }

    /*-----------------------------------------------------------*/
    protected function findModel($id)
    {
        if (($model = Atribute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Что-то не так.');
        }
    }

    /*-----------------------------------------------------------*/
    public function actionTample($id) //в id - код товара.
    {
        //Удаление старого шаблона.
        $article = Articles::findOne($id); //получить этот товар.
        //удалить записи по условию: код товара "-377" и текущую категорию
        Atribute::deleteAll(['articles_id' => '-377', 'category_id' => $article -> category_id ]);

        //Сохранение нового шаблона.
        $attrs = Atribute::find() -> where(['articles_id' => $id]) -> all();
        foreach ($attrs as $row)
        {
            $model = new Atribute();

            $model->articles_id = '-377'; //id товара - признак шаблона.
            $model->category_id = $row->category_id;
            $model->key = $row->key;
            $model->value = $row->value;
            $model->save();
        }
        Yii::$app->session->setFlash('success', 'Шаблон сохранён!');

        return $this->redirect(['view', 'id' => $id]); //id товара.

    }
    /*-----------------------------------------------------------*/
    public function actionLoad($id) //в id - код товара.
    {
        //Удалить все атрибуты.
        $article = Articles::findOne($id); //получить этот товар.
        //удалить записи по условию: код товара и текущую категорию
        Atribute::deleteAll(['articles_id' =>$id, 'category_id' => $article -> category_id ]);

        //Загрузить новый шаблон.
        $attrs = Atribute::find() -> where(['category_id' => $article -> category_id])
                                  -> andWhere(['articles_id' => '-377'])-> all();

        foreach ($attrs as $row) //сохранить в БД с id товара.
        {
            $model = new Atribute();

            $model->articles_id = $id; //id товара
            $model->category_id = $row->category_id;
            $model->key = $row->key;
            $model->value = $row->value;
            $model->save();
        }
        /*return $this->render ('test',['attr' => $attrs]);*/

        if (count($attrs)>0)
        { Yii::$app->session->setFlash('success', 'Шаблон загружен!'); }
        else
        {Yii::$app->session->setFlash('warning', 'Шаблон не найден!'); }

        return $this->redirect(['view', 'id' => $id]); //id товара.
    }

}

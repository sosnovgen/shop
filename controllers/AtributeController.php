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

    public function actionCreate($id)
    {
        $model = new Atribute();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model -> articles_id = $id; //id товара.
            $article = Articles::findOne($id);
            $model -> category_id = $article -> category_id; //id категории.
            $model->save();

            $dataProvider = new ActiveDataProvider([
                'query' => Atribute::find() -> where(['articles_id' => $id]),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);

            return $this->render('view', ['model' => $model, 'dataProvider' => $dataProvider,]);
        } else {
            return $this->render('create', [
                'model' => $model,

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
                    'pageSize' => 20,
                ],
            ]);
            return $this->render('view', ['dataProvider' => $dataProvider,]);
        }
        else {
                return $this->redirect(['create', 'id' => $id]);
        }
    }

    /*-----------------------------------------------------------*/
    public function actionViewf()
    {
            $dataProvider = new ActiveDataProvider([
                'query' => Atribute::find(),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ]);
            return $this->render('viewf', ['dataProvider' => $dataProvider,]);
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

    public function actionAdd()
    {
        return $this->redirect('create');
    }

}

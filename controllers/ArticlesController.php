<?php

namespace app\controllers;

use app\models\Category;
use Yii;
use app\models\Articles;
use app\models\Atribute;
use app\models\ArticlesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class ArticlesController extends \yii\web\Controller
{
    public $layout = 'admin';

    /*--------------------------------------------------------*/
    public function actionCreate()
    {
        // configure with favored image driver (gd by default)
        Image::configure(array('driver' => 'GD'));

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

        $model = new Articles();
        if ($model->load(Yii::$app->request->post()) && $model->validate())  {

            $fileName = UploadedFile::getInstance($model, 'preview');
            if ($fileName !== null) {

                $img_root = 'images/articles/';

                $model->preview = $fileName;
                $model->preview->saveAs($img_root . $fileName);
                $model->preview = $img_root . $fileName;

                $img = Image::make($img_root . $fileName);
                $img->resize(300, 300);
                $img->save($img_root . $fileName);
            }

            $model->save();

            $dataProvider = new ActiveDataProvider([
                'query' => Articles::find(),
                'pagination' => [
                    'pageSize' => 14,
                ],
            ]);

            return $this->redirect(['viewt','id' => $model->category_id ]); //показать всё.

        }
        else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('create',
                [
                    'model' => $model,
                    'list' => $list,
                    'param' => $param,
                    'cats' => $cats,
                ]);
        }
    }

   /*-----------------------------------------------------------*/
    public function actionView()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Articles::find(),
                'pagination' => ['pageSize' => 20,],
        ]);

        return $this->render('view',
            [
                'dataProvider' => $dataProvider,

            ]);
    }

   /*------------------------ SortCategory -----------------------------*/
    public function actionViewt($id) //id - индекс категории
    {
        $categories = Category::find() ->orderBy('title')->all();

        if ($id == '-211'){ //211 - признак, показать всё;
            $articles = Articles::find()->all();

            $dataProvider = new ActiveDataProvider([
                'query' => Articles::find(),
                'pagination' => [
                    'pageSize' => 14,
                ],
            ]);
        } else {

            /*$articles = Articles::find() -> where(['category_id' => $id])->all();*/
            $dataProvider = new ActiveDataProvider([
                'query' => Articles::find() -> where(['category_id' => $id]),
                'pagination' => [
                    'pageSize' => 14,
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
    

   /*-------------------------------------------------------------*/
    public function actionDelete($id){

        $model = Articles::findOne($id);

        $fileName = ($model -> preview);
        //$fileName = mb_substr($fileName,1);
        if (is_file($fileName))
        {
            unlink($fileName);
        }
        $model -> delete();

        //Удалить атрибуты этого товара.
        Atribute::deleteAll(['articles_id' => $id]);

        return  $this->redirect(['articles/viewt', 'id' => '-211']);

    }


    public function actionIndex()
    {

        return  $this->redirect(['articles/viewt', 'id' => '-211']); //показать всё
    }

    
   /*--------------------------------------------------*/
    protected function findModel($id)
    {
        if (($model = Articles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не существует.');
        }
    }
    
    /*--------------------------------------------------*/
    public function actionUpdate($id){

        $model = $this->findModel($id);
        $oldFileName = $model->preview;

        $param = ['options' =>[ $model ->id => ['Selected' => true]]];

        $plans = Category::find() ->all();
        foreach ($plans as $plan):
            $list[$plan ->id] = $plan ->title ;
        endforeach;

        //Create the tree catagory
        $cats = array(); //new array
        foreach($plans as $cat) {   //feel it:
            $cats_ID[$cat['id']][] = $cat;
            $cats[$cat['parent_id']][$cat['id']] =  $cat;
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $fileName = UploadedFile::getInstance($model, 'preview');

            if ($fileName !== null) {
                if (is_file($oldFileName)){
                    unlink($oldFileName);
                }

                $img_root = 'images/articles/';

                $model->preview = $fileName;
                $model->preview->saveAs($img_root . $fileName);
                $model->preview = $img_root . $fileName;

                $img = Image::make($img_root . $fileName);
                $img->resize(300, 300);
                $img->save($img_root . $fileName);
            }
            else{
                $model->preview = $oldFileName;
            }
            $model->save();

            return $this->redirect(['viewt', 'id' => '-211']); //показать всё

        } else {
            return $this->render('create',
                [
                'model' => $model,
                'list' => $list,
                'param' => $param,
                'cats' => $cats,
            ]);
        }
    }

    /*--------------------------------------------------*/
    public function actionModal($id)
    {
        $this->layout = false;

        $model = Articles::findOne($id);
        $body = $model ->body;
        
        return $this->render('modal', ['body' => $body]);

    }

}
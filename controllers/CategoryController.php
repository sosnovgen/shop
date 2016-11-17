<?php

namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class CategoryController extends \yii\web\Controller
{
    public $layout = 'admin';
    
    public function actionCreate()
    {
        // configure with favored image driver (gd by default)
        Image::configure(array('driver' => 'GD'));

        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $fileName = UploadedFile::getInstance($model, 'preview');

            if ($fileName !== null) {
                $img_root = 'images/category/';

                $model->preview = $fileName;
                $model->preview->saveAs($img_root . $fileName);
                $model->preview = $img_root . $fileName;


                $img = Image::make($img_root . $fileName);
                $img->resize(300, 300);
                $img->save($img_root . $fileName);
            }
            $model->save();


            $dataProvider = new ActiveDataProvider([
                'query' => Category::find(),
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
    public function actionView()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('view', ['dataProvider' => $dataProvider,]);
    }

   /*-----------------------------------------------------------*/    
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFileName = $model->preview;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $fileName = UploadedFile::getInstance($model, 'preview');
            if ($fileName !== null) {
                $img_root = 'images/category/';

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

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

   /*-----------------------------------------------------------*/
    public function actionDelete($id)
    {
        $model = Category::findOne($id);

        $fileName = ($model -> preview);
        //$fileName = mb_substr($fileName,1);
        if (is_file($fileName))
        {
            unlink($fileName);
        }

        $model -> delete();

        return $this->redirect('view');
    }
    
  /*-----------------------------------------------------------*/ 
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Этой страницы не существует.');
        }
    }
    
    
}
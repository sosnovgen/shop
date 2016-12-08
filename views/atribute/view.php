<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\Category;
use app\models\Articles;

?>
<button type="button" class="close" onclick="history.back();">&times;</button>

    <div class="row capture">
       <div class="col-md-8" >
            <h3 class="text-center">Атрибуты товара "<?php $article = Articles::findOne($id); echo $article ->title ?>"</h3>
       </div>
       <div class="col-md-3" style="padding-top: 16px;">
           <?= Html::a('Сохранить как шаблон', ['atribute/tample', 'id' => $id], ['class'=>'btn btn-default btn-block']) ?>
       </div>
        <div class="col-md-1"></div>
    </div>


<?php if (Yii::$app ->session ->hasFlash('success')){echo '<div class="alert alert-info fade in">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>' . Yii::$app ->session ->getFlash('success') .'</strong></div>';}
?>

<div class="table-responsive">

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        /*'id:text:id',*/
        /*'articles.title:text:Товар',*/
        'category.title:text:Категория',
        'key:text:Свойство',
        'value:text:Значение',
 
        [
            'label' => 'Создано',
            'attribute' => 'created_at',
            'format' =>  ['date', 'dd.MM.YYYY'],
            'options' => ['width' => '80'],
        ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Действия',
            'headerOptions' => ['width' => '60'],
            'template' => '{add} {update} {delete}{link}',
            'buttons' => [
                'add' => function($url, $model){
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', ['create', 'id' => $model->articles_id], [
                        'class' => '',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]);
                },

                'delete' => function($url, $model){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id, 'id2' => $model->articles_id], [
                        'class' => '',
                        'data' => [
                            'confirm' => 'Удалить запись?',
                            'method' => 'post',
                        ],
                    ]);
                }
            ]
        ],

    ],
    // ...

]);

?>
</div>

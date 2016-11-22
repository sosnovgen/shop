<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\Category;

?>

    <div class="row capture">
        <h3 class="text-center">Атрибуты</h3>
    </div>

<div class="table-responsive">

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        /*['class' => 'yii\grid\SerialColumn'],*/
        'id:text:id',
        'articles.title:text:Товар',
        'key:text:key',
        'value:text:value',
 
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

<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\Category;

?>
<button type="button" class="close" onclick="history.back();">&times;</button>

<div class="row capture">
    <h3 class="text-center">Атрибуты (full)</h3>
</div>

<div class="table-responsive">

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            /*['class' => 'yii\grid\SerialColumn'],*/
            'id:text:id',
            /*'articles.title:text:Товар',*/
            'category.title:text:Категория',

            [
                'label' => 'Товар',
                'attribute' => 'articles_id',
                'value' => function ($model){
                    if($model-> articles_id =='-377'){
                        return 'Шаблон';
                    }
                    else{
                        return $model-> articles -> title;
                    }
                },
            ],

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
                'template' => '{update} {delete}{link}',
                'buttons' => [
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
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
<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

?>
<button type="button" class="close" onclick="history.back();">&times;</button>
    <div class="row capture">
        <h3 class="text-center">Товары</h3>
    </div>

<div class="table-responsive">

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        /*['class' => 'yii\grid\SerialColumn'],*/
        'id:text:id',
        [
            'label' => 'Картинка',
            'format' => 'raw',
            'contentOptions'=>['width' => '80'],
            'value' => function($data){
                return Html::img(Url::toRoute($data -> preview),[
                    'alt'=>'',
                    'style' => 'width:40px; height:40px;'
                ]);
            },
        ],
        
        'title:text:Название',
        'category.title:text:Категория',
         'group_id:text:Группа',
        
        [
            'label' => 'Описание',
            'attribute' => 'body',
            'value' => function ($data) {
                return StringHelper::truncate($data->body, 100);
            }
        ],
        
        'cena:text:цена',
        
        /*'created_at:date:Создано',*/
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
                    return Html::a('<span class="glyphicon glyphicon-font"></span>', ['atribute/view','id'=> $model->id],  [
                        'class' => '',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]);
                },

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

]);

?>
</div>

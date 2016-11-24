<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;

?>
<button type="button" class="close" onclick="history.back();">&times;</button>

<div class="row capture">
    <div class="col-md-8" >
        <h3 class="text-center" style="padding-top:12px;">Товары</h3>
    </div>
    <div class="col-md-3" style="padding-top: 16px;">
        <label for="category_id">Выбрать категорию</label>
        <select onchange="window.location.href=this.options[this.selectedIndex].value" name="category_id" class="form-control" id="select_cat">
            <option value="<?php echo Url::toRoute(['articles/viewt','id' => '-211']); ?>"  >Все</option>

            <?php foreach($categories as $row):?>

                <option value="<?php echo Url::toRoute(['articles/viewt','id'=> $row ->id])?>"
                    <?php  if ($id != '-211'): ?>

                        <?php if ($id == $row ->id)
                        {echo ' selected';} ?>

                    <?php endif ?>
                ><?php echo $row ->title ?>

                </option>

            <?php endforeach;?>

        </select>
    </div>
    <div class="col-md-1"></div>
</div>
<br>

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

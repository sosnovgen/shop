<?php
use yii\data\ActiveDataProvider;
use \yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\Category;
use app\models\Articles;
use yii\bootstrap\Modal;

?>
<button type="button" class="close" onclick="history.back();">&times;</button>

<div class="row capture">
    <div class="col-md-8" >
        <h3 class="text-center" style="padding-top:12px;">Фильтр</h3>
    </div>
    <div class="col-md-3 capture" style="padding-top: 16px;">
        <label for="category_id">Выбрать категорию</label>
        <select onchange="window.location.href=this.options[this.selectedIndex].value" name="category_id" class="form-control" id="select_cat" onfocus='this.size=16;'
                 onchange='this.size=1; this.blur();' style="position: absolute">
            <option value="<?php echo Url::toRoute(['filter/view','id' => '-411']); ?>"  >Все</option>

            <?php foreach($categories as $row):?>

                <option value="<?php echo Url::toRoute(['filter/view','id'=> $row ->id])?>"
                    <?php  if ($id != '-411'): ?>

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
            ['class' => 'yii\grid\SerialColumn'],
            /*'id:text:id',*/
            /*'articles.title:text:Товар',*/
            'category.title:text:Категория',
            'key:text:Свойство',
            /*'value:text:Значение',*/
            [
                'label' => 'Параметры',
                'format' => 'raw',
                'value' => function($data){
                    return  Html::a(Yii::t('app', ' {modelClass}', [
                        'modelClass' => 'Список',
                    ]), ['filter/modal','id'=>$data->id], ['class' => 'btn btn-default popupModal2']);
                }
            ],            
            
            [
                'label' => 'Тип',
                'attribute' => 'priznak',
                'value' => function ($model, $id, $index, $column) {
                    return Html::activeDropDownList($model, 'priznak',
                        Array(
                            '0'=>'Перечень',
                            '1'=>'Диапазон',
                            '2'=>'Больше'),
                        [
                            'class' => 'drop',
                            'Selected' => $model->priznak,
                            'data-c' => $model->id,
                            'data-d' => $model->category_id,
                            
                        ]

                    );
                },
                'format' => 'raw',
                'filter' => Array('0'=>'Перечень', '1'=>'Диапазон', '2'=>'Больше'),
            ],

            [
                'label' => 'Вкл.',
                'attribute' => 'enable',
                'format' => 'raw',
                'value' => function ($model, $index, $widget) {
                return Html::checkbox('hide[]', $model->enable,
                    [
                        'class' => 'check',
                        'data-c' => $model->id,
                        'data-d' => $model->category_id,
                    ]);
                },
            ],
            /*[
                'label' => 'Создано',
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.YYYY'],
                'options' => ['width' => '80'],
            ],*/



        ],
        // ...

    ]);
    ?>
 <?php
    Modal::begin([
        'header' => '<i style="font-size: 1.2em;">Список папраметров</i>',
        'id'=>'modal2',
        'class' =>'modal',
        'size' => 'modal-md',
    ]);
    
    Modal::end();

 ?>

</div>

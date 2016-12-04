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
    <div class="col-md-8" >
        <h3 class="text-center" style="padding-top:12px;">Шаблоны</h3>
    </div>
    <div class="col-md-3" style="padding-top: 16px;">
        <label for="category_id">Выбрать категорию</label>
        <select onchange="window.location.href=this.options[this.selectedIndex].value" name="category_id" class="form-control" id="select_cat"
                onfocus='this.size=16;' onblur='this.size=1;' onchange='this.size=1; this.blur();' style="position: absolute">
            <option value="<?php echo Url::toRoute(['atribute/viewt','id' => '-211']); ?>"  >Все</option>

            <?php foreach($categories as $row):?>

                <option value="<?php echo Url::toRoute(['atribute/viewt','id'=> $row ->id])?>"
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
            ['class' => 'yii\grid\SerialColumn'],
            /*'id:text:id',*/
            'category.title:text:Категория',
            'key:text:Свойство',
            'value:text:Значение',

            [
                'label' => 'Создано',
                'attribute' => 'created_at',
                'format' =>  ['date', 'dd.MM.YYYY'],
                'options' => ['width' => '80'],
            ],

           /* [
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
            ],*/

        ],
        // ...

    ]);

    ?>
</div>
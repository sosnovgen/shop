<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<button type="button" class="close" onclick="history.back();">&times;</button>
<div class="col-md-8">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row capture">
        <h3>Товар</h3>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title')->textInput()->label('Название'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'preview')->fileInput(['class' => 'filestyle', 'data-buttonText'=> 'Выбрать'])->label('Картинка'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'category_id')->dropDownList($list, $param)->label('Категория'); ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'group_id')->dropDownList([

                'Обычная' => 'Обычная',
                'Новинка' => 'Новинка',
                'Акция' => 'Акция',
                'Распродажа' => 'Распродажа',
                'Уценка' => 'Уценка',

            ])->label('Группа'); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'cena')->textInput()->label('Цена'); ?>
        </div>
    </div>

    <!----------------------------- описание товара ---------------------------------->
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" style="font-weight: bold; font-size: 0.9em;" href="#collapse1">Описание товара</a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">

                    <span class="small pull-right">* Перенос строки клавиши: Shift + Enter </span>
                    <?= $form->field($model, 'body')-> textArea(['rows' => '6','id' => 'editor']) -> label(''); ?>

                </div>
            </div>
        </div>
    </div>

    <!----------------------------- Meta ---------------------------------->
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" style="font-weight: bold; font-size: 0.9em;" href="#collapse2">Meta</a>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'meta_description')->textInput()->label('description'); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'meta_keywords')->textInput()->label('keywords'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!----------------------------- Атрибуты ---------------------------------->
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" style="font-weight: bold; font-size: 0.9em;" href="#collapse3">Атрибуты</a>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">

                        <a href="<?php echo Url::toRoute(['atribute/create', 'id' => 123])?>" >Создать атрибут</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="col-md-4">
    <div class="description small">
        <p>* Здесь можно добавить/отредактировать товар.</p>
         <p>* Размер картинки примерно 300Х300.</p>

        <p>    * Перенос строки: "Shift + Enter". </p>
        <p>    * После вставки чужого текста очистите форматирование:
            <br>   "Format -> Clear formatting".
        </p>
    </div>
</div>
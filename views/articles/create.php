<?php

use yii\helpers\Html;
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

    <span class="small pull-right">* Перенос строки клавиши: Shift + Enter </span>
    <?= $form->field($model, 'body')-> textArea(['rows' => '6','id' => 'editor']) -> label('Текст'); ?>

    <h2>Meta</h2>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'meta_description')->textInput()->label('description'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'meta_keywords')->textInput()->label('keywords'); ?>
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
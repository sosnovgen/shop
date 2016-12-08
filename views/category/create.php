<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<button type="button" class="close" onclick="history.back();">&times;</button>
<div class="col-md-9">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row capture">
        <h3>Категория</h3>
    </div>

    <br>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'title')->textInput()->label('Название'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList($list, $param)->label('Родитель'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'preview')->fileInput(['class' => 'filestyle', 'data-buttonText'=> 'Выбрать'])->label('Картинка'); ?>
        </div>
        
    </div>
<br>
    <span class="small pull-right">* Перенос строки клавиши: Shift + Enter </span>
    <?= $form->field($model, 'body')-> textArea(['rows' => '6','id' => 'editor']) -> label('Краткое описание'); ?>

    <br>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="col-md-3">
    <div class="description small">
        <p>* Здесь можно добавить/отредактировать категорию товара.</p>
        <p>* Можно создавать вложенные категории, для этого нужно указать родительскую категорию.</p>
        <p>* Дерево категорий можно просмотреть в пункте меню: "Дерево".</p>
        <p>* Размер картинки примерно 300Х300.</p>
        <p>* Перенос строки: "Shift + Enter". </p>
        <p>* После вставки чужого текста очистите форматирование:
            <br>   "Format -> Clear formatting".
        </p>
    </div>
</div>
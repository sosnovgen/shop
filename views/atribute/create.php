<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<button type="button" class="close" onclick="history.back();">&times;</button>
<div class="col-md-8">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row capture">
        <h3>Атрибуты</h3>
    </div>

    <br>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'key')->textInput()->label('Свойство'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'value')->textInput()->label('Значение'); ?>
        </div>
        <div class="col-md-4">

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
        <p>* Здесь можно добавить/отредактировать атрибуты товара (цвет, размер, вес, и т.п.).</p>

    </div>
</div>
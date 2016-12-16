<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Articles;
?>

<button type="button" class="close" onclick="history.back();">&times;</button>

<div class="col-md-8">

<?php if (Yii::$app ->session ->hasFlash('success'))
            {echo '<div class="alert alert-info fade in" style="margin-top: 22px; ">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>' . Yii::$app ->session ->getFlash('success') .'</strong></div>';}
      if (Yii::$app ->session ->hasFlash('warning'))
            {echo '<div class="alert alert-warning fade in" style="margin-top: 22px; ">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>' . Yii::$app ->session ->getFlash('warning') .'</strong></div>';}

?>

    <?php $form = ActiveForm::begin(); ?>
<br>
    <div class="row">
        <span style="font-size: 1.2em"; >Атрибут товара "<?php $article = Articles::findOne($id); echo $article ->title." (id=". $article ->id.")" ?>"</span>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'key')->textInput()->label('Свойство'); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'value')->textInput()->label('Значение'); ?>
        </div>

    </div>
<br><br>
    <div class="row" style="margin-bottom: 12px; padding-left: 14px;">
        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary load-bt']) ?>
            <?= Html::a('Загрузить шаблон', ['atribute/load', 'id' => $id ], ['class'=>'btn btn-default load-bt']) ?>
            
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>

<div class="col-md-4">
    <div class="description small">
        <p>* Здесь можно добавить/отредактировать атрибуты товара (цвет, размер, вес, и т.п.).</p>
        <p>* Атрибуты одной категории товаров схожи, поэтому можно использовать для их заполнения шаблон.</p>
        <p>* Для каждой категории товаров можно создать один шаблон. Выбирается товар нужной категории, затем
            переходим по кнопке "А" в столбце "Действие" в окно "Атрибуты товара" -> "Сохранить как шаблон".</p>
        <p>* Затем можно заполнять атрибуты, загрузив их из шабона ("Загрузить шаблон") с последующим редактированием отдельных полей.</p>
    </div>
</div>



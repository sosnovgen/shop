<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
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
            <?= $form->field($model, 'category_id')->dropDownList($list, $param)->label(Html::a("Категории", ['#treeModal'], ['data-toggle'=>'modal'] ));?>
           
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

    <br>



    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div class="col-md-4">
    <div class="description small">
        <p>* Здесь можно добавить/отредактировать товар.</p>
        <p>* Сначала нужно заполнить поля и сохранить товар, затем, перейдя в окно просмотра "Товар->Показать всё"
            добавить свойства товара ("А" кнопка в столбце "Деёствия"). </p>
        <p>* Размер картинки примерно 300Х300.</p>
        <p>* Перенос строки: "Shift + Enter". </p>
        <p>* После вставки чужого текста очистите форматирование:
            <br>   "Format -> Clear formatting".
        </p>
    </div>
</div>

<!------------- Modal ----------------->
<div class="modal fade" id="treeModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Выберите категорию</h4>
            </div>
            <div class="modal-body">

    <!------------------ Content ------------------------->
            <?php
                function build_tree($cats,$parent_id,$only_parent = false){
                    if(is_array($cats) and isset($cats[$parent_id])){
                        $tree = '<ul>';
                        if($only_parent==false){
                            foreach($cats[$parent_id] as $cat){
                                /*$st = Url::toRoute(['articles/entercat', 'id' => $cat['id']]);
                                $tree .= '<li><a href="'.$st.'">'.$cat['title'];*/
                                $tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];
                                $tree .=  build_tree($cats,$cat['id']);
                                $tree .= '</a></li>';
                            }
                        }elseif(is_numeric($only_parent)){
                            $cat = $cats[$parent_id][$only_parent];
                            /*$st = Url::toRoute(['articles/entercat', 'id' => $cat['id']]);
                            $tree .= '<li><a href="'.$st.'">'.$cat['title'];*/
                            $tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];
                            $tree .=  build_tree($cats,$cat['id']);
                            $tree .= '</a></li>';
                        }
                        $tree .= '</ul>';
                    }
                    else return null;
                    return $tree;
                }


                echo build_tree($cats,0);
            ?>

            <!------------------ /Content ------------------------->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
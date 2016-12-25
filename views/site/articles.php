<?php
use yii\helpers\Url;
use app\models\Atribute;

?>

<div class="login">
    <div class="wrap">
        <div class="rsidebar span_1_of_left">

            <section  class="sky-form">
              <?php foreach ($filter as $row): ?>
                            <h4><?php echo $row->key ?></h4>
                            <div class="row row1 scroll-pane">
                                <div class="col col-4">
                                    <?php
                                    $value = Atribute::find()
                                        ->where(['category_id'=>$row->category_id])
                                        ->andWhere(['key'=>$row->key])
                                        ->groupBy('value')
                                        ->all();
                                    ?>

                                    <?php foreach ($value as $st): ?>
                                        <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>

                                            <?php echo $st->value ?>  &nbsp;(

                                            <?php $kol = Atribute::find()
                                                ->where(['category_id'=>$st->category_id]) //category
                                                ->andWhere(['value'=>$st->value]) //key
                                                ->andWhere(['<>', 'articles_id' , '-377']) //исключить шаблон.
                                                ->count();
                                            echo $kol; //кол.
                                            ?>

                                            )</label>

                                    <?php endforeach;  ?>

                    </div>
                </div>
              <?php endforeach;  ?>
            </section>


        </div>

        <div class="clear"></div>
    </div>
</div>


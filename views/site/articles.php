<?php
use yii\helpers\Url;
use app\models\Atribute;

?>

<div class="login">
    <div class="wrap">
        <div class="col-md-3">
            <div class="sb-filter">

                <section  class="sb-section">
                    <?php foreach ($filter as $row): ?>
                        <div class="check-input">
                            <h4><?php echo $row->key ?></h4>

                            
                            <?php
                                $value = Atribute::find()
                                    ->where(['category_id'=>$row->category_id])
                                    ->andWhere(['key'=>$row->key])
                                    ->groupBy('value')
                                    ->all();
                                ?>
                            <ul>
                                <?php foreach ($value as $st): ?>
                                  <li><label class="input-box"><input type="checkbox" name="checkbox" >

                                        <?php echo $st->value ?>  &nbsp;(

                                        <?php $kol = Atribute::find()
                                            ->where(['category_id'=>$st->category_id]) //category
                                            ->andWhere(['value'=>$st->value]) //key
                                            ->andWhere(['<>', 'articles_id' , '-377']) //исключить шаблон.
                                            ->count();
                                        echo $kol; //кол.
                                        ?>

                                        )</label></li>

                                <?php endforeach;  ?>
                            </ul>
                        </div>



                    <?php endforeach;  ?>
                </section>


            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="">
                    <?php foreach ($model as $row): ?>
                        <table class="table small" style="margin-bottom: 0;">
                            <tr>
                                <td><?php echo $row->id;  ?></td>
                                <td><?php echo $row->title;  ?></td>
                                <td><?php echo $row->cena;  ?></td>
                            </tr>
                        </table>
                            <?php $attr = $row ->atribute; ?>
                            <?php foreach ($attr as $atr): ?>
                            <table class="table small" style="margin-bottom: 0;width: 30%">
                                <tr>
                                    <td><?php echo $atr->key;  ?></td>
                                    <td><?php echo $atr->value;  ?></td>
                                </tr>
                            </table>

                        <?php endforeach; ?>
                    <?php endforeach; ?>

                </div>
            </div>



        </div>

        <div class="clear"></div>
    </div>
</div>


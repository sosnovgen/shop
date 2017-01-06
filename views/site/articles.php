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
                                  <li><label class="input-box"><input type="checkbox" name="checkbox-sb"
                                              <?php if(isset($my_array[$row->key])) //есть такой ключ?
                                              { //есть такое значение?
                                                  $id = array_search($st->value, $my_array[$row->key]); //пробуем найти его ключ?
                                                  if ($id !== false) //ключ значения существует - выводим "птичку".
                                                  {
                                                      echo('checked');
                                                  }
                                              }?>
                                            data-category = "<?php echo $row->category->title ?>"
                                            data-key = "<?php echo $row->key ?>"
                                            data-value ="<?php echo $st->value ?>"
                                        >

                                        <?php echo $st->value ?>  &nbsp;(

                                        <?php $kol = Atribute::find()
                                            ->where(['category_id'=>$st->category_id]) //category
                                            ->andWhere(['value'=>$st->value]) //value
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
<?php 


?>
        <div class="col-md-9">

            <?php  if (sizeof($model))
            {echo ('<div class="menu-sort">
                        <div class="menu-sort-by">
                            <label>Sort By</label>
                            <select>
                                <option value="">
                                    Популярное               </option>
                                <option value="">
                                    Цена : От высокой к низкой               </option>
                                <option value="">
                                    Цена : От низкой к высокой               </option>
                            </select>
                            <a href=""><img src="'.Url::home().'images/images/arrow2.gif" alt="" class="v-middle"></a>
                        </div>
                        <div class="clear"></div>
                    </div>
            ');}
?>


                <?php $i = 0;  ?>
                <?php foreach ($model as $row): ?>
                <?php if ($i == 0) {echo('<div class="box1">');}  ?>
                  <div class="col_1_of_single1 span_1_of_single1">
                    <a href="single.html">
                        <div class="view1 view-fifth1">
                            <div class="top_box">
                                <h3 class="m_1"><?php echo $row->title  ?></h3>
                                <p class="m_2">индекс: <?php echo $row->id  ?></p>
                                <div class="grid_img">
                                    <div class="css3"><img src="<?php echo Url::home().$row->preview ?>" alt=""/></div>
                                    <div class="mask1">
                                        <div class="info">Quick View</div>
                                    </div>
                                </div>
                                <div class="price">$ <?php echo $row->cena ?></div>
                            </div>
                        </div>

                        <ul class="list2">
                            <li>
                                <img src="<?php echo Url::home()?>images/images/plus.png" alt=""/>
                                <ul class="icon1 sub-icon1 profile_img">
                                    <li><a class="active-icon c1" href="#">В корзину </a>
                                        <ul class="sub-icon1 list">
                                            <li><h3>sed diam nonummy</h3><a href=""></a></li>
                                            <li><p>Lorem ipsum dolor sit amet, consectetuer  <a href="">adipiscing elit, sed diam</a></p></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </a>
                </div>
                <?php
                    $i = $i+1;
                    if($i == 3){
                        echo ('<div class="clear"></div></div>');
                    $i = 0;
                    }

                ?>
                <?php endforeach; ?>
                <?php if($i <> 3) {echo ('<div class="clear"></div></div>');} ?>


            <?php foreach ($model as $row): ?>
                        <table class="table small" >
                            <tr >
                                <td><?php echo $row->id;  ?></td>
                                <td><?php echo $row->title;  ?></td>
                                <td><?php echo $row->cena;  ?></td>
                            </tr>
                        </table>
                            <?php $attr = $row ->atributes; ?>
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

        <div class="clear"></div>
    </div>
</div>


<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\Category;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

    <link rel="shortcut icon" href="<?php echo Url::home()?>images/icon_logo_16.png" type="image/png">
    <script type="text/javascript" src="<?php echo Url::home()?>js/jquery.min.js"></script>

    <!-- slider -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 50, 300 ],
                slide: function( event, ui ) {
                    $( "#price_min" ).val(ui.values[ 0 ]);
                    $( "#price_max" ).val(ui.values[ 1 ]);
                    /*$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );*/
                }
            });

            $("#price_min").val( $( "#slider-range" ).slider( "values", 0 ));
            $("#price_max").val( $( "#slider-range" ).slider( "values", 1 ));

            /*$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
             " - $" + $( "#slider-range" ).slider( "values", 1 ) );*/
        } );
    </script>
    
    <title>shop</title>

    <link href="<?php echo Url::home()?>bootstrap/css/bootstrap.css" rel="stylesheet"  type="text/css" media="all" />
    <link href="<?php echo Url::home()?>bootstrap/css/bootstrap-theme.css" rel="stylesheet"  type="text/css" media="all" />
    <link href="<?php echo Url::home()?>css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo Url::home()?>css/form.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo Url::home()?>css/site.css" rel="stylesheet" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <script src="<?php echo Url::home()?>js/jquery.easydropdown.js"></script>
    <script src="<?php echo Url::home()?>js/tale.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });
    </script>
    
    
    <!-- start menu -->
    <link href="<?php echo Url::home()?>css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="<?php echo Url::home()?>js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <!-- end menu -->
    <script type="text/javascript" src="<?php echo Url::home()?>js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" id="sourcecode">
        $(function()
        {
            $('.scroll-pane').jScrollPane();
        });
    </script>
    <!-- top scrolling -->
    <script type="text/javascript" src="<?php echo Url::home()?>js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo Url::home()?>js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
            });
        });
    </script>

</head>
<body style="background-color: white;">
<?php $this->beginBody() ?>

<div class="header-top">
    <div class="wrap">
        <div class="logo">
            <a href="index.html"><img src="<?php echo Url::home()?>images/images/logo.png" alt=""/></a>
        </div>
        <div class="cssmenu">
            <ul>
                <li class="active"><a href="register.html">Sign up & Save</a></li>
                <li><a href="shop.html">Store Locator</a></li>
                <li><a href="login.html">My Account</a></li>
                <li><a href="checkout.html">CheckOut</a></li>
            </ul>
        </div>

        <div class="clear"></div>
    </div>
</div>
<div class="header-bottom">
    <div class="wrap">
        <!-- start header menu -->
        <ul class="megamenu skyblue">
            <li><a class="color1" href="#">Home</a></li>
            <li class="grid"><a class="color2" href="#">Товары</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>Популярные</h4>
                                <ul>
                                    <li><a href="<?php echo Url::toRoute(['site/condition'])?>">Condition</a></li>
                                    <li><a href="<?php echo Url::toRoute(['site/ses'])?>">Ses</a></li>
                                    <li><a href="<?php echo Url::toRoute(['site/test', 'category' => '7'])?>">Сессия</a></li>
                                    <li><a href="<?php echo Url::toRoute(['site/delsession'])?>">Очистить сессию</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">login</a></li>
                                </ul>
                            </div>
                            <div class="h_nav">
                                <h4 class="top">men</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>style zone</h4>
                                <ul>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <img src="<?php echo Url::home()?>images/images/nav_img.jpg" alt=""/>
                    </div>
                </div>
            </li>
            <li class="grid"><a class="color2" href="#">Категория</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col4" >
                            <div class="h_nav">
                                <h4 style="margin-bottom: 1%;">Разделы</h4>

                      <?php

                        $result = Category::find() ->orderBy('title')->all();

                        if  (count($result) > 0){

                            $cats = array(); //создать новый     массив
                            //заполнить:
                            foreach($result as $cat) {
                                $cats_ID[$cat['id']][] = $cat;
                                $cats[$cat['parent_id']][$cat['id']] =  $cat;
                            }
                        }

                        function build_tree($cats,$parent_id,$only_parent = false){
                            if(is_array($cats) and isset($cats[$parent_id])){
                                $tree = '<ul>';
                                if($only_parent==false){
                                    foreach($cats[$parent_id] as $cat){
                                        $st = Url::toRoute(['site/articles', 'id' => $cat['id']]);
                                        $tree .= '<li><a href="'.$st.'">'.'<span class="glyphicon glyphicon-chevron-right" style="color:gray; font-size:0.7em;"></span>'.' '.$cat['title'];
                                        /*$tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];*/
                                        $tree .=  build_tree($cats,$cat['id']);
                                        $tree .= '</a></li>';
                                    }
                                }elseif(is_numeric($only_parent)){
                                    $cat = $cats[$parent_id][$only_parent];
                                    $st = Url::toRoute(['site/articles', 'id' => $cat['id']]);
                                    $tree .= '<li><a href="'.$st.'">'.$cat['title'];
                                    /*$tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];*/
                                    $tree .=  build_tree($cats,$cat['id']);
                                    $tree .= '</a></li>';
                                }
                                $tree .= '</ul>';
                            }
                            else return null;
                            return $tree;
                        }
                        ?>
                        <div class="bigtree2"><?php echo build_tree($cats,0); ?></div>

                       </div>
                     </div>
                     <img style="margin: 8% 0 0 4%; float: left; " src="<?php echo Url::home()?>images/images/folders.jpg"  alt=""/>
                    </div>
                </div>
            </li>
           
           
            <li class="active grid"><a class="color4" href="#">Women</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>shop</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>help</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>account</h4>
                                <ul>
                                    <li><a href="shop.html">login</a></li>
                                    <li><a href="shop.html">create an account</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                    <li><a href="shop.html">my shopping bag</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>popular</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <img src="<?php echo Url::home()?>images/images/nav_img1.jpg" alt=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                    </div>
                </div>
            </li>
            <li><a class="color5" href="#">Kids</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>popular</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">login</a></li>
                                </ul>
                            </div>
                            <div class="h_nav">
                                <h4 class="top">man</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>style zone</h4>
                                <ul>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <img src="<?php echo Url::home()?>images/images/nav_img2.jpg" alt=""/>
                    </div>
                </div>
            </li>
            <li><a class="color6" href="#">Sale</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>shop</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                            <div class="h_nav">
                                <h4 class="top">my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>man</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>help</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>account</h4>
                                <ul>
                                    <li><a href="shop.html">login</a></li>
                                    <li><a href="shop.html">create an account</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                    <li><a href="shop.html">my shopping bag</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>popular</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                    </div>
                </div>
            </li>
            <li><a class="color7" href="#">Customize</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>shop</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>help</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>account</h4>
                                <ul>
                                    <li><a href="shop.html">login</a></li>
                                    <li><a href="shop.html">create an account</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                    <li><a href="shop.html">my shopping bag</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>popular</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                    </div>
                </div>
            </li>
            <li><a class="color8" href="#">Shop</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>style zone</h4>
                                <ul>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>popular</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">login</a></li>
                                </ul>
                            </div>
                            <div class="h_nav">
                                <h4 class="top">man</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                            <div class="col1"></div>
                        </div>
                    </div>
            </li>
            <li><a class="color9" href="#">Football</a>
                <div class="megapanel">
                    <div class="row">
                        <div class="col1">
                            <div class="h_nav">
                                <h4>shop</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>help</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>account</h4>
                                <ul>
                                    <li><a href="shop.html">login</a></li>
                                    <li><a href="shop.html">create an account</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                    <li><a href="shop.html">my shopping bag</a></li>
                                    <li><a href="shop.html">brands</a></li>
                                    <li><a href="shop.html">create wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>my company</h4>
                                <ul>
                                    <li><a href="shop.html">trends</a></li>
                                    <li><a href="shop.html">sale</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col1">
                            <div class="h_nav">
                                <h4>popular</h4>
                                <ul>
                                    <li><a href="shop.html">new arrivals</a></li>
                                    <li><a href="shop.html">men</a></li>
                                    <li><a href="shop.html">women</a></li>
                                    <li><a href="shop.html">accessories</a></li>
                                    <li><a href="shop.html">kids</a></li>
                                    <li><a href="shop.html">style videos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                        <div class="col1"></div>
                    </div>
                </div>
            </li>
            <li><a class="color10" href="#">Running</a></li>
            <li><a class="color11" href="#">Originals</a></li>
            <li><a class="color12" href="#">Basketball</a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>

<?= $content ?>


<div class="footer">
    <div class="footer-top">
        <div class="wrap">
            <div class="col_1_of_footer-top span_1_of_footer-top">
                <ul class="f_list">
                    <li><img src="<?php echo Url::home()?>images/images/f_icon.png" alt=""/><span class="delivery">Бесплатная доставка при заказе более $100*</span></li>
                </ul>
            </div>
            <div class="col_1_of_footer-top span_1_of_footer-top">
                <ul class="f_list">
                    <li><img src="<?php echo Url::home()?>images/images/f_icon1.png" alt=""/><span class="delivery">Обслуживание клиентов :<span class="orange"> (800) 000-2587 (freephone)</span></span></li>
                </ul>
            </div>
            <div class="col_1_of_footer-top span_1_of_footer-top">
                <ul class="f_list">
                    <li><img src="<?php echo Url::home()?>images/images/f_icon2.png" alt=""/><span class="delivery">Быстрая доставка & свободный возврат</span></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="wrap">
            <div class="section group">
                <div class="col_1_of_5 span_1_of_5">
                    <h3 class="m_9">Shop</h3>
                    <ul class="sub_list">
                        <h4 class="m_10">Men</h4>
                        <li><a href="shop.html">Men's Shoes</a></li>
                        <li><a href="shop.html">Men's Clothing</a></li>
                        <li><a href="shop.html">Men's Accessories</a></li>
                    </ul>
                    <ul class="sub_list">
                        <h4 class="m_10">Women</h4>
                        <li><a href="shop.html">Women's Shoes</a></li>
                        <li><a href="shop.html">Women's Clothing</a></li>
                        <li><a href="shop.html">Women's Accessories</a></li>
                    </ul>
                    <ul class="sub_list">
                        <h4 class="m_10">Kids</h4>
                        <li><a href="shop.html">Kids Shoes</a></li>
                        <li><a href="shop.html">Kids Clothing</a></li>
                        <li><a href="shop.html">Kids Accessories</a></li>
                    </ul>
                    <ul class="sub_list">
                        <h4 class="m_10">style</h4>
                        <li><a href="shop.html">Porsche Design Sport</a></li>
                        <li><a href="shop.html">Porsche Design Shoes</a></li>
                        <li><a href="shop.html">Porsche Design Clothing</a></li>
                    </ul>
                    <ul class="sub_list">
                        <h4 class="m_10">Adidas Neo Label</h4>
                        <li><a href="shop.html">Adidas NEO Shoes</a></li>
                        <li><a href="shop.html">Adidas NEO Clothing</a></li>
                    </ul>
                    <ul class="sub_list1">
                        <h4 class="m_10">Customise</h4>
                        <li><a href="shop.html">mi adidas</a></li>
                        <li><a href="shop.html">mi team</a></li>
                        <li><a href="shop.html">new arrivals</a></li>
                    </ul>
                </div>
                <div class="col_1_of_5 span_1_of_5">
                    <h3 class="m_9">Sports</h3>
                    <ul class="list1">
                        <li><a href="shop.html">Basketball</a></li>
                        <li><a href="shop.html">Football</a></li>
                        <li><a href="shop.html">Football Boots</a></li>
                        <li><a href="shop.html">Predator</a></li>
                        <li><a href="shop.html">F50</a></li>
                        <li><a href="shop.html">Football Clothing</a></li>
                        <li><a href="shop.html">Golf</a></li>
                        <li><a href="shop.html">Golf Shoes</a></li>
                        <li><a href="shop.html">Golf Clothing</a></li>
                        <li><a href="shop.html">Outdoor</a></li>
                        <li><a href="shop.html">Outdoor Shoes</a></li>
                        <li><a href="shop.html">Outdoor Clothing</a></li>
                        <li><a href="shop.html">Rugby</a></li>
                        <li><a href="shop.html">Running</a></li>
                        <li><a href="shop.html">Running Shoes</a></li>
                        <li><a href="shop.html">Boost</a></li>
                        <li><a href="shop.html">Supernova</a></li>
                        <li><a href="shop.html">Running Clothing</a></li>
                        <li><a href="shop.html">Swimming</a></li>
                        <li><a href="shop.html">Tennis</a></li>
                        <li><a href="shop.html">Tennis Shoes</a></li>
                        <li><a href="shop.html">Tennis Clothing</a></li>
                        <li><a href="shop.html">Training</a></li>
                        <li><a href="shop.html">Training Shoes</a></li>
                        <li><a href="shop.html">Training Clothing</a></li>
                        <li><a href="shop.html">Training Accessories</a></li>
                        <li><a href="shop.html">miCoach</a></li>
                        <li><a href="shop.html">All Sports</a></li>
                    </ul>
                </div>
                <div class="col_1_of_5 span_1_of_5">
                    <h3 class="m_9">Originals</h3>
                    <ul class="list1">
                        <li><a href="shop.html">Originals Shoes</a></li>
                        <li><a href="shop.html">Gazelle</a></li>
                        <li><a href="shop.html">Samba</a></li>
                        <li><a href="shop.html">LA Trainer</a></li>
                        <li><a href="shop.html">Superstar</a></li>
                        <li><a href="shop.html">SL</a></li>
                        <li><a href="shop.html">ZX</a></li>
                        <li><a href="shop.html">Campus</a></li>
                        <li><a href="shop.html">Spezial</a></li>
                        <li><a href="shop.html">Dragon</a></li>
                        <li><a href="shop.html">Originals Clothing</a></li>
                        <li><a href="shop.html">Firebird</a></li>
                        <li><a href="shop.html">Originals Accessories</a></li>
                        <li><a href="shop.html">Men's Originals</a></li>
                        <li><a href="shop.html">Women's Originals</a></li>
                        <li><a href="shop.html">Kid's Originals</a></li>
                        <li><a href="shop.html">All Originals</a></li>
                    </ul>
                </div>
                <div class="col_1_of_5 span_1_of_5">
                    <h3 class="m_9">Product Types</h3>
                    <ul class="list1">
                        <li><a href="shop.html">Shirts</a></li>
                        <li><a href="shop.html">Pants & Tights</a></li>
                        <li><a href="shop.html">Shirts</a></li>
                        <li><a href="shop.html">Jerseys</a></li>
                        <li><a href="shop.html">Hoodies & Track Tops</a></li>
                        <li><a href="shop.html">Bags</a></li>
                        <li><a href="shop.html">Jackets</a></li>
                        <li><a href="shop.html">Hi Tops</a></li>
                        <li><a href="shop.html">SweatShirts</a></li>
                        <li><a href="shop.html">Socks</a></li>
                        <li><a href="shop.html">Swimwear</a></li>
                        <li><a href="shop.html">Tracksuits</a></li>
                        <li><a href="shop.html">Hats</a></li>
                        <li><a href="shop.html">Football Boots</a></li>
                        <li><a href="shop.html">Other Accessories</a></li>
                        <li><a href="shop.html">Sandals & Flip Flops</a></li>
                        <li><a href="shop.html">Skirts & Dresseses</a></li>
                        <li><a href="shop.html">Balls</a></li>
                        <li><a href="shop.html">Watches</a></li>
                        <li><a href="shop.html">Fitness Equipment</a></li>
                        <li><a href="shop.html">Eyewear</a></li>
                        <li><a href="shop.html">Gloves</a></li>
                        <li><a href="shop.html">Sports Bras</a></li>
                        <li><a href="shop.html">Scarves</a></li>
                        <li><a href="shop.html">Shinguards</a></li>
                        <li><a href="shop.html">Underwear</a></li>
                    </ul>
                </div>
                <div class="col_1_of_5 span_1_of_5">
                    <h3 class="m_9">Support</h3>
                    <ul class="list1">
                        <li><a href="shop.html">Store finder</a></li>
                        <li><a href="shop.html">Customer Service</a></li>
                        <li><a href="shop.html">FAQ</a></li>
                        <li><a href="shop.html">Online Shop Contact Us</a></li>
                        <li><a href="shop.html">about adidas Products</a></li>
                        <li><a href="shop.html">Size Charts </a></li>
                        <li><a href="shop.html">Ordering </a></li>
                        <li><a href="shop.html">Payment </a></li>
                        <li><a href="shop.html">Shipping </a></li>
                        <li><a href="shop.html">Returning</a></li>
                        <li><a href="shop.html">Using out Site</a></li>
                        <li><a href="shop.html">Delivery Terms</a></li>
                        <li><a href="shop.html">Site Map</a></li>
                        <li><a href="shop.html">Gift Card</a></li>

                    </ul>
                    <ul class="sub_list2">
                        <h4 class="m_10">Company Info</h4>
                        <li><a href="shop.html">About Us</a></li>
                        <li><a href="shop.html">Careers</a></li>
                        <li><a href="shop.html">Press</a></li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="wrap">
            <p>© All rights reserved | Template by&nbsp;<a href="http://w3layouts.com/"> W3Layouts</a></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
        };


        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

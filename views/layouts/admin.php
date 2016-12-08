<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);  // $this represents the view object

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>

        <link rel="shortcut icon" href="<?php echo Url::home()?>images/icon_logo_16.png" type="image/png">
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">


        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <script src="<?php echo Url::home()?>tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                plugins: "image",
                selector: '#editor',
                selector: 'textarea',  // Ширина textarea
                /*width : 800,*/
                plugins: 'lists',
                toolbar: 'lists',

                plugins: ['code', 'textcolor'],

                mode : "textareas",
                force_br_newlines : true,
                /*force_br_newlines : false,*/
                force_p_newlines : false,
                forced_root_block : false,

                toolbar: 'fontsizeselect | code | forecolor backcolor | bullist numlist |',
                fontsize_formats: '8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt',

            });
        </script>

    </head>
    <body>
    <?php $this->beginBody() ?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo Url::toRoute('site/index')?>">Home</a>
            </div>
            <!-- Top Menu Items -->

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#lisp"><i class="fa fa-fw fa-folder-open-o"></i>  Категории <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="lisp" class="collapse">
                            <li >
                                <a href="<?php echo Url::toRoute('category/view')?>"> Показать все</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::toRoute('category/treecats')?>"> Дерево</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::toRoute('category/create')?>"> Добавить новую</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#lisp_2"><i class="fa fa-fw fa-gift"></i> Товары<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="lisp_2" class="collapse">
                            <li>
                                <a href="<?php echo Url::toRoute(['articles/viewt', 'id' => '-211'])?>"> Показать все</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::toRoute('articles/create')?>"> Добавить товар</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#lisp_3"><i class="fa fa-fw fa-list"></i> Атрибуты<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="lisp_3" class="collapse">
                            <li>
                                <a href="<?php echo Url::toRoute('atribute/viewf')?>"> Показать все</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::toRoute(['atribute/viewt', 'id' => '-211'])?>"> Шаблон</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#lisp_4"><i class="fa fa-fw fa-male"></i> Студенты<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="lisp_4" class="collapse">
                            <li>
                                <a href="<?php echo Url::toRoute('order/view')?>"> Показать всех</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::toRoute('order/create')?>"> Редактировать</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#lisp_5"><i class="fa fa-fw fa-paper-plane-o"></i> Статьи<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="lisp_5" class="collapse">
                            <li>
                                <a href="<?php echo Url::toRoute('post/index')?>"> Показать все</a>
                            </li>
                            <li>
                                <a href="<?php echo Url::toRoute('post/create')?>"> Добавить новую</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid" ">

                <?= $content ?>

            </div>
        </div>
        
    </div>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
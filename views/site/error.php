<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <?php if($exception->statusCode == '404') { $this->title = "Где-то ошибка..."; ?>
        <p class="text-danger text-center lead">Такой страницы нет. Воспользуйтесь меню ниже.</p>
        <div class="well well-lg bgblack70">
            <?= $this->render('/layouts/_navbar2') ?>
        </div>
    <? } else { ?>
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p>
    <? } ?>
</div>

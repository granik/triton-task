<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        При обработке вашего запроса произошла ошибка.
    </p>
    <p>
        Пожалуйста, свяжитесь с нами, если Вы считаете, что это ошибка на сервере. Спасибо.
    </p>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin([
      'validateOnBlur' => false,
      'method' => $method,
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 30,]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => 7,]) ?>
    <sup>Внимание! Цвет должен быть задан в формате <b>#xxxxxx</b></sup>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'id' => 'phone-input']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// Подключаем jQuery Inputmask
$this->registerJsFile('https://cdn.jsdelivr.net/npm/inputmask/dist/jquery.inputmask.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$this->registerJs("
    $(document).ready(function(){
        $('#phone-input').inputmask({
            mask: '+7 (999) 999-99-99',
            placeholder: ' ',
            clearMaskOnLostFocus: false
        });
    });
");
?>

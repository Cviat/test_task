<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = 'Создать сделку';
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contacts' => $contacts, // Передаем список контактов
    ]) ?>

</div>

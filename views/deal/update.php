<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = 'Редактировать сделку: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Сделки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="deal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'contacts' => $contacts,
    ]) ?>

</div>

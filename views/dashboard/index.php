<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $deals app\models\Deal[] */
/* @var $contacts app\models\Contact[] */
/* @var $selectedItem app\models\Deal|app\models\Contact|null */
/* @var $selectedType string|null */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="dashboard-index">

    <table class="table table-bordered">
        <thead>
        <tr>
            <th style="width: 25%;">Меню</th>
            <th style="width: 35%;">Список</th>
            <th style="width: 40%;">Содержимое</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <?= Html::a('Сделки', ['dashboard/index', 'type' => 'deals'], ['class' => 'nav-link' . ($selectedType === 'deals' ? ' active' : '')]) ?>
                            <?= Html::a('Добавить', ['deal/create'], ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <?= Html::a('Контакты', ['dashboard/index', 'type' => 'contacts'], ['class' => 'nav-link' . ($selectedType === 'contacts' ? ' active' : '')]) ?>
                            <?= Html::a('Добавить', ['contact/create'], ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </li>
                </ul>
            </td>
            <td>
                <?php if ($selectedType === 'deals'): ?>
                    <ul class="list-group">
                        <?php foreach ($deals as $deal): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= Html::a($deal->title, ['dashboard/index', 'type' => 'deals', 'id' => $deal->id]) ?></span>
                                <div class="d-flex gap-2">
                                    <?= Html::a('Редактировать', ['deal/update', 'id' => $deal->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?= Html::a('Удалить', ['deal/delete', 'id' => $deal->id], [
                                        'class' => 'btn btn-danger btn-sm',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите удалить эту сделку?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php elseif ($selectedType === 'contacts'): ?>
                    <ul class="list-group">
                        <?php foreach ($contacts as $contact): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= Html::a($contact->first_name . ' ' . $contact->last_name, ['dashboard/index', 'type' => 'contacts', 'id' => $contact->id]) ?></span>
                                <div class="d-flex gap-2">
                                    <?= Html::a('Редактировать', ['contact/update', 'id' => $contact->id], ['class' => 'btn btn-primary btn-sm']) ?>
                                    <?= Html::a('Удалить', ['contact/delete', 'id' => $contact->id], [
                                        'class' => 'btn btn-danger btn-sm',
                                        'data' => [
                                            'confirm' => 'Вы уверены, что хотите удалить этот контакт?',
                                            'method' => 'post',
                                        ],
                                    ]) ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($selectedType === 'deals' && $selectedItem): ?>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td><?= Html::encode($selectedItem->id) ?></td>
                        </tr>
                        <tr>
                            <th>Название</th>
                            <td><?= Html::encode($selectedItem->title) ?></td>
                        </tr>
                        <tr>
                            <th>Сумма</th>
                            <td><?= Html::encode($selectedItem->amount * count($selectedItem->contacts)) ?></td> <!-- Отображается сумма -->
                        </tr>
                        <tr>
                            <th>Контакты</th>
                            <td>
                                <?php if (!empty($selectedItem->contacts)): ?>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Имя Фамилия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($selectedItem->contacts as $contact): ?>
                                            <tr>
                                                <td><?= Html::encode($contact->id) ?></td>
                                                <td><?= Html::encode($contact->first_name . ' ' . $contact->last_name) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Нет связанных контактов.</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                <?php elseif ($selectedType === 'contacts' && $selectedItem): ?>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td><?= Html::encode($selectedItem->id) ?></td>
                        </tr>
                        <tr>
                            <th>Имя</th>
                            <td><?= Html::encode($selectedItem->first_name) ?></td>
                        </tr>
                        <tr>
                            <th>Фамилия</th>
                            <td><?= Html::encode($selectedItem->last_name) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= Html::encode($selectedItem->email) ?></td>
                        </tr>
                        <tr>
                            <th>Телефон</th>
                            <td><?= Html::encode($selectedItem->phone) ?></td>
                        </tr>
                        <tr>
                            <th>Сделки</th>
                            <td>
                                <?php if (!empty($selectedItem->deals)): ?>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($selectedItem->deals as $deal): ?>
                                            <tr>
                                                <td><?= Html::encode($deal->id) ?></td>
                                                <td><?= Html::encode($deal->title) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Нет связанных сделок.</p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <p>Выберите элемент для просмотра деталей.</p>
                <?php endif; ?>
            </td>
        </tr>
        </tbody>
    </table>

</div>



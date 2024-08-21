
<h1>Contacts</h1>

<ul>
    <?php foreach ($dataProvider->models as $contact): ?>
        <li><a href="<?= \yii\helpers\Url::to(['contact/view', 'id' => $contact->id]) ?>"><?= $contact->name ?> <?= $contact->surname ?></a></li>
    <?php endforeach; ?>
</ul>

<p><a href="<?= \yii\helpers\Url::to(['contact/create']) ?>">Create New Contact</a></p>

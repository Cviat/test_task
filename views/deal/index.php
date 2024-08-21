<h1>Deals</h1>

<ul>
    <?php foreach ($dataProvider->models as $deal): ?>
        <li><a href="<?= \yii\helpers\Url::to(['deal/view', 'id' => $deal->id]) ?>"><?= $deal->title ?> (<?= $deal->amount ?>)</a></li>
    <?php endforeach; ?>
</ul>

<p><a href="<?= \yii\helpers\Url::to(['deal/create']) ?>">Create New Deal</a></p>

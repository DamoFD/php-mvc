<h1>Cats</h1>
<a href="/public/cat/create">Create a Cat</a>
<?php foreach ($data as $cat): ?>
<div>
    <ul>
        <li><a href="/public/cat/show/<?= $cat['id'] ?>"><?= $cat['name'] ?></a></li>
        <li><?= $cat['age'] ?></li>
    </ul>
</div>
<?php endforeach; ?>

<h1><?= $data['name'] ?></h1>
<p><?= $data['name'] ?> is <?= $data['age'] ?> years old.</p>
<a href="/public/cat/edit/<?= $data['id'] ?>">Edit</a>
<form method="post" action="/public/cat/delete/<?= $data['id'] ?>">
    <button type="submit">Delete</button>
</form>
<a href="/public/cat/index">back</a>


<h1>Добро пожаловать, <?= $user->name ?>!</h1>
<img src="/img/<?= $user->imgurl ?>" alt="Фото профиля">
<p>Email: <?= $user->email ?></p>
<a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>">Редактировать</a>

<div class="center">
        <div class="center-authorisation">
            <? if (empty($userId)) { ?>
<form method="post">
                <p>Адрес почты:</p>
                <input class="center-authorisation-fields" type="email" name="email" placeholder="adress@domain.zone">
                <p>Пароль:</p>
                <input class="center-authorisation-fields" type="password"id="password" name="password" placeholder="*****">
                <a href="/register">Зарегестрироваться</a></p>
                <input class="center-authorisation-button" type="submit" value="Войти">
                <p><a class="center-authorisation-links" href="/recovery">Забыли пароль? Сменить?</a>

            </form>
            <?}?>
            </div>
<div>
<div class="profile-name">
<?= h($user->name) ?><?= h($user->surname) ?>
</div>
<div class="center">
<div><img width="200px" src="/img/<?= $user->imgurl ?>" alt="Фото профиля"></div>
<div class="profile-info">
<?php if ($user->name): ?>
<div class="profile-info-name">
                        <span><?= h($user->name) ?><?= h($user->surname) ?><?= h($user->lastname) ?></span></div>

<div class="profile-info-text">
                        <b>Почта:</b>
                        <span><?= h($user->email) ?></span>
                       

</div>
<div class="profile-info-text">
                        <b>Дата рождения:</b>
                        <span><?= h($user->birthday).',' ?><?= h($user->age) .'лет' ?></span>
                        <?php endif; ?>
</div>
<div class="user-posts">
    <h3>Посты пользователя:</h3>
    <?php if (!empty($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
            <div class="post-item">
                <div class="post-content"><?= h($post->content) ?></div>
                <div class="post-meta">
                    Опубликовано: <?= $post->created->format('d.m.Y H:i') ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Здесь пока нет записей</p>
    <?php endif; ?>
</div>
</div>

                    <?if (($userId)==($id)) {?>
            <?= $this->Html->link(
                        'Редактировать профиль',
                        ['action' => 'edit', $user->id],
                        ['class' => 'btn btn-warning']
                    ) ?>
             <?= $this->Html->link(
                        'Написать сообщение',
                        ['controller'=>'chat','action' => 'Messageto', $user->id])?>
                </div>
            </div>
        </div>
    </div>
</div>
<?
                    }
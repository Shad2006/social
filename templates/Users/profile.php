<div>
<div>
                    <h3 >Профиль пользователя</h3>
</div>
<div><img src="/img/<?= $user->imgurl ?>" alt="Фото профиля"></div>
<?php if ($user->name): ?>
<div>
                        <b>Имя:</b>
                        <span><?= h($user->name) ?><?= h($user->surname) ?><?= h($user->lastname) ?></span></div>

</div>
<div>
                        <b>Почта:</b>
                        <span><?= h($user->email) ?></span>
                       

</div>
<div>
                        <b>Дата рождения:</b>
                        <span><?= h($user->birthday).',' ?><?= h($user->age) .'лет' ?></span>
                        <?php endif; ?>

</div>
                    <?if (($userId)==($id)) {?>
            <?= $this->Html->link(
                        'Редактировать профиль',
                        ['action' => 'edit', $user->id],
                        ['class' => 'btn btn-warning']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?
                    }
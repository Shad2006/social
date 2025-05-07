<div class="users">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <h1>Редактировать данные пользователя</h1>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('surname');
            echo $this->Form->control('birthday');
            echo $this->Form->control('email');
            echo $this->Form->control('tag');
            echo $this->Form->control('access_rights', ['options' => ['0' => 'Простой профиль', '1' => 'Административные привилегии']]);
            echo $this->Form->control('blocked', ['options' => ['0' => 'Разблокирован', '1' => 'Заблокирован']]);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
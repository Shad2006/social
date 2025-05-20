<div class="users">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <h1>Отредактировать данные своего профиля</h1>
        <?php
    echo $this->Form->control('imgurl', ['type' => 'file', 'label'=>'Аватар']);
            echo $this->Form->control('name', ['label'=>'Ваше имя']);
            echo $this->Form->control('surname',['label'=>'Ваша фамилия']);
        echo $this->Form->control('birthday', ['label'=>'Дата рождения']);
            echo $this->Form->control('email');
            echo $this->Form->control('tag',['label'=>'@tag']);
            ?>
    </fieldset>
    <?= $this->Form->button(__('Обновить')) ?>
    <?= $this->Form->end() ?>
</div>
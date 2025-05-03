<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Смена пароля') ?></legend>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('phone', ['required' => false]) ?>
        <?= $this->Form->control('new_password', [
            'type' => 'password', 
            'required' => true,
            'label' => 'Новый пароль'
        ]) ?>
    </fieldset>
    <?= $this->Form->button(__('Сменить пароль')) ?>
    <?= $this->Form->end() ?>
</div>

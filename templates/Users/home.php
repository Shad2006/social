<style>
    h1{
  background-color: lightsteelblue;
color:#2B587A;
font-size: larger;
}
</style>
<?= $this->Form->create(null, ['url' => ['controller' => 'Posts', 'action' => 'add']]) ?>
<h1>Добро пожаловать, <?= h($userData->name) ?>!</h1>
<p>Напишите о том, о чём думаете</p>
<?= $this->Form->control('user_id', ['type' => 'hidden', 'value' => $userData->id]) ?>
<?= $this->Form->control('content', ['placeholder' => 'Пост', 'label' => false]) ?>
<?= $this->Form->button(__('Опубликовать')) ?>
<?= $this->Form->end() ?>
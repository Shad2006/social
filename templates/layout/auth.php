<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= __('Auth') ?></title>
    
    <?= $this->Html->css('auth') ?> <!-- Ваши стили для авторизации -->
</head>
<body>
    <div class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    
    <?= $this->Html->script('auth') ?> <!-- Скрипты для авторизации -->
    <?= $this->fetch('script') ?>
</body>
</html>
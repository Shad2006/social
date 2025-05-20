<?php if (empty($messages) || $messages->isEmpty()): ?>
    <div class="message">Нет сообщений</div>
<?php else: ?>
    <?php foreach ($messages as $message): ?>
        <div class="message">
            <img src="<?= $message->sender->imgurl ?>" alt="avatar">
            <div class="content">
                <strong><?= h($message->sender->name) ?></strong>
                <div><?= h($message->content) ?></div>
                <small><?= $message->created->format('d.m.Y H:i') ?></small>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


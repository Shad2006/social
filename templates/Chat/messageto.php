<div class="chat-messages">
    <h2>Чат с <?= h($friend->name) ?></h2>
    <div class="messages-container">
        <?php foreach ($messages as $message): ?>
            <div class="message <?= $message->sender_id == $currentUserId ? 'sent' : 'received' ?>">
                <div class="content"><?= h($message->content) ?></div>
                <div class="time"><?= $message->created->format('H:i') ?></div>
            </div>
        <?php endforeach; ?>
    </div>
    <?= $this->Form->create(null, ['url' => ['action' => 'messageto', $friend->id]]) ?>
    <?= $this->Form->control('content', ['placeholder' => 'Написать сообщение...']) ?>
    <?= $this->Form->button('Отправить') ?>
    <?= $this->Form->end() ?>
</div>

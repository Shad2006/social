<div class="messenger-wrapper">
<a href="../"></a>
<?php if (empty($contacts)): ?>
    <div class="message">Нет собеседников</div>
<?php else: ?>
    <?php foreach ($contacts as $contact): ?>
        <div class="message">
            <a href="<?= $this->Url->build(['action' => 'messageto', $contact->id]) ?>">
                <img src="<?= $contact->imgurl ?>" alt="avatar">
                <strong><?= h($contact->name . ' ' . $contact->surname) ?></strong>
            </a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

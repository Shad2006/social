<div class="admin">
    <h1>Admin Panel</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Email</th>
                <th>Привилегии</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= h($user->name) ?><?= h($user->surname) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->access_rights) ?></td>
                <td>
                    <?= $this->Html->link('Редактировать', ['action' => 'edit', $user->id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


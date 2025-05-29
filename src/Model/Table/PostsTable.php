<?php
namespace App\Model\Table;
use Cake\ORM\Table;
class PostsTable extends Table
{
    public function initialize(array $config): void
    {
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
    }
}

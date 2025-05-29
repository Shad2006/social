<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class UsersTable extends Table {
    public function initialize(array $config): void {
        $this->setTable('users');
        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
    }
    
}

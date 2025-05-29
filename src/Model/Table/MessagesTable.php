<?php
namespace App\Model\Table;
use Cake\ORM\Table;

class MessagesTable extends Table {
    public function initialize(array $config): void
{
    parent::initialize($config);
    $this->belongsTo('Senders', [ 
        'className' => 'Users',       
        'foreignKey' => 'sender_id'
    ]);
     $this->belongsTo('Receivers', [
        'className' => 'Users',
        'foreignKey' => 'receiver_id',
    ]);
}
}
    

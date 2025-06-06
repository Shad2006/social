<?php
namespace App\Controller; use App\Controller\AppController;
class ChatController extends AppController { 
    public function initialize(): void
    {
        parent::initialize();
    }

    public function index()
{
    $session = $this->request->getSession();
    $userId = $session->read('user_id');
    $username = $session->read('name');
    
    if (!$userId) {
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }

    $this->loadModel('Messages');

    // Получаем собеседников из полученных сообщений
    $receivedContacts = $this->Messages->find()
        ->select(['sender_id'])
        ->where(['receiver_id' => $userId])
        ->contain(['Senders' => function ($q) {
            return $q->select(['id', 'name', 'surname', 'imgurl']);
        }])
        ->distinct(['sender_id'])
        ->all()
        ->extract('sender')
        ->toArray();

    // Получаем собеседников из отправленных сообщений
    $sentContacts = $this->Messages->find()
        ->select(['receiver_id'])
        ->where(['sender_id' => $userId])
        ->contain(['Receivers' => function ($q) {
            return $q->select(['id', 'name', 'surname', 'imgurl']);
        }])
        ->distinct(['receiver_id'])
        ->all()
        ->extract('receiver')
        ->toArray();

    // Объединяем и удаляем дубликаты
    $allContacts = array_merge($receivedContacts, $sentContacts);
    $uniqueContacts = [];
    foreach ($allContacts as $contact) {
        if ($contact) {
            $uniqueContacts[$contact->id] = $contact;
        }
    }

    $contacts = array_values($uniqueContacts);
    $this->set(compact('contacts'));
}
     public function sendMessage()
    {
        $session = $this->request->getSession();
        $userId = $session->read('user_id');
        
        if (!$userId) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }
        
        $this->loadModel('Messages');
        $message = $this->Messages->newEmptyEntity();
        
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['sender_id'] = $userId;
            
            $message = $this->Messages->patchEntity($message, $data, [
                'validate' => 'default'
            ]);
            
            if ($this->Messages->save($message)) {
                //Сделать обновление страницы
            } else {
                $this->Flash->error('Ошибка отправки. Проверьте данные.');
            }
        }
        $this->loadModel('Users');
        $users = $this->Users->find('list', [
            'keyField' => 'id',
            'valueField' => function ($user) {
                return $user->name . ' ' . $user->surname;
            }
        ])->toArray();
        
        $this->set(compact('users'));
    }
    public function messageto($friendId = null) {
    $session = $this->request->getSession();
    $userId = $session->read('user_id');
    $username = $session->read('name');

    if (!$userId) {
        return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
    }
    $this->loadModel('Users');
    $friend = $this->Users->find()
        ->select(['id', 'name', 'surname', 'imgurl'])
        ->where(['id' => $friendId])
        ->first();

    if (!$friend) {
        throw new \Cake\Http\Exception\NotFoundException('Пользователь не найден');
    }
    $this->loadModel('Messages');
    $messages = $this->Messages->find()
        ->where([
            'OR' => [
                ['sender_id' => $userId, 'receiver_id' => $friendId],
                ['sender_id' => $friendId, 'receiver_id' => $userId]
            ]
        ])
        ->order(['Messages.created' => 'ASC'])
        ->contain([
            'Senders' => function ($q) {
                return $q->select(['id', 'name', 'surname', 'imgurl']);
            }
        ])
        ->all();
    if ($this->request->is('post')) {
        $content = trim($this->request->getData('content'));
        
        if (!empty($content)) {
            $newMessage = $this->Messages->newEmptyEntity();
            $newMessage->sender_id = $userId;
            $newMessage->receiver_id = $friendId;
            $newMessage->content = $content;
            if ($this->Messages->save($newMessage)) {
                return $this->redirect($this->referer());
            }
            $this->Flash->error('Ошибка при отправке сообщения');
        } else {
            $this->Flash->warning('Сообщение не может быть пустым');
        }
    }
    $this->set(compact('friend'));
    $this->set(compact('messages'));
}
}
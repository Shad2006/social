<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadModel('Users');
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
        $this->viewBuilder()->setTemplate('profile');
    }
    public function viewByTag($tag = null)
{
    $tag = ltrim($tag, '@');
    
    $user = $this->Users->find()
        ->where(['tag' => $tag])
        ->firstOrFail();

    $this->set(compact('user'));
    $this->viewBuilder()->setTemplate('profile');
}


    public function home()
    {
        $session = $this->request->getSession();
        $userId = $session->read('user_id');
        $username = $session->read('name');
        if (!$userId) {
            return $this->redirect(['controller' => 'Auth', 'action' => 'login']);
        }

        $this->loadModel('Users');
        
        try {
          
            $userData = $this->Users->get($userId);
            $this->set(compact('userData'));
            
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
           
            $session->delete('user_id');
            return $this->redirect(['action' => 'login']);
        }
        
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
        $this->viewBuilder()->setTemplate('edit');
        /*if ($userId != $id) {
            $this->Flash->error('Нет прав доступа');
            return $this->redirect($this->referer());
        }*/

        $user = $this->Users->get($id);
        
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            
            if (!empty($data['img']['name'])) {
                $file = $data['img'];
                $filename = $this->handleFileUpload($file);
                $data['imgurl'] = $filename;
            }
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Профиль обновлен');
                return $this->redirect(['action' => 'home']);
            }
            $this->Flash->error('Ошибка сохранения');
        }
        
        $this->set(compact('user'));
    }

    private function handleFileUpload($uploadedFile)
{
    // Проверяем директорию
    $uploadPath = WWW_ROOT . 'img' . DS . 'uploads' . DS;
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0775, true);
    }

    // Генерируем уникальное имя
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $filename = uniqid('img_', true) . '.' . $extension;

    // Сохраняем файл
    $uploadedFile->moveTo($uploadPath . $filename);

    return $filename;
}

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        //$this->Authentication->allowUnauthenticated(['view']);
    }
}

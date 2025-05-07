<?php
namespace App\Controller;

use App\Controller\AppController;

class AdminController extends AppController

{
    public function initialize(): void
    {
        parent::initialize();
    }
    public function edit($id)
    {
        $session = $this->request->getSession();
        $userId = $session->read('user_id');
        $access_rights = $session->read('access_rights');
        if (!$userId || $access_rights = 0) {
            $this->Flash->error(__('Доступ запрещен'));
            return $this->redirect(['controller' => 'Users', 'action' => 'home']);
        }
        $this->loadModel('Users');
        try {
            $user = $this->Users->get($id);
        } catch (\Cake\Datasource\Exception\RecordNotFoundException $e) {
            $this->Flash->error(__('Пользователь не найден'));
            return $this->redirect(['action' => 'admin']);
        }
        if ($this->request->is(['post', 'put', 'patch'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'fields' => ['username', 'email', 'access_rights', 'blocked']
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Пользователь успешно обновлен'));
                return $this->redirect(['action' => 'admin']);
            }
            else{
            $this->Flash->error(__('Ошибка. Проверьте введенные данные.'));}
        }
        $this->set(compact('user'));
    }
    public function admin()
    {
        $session = $this->request->getSession();
        $userId = $session->read('user_id');
        if (!$userId || $userId != 1) {
            $this->Flash->error(__('Доступ запрещен'));
            return $this->redirect(['controller' => 'Users', 'action' => 'home']);
        }
        $this->loadModel('Users');
        $users = $this->Users->find('all');
        $this->set(compact('users'));
    }}

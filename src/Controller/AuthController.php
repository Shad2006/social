<?php
namespace App\Controller;
use App\Controller\AppController;

class AuthController extends AppController {
    public function initialize(): void
{
    parent::initialize();
    $this->loadModel('Users'); 
}
    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Users->find()
                ->where(['email IS' => $this->request->getData('email')])
                ->first();
                
            if ($user && password_verify($this->request->getData('password'), $user->password)) {
                $this->request->getSession()->write('user_id', $user->id);
                return $this->redirect(['controller' => 'Users', 'action' => 'view', $user->id]);
            }
            $this->Flash->error('Неверные данные');
        }
    }

    public function register() {
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
           
            if ($data['password'] !== $data['confirm_password']) {
                $this->Flash->error(__('Пароли не совпадают'));
                return;
            }
            
            $usersTable = $this->getTableLocator()->get('Users');
            $user = $usersTable->newEmptyEntity();
            
            $userData = [
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'name' => $data['name'],
                'surname' => $data['surname'],
                'birthday' => $data['birthday'],
                'access_rights' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ];
            
            $user = $usersTable->patchEntity($user, $userData);
            
            if ($usersTable->save($user)) {
                $this->Flash->success(__('успешная регистрация'));
                return $this->redirect(['controller' => 'Users', 'action' => 'view']);
            }
            
            $this->Flash->error(__('Registration error: {0}', implode(', ', $user->getErrors())));
        }
    }
    
}

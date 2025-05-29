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
        $email = $this->request->getData('email');
        $password = $this->request->getData('password');
        if (empty($email)) {
            $this->Flash->error('Введите email');
            return;
        }
        $user = $this->Users->find()
            ->where(['email' => $email]) 
                        ->first();
        if ($user && password_verify($password, $user->password)) {
            if ($user->blocked !=1){
            $session = $this->request->getSession();
            $session->write([
                'user_id' => $user->id,
                'user_email' => $user->email
            ]);
            return $this->redirect(['controller' => 'Users', 'action' => 'home/']);}
            else{
                $this->Flash->error('Вы заблокированы');
            }
        } else {
            $this->Flash->error('Неверные данные');
        }
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
                'phone' => $data['phone'],
                'access_rights' => 0,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s')
            ];
            
            $user = $usersTable->patchEntity($user, $userData);
            
            if ($usersTable->save($user)) {
                $this->Flash->success(__('успешная регистрация'));
                return $this->redirect(['controller' => 'Users', 'action' => 'home']);
            }
            
            $this->Flash->error(__('Registration error: {0}', implode(', ', $user->getErrors())));
        }
    }
    public function recovery()
{
    if ($this->request->is('post')) {
        $data = $this->request->getData();
        $user = $this->Users->find()
            ->where([
                'email' => $data['email'],
                'phone' => $data['phone']
            ])
            ->first();

        if ($user) {
            $user = $this->Users->patchEntity($user, [
                'password' => $data['new_password']
            ]);

            if ($this->Users->save($user)) {
                $this->Flash->success('Пароль успешно изменен');
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('Ошибка изменения пароля');
        } else {
            $this->Flash->error('Неверные email или телефон');
        }
    }
}
}

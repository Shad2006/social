<?php
namespace App\Controller;
use App\Controller\AppController;

class UsersController extends AppController {
    public function view($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function edit($id) {
        $user = $this->Users->get($id);
        
        if ($this->request->is(['post', 'put'])) {
            $data = $this->request->getData();
            
            // Обработка загрузки изображения
            if (!empty($data['img']['name'])) {
                $filename = uniqid() . '_' . $data['img']['name'];
                move_uploaded_file($data['img']['tmp_name'], WWW_ROOT . 'img/uploads/' . $filename);
                $data['imgurl'] = 'uploads/' . $filename;
            }
            
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success('Profile updated');
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Update failed');
        }
        
        $this->set(compact('user'));
    }
}

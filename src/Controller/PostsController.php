<?php
namespace App\Controller;

use App\Controller\AppController;

class PostsController extends AppController
{
    public function index()
{
    $posts = $this->paginate(
        $this->Posts->find()
            ->contain(['Users'])
            ->orderDesc('Posts.created')
    );
    
    $userData = $this->request->getAttribute('identity');
    $this->set(compact('posts', 'userData'));
    $this->render('/Users/home');
}

public function view($id = null)
{
    $post = $this->Posts->get($id, ['contain' => ['Users']]);
    $user = $post->user;
    $posts = $this->Posts->find()
        ->where(['user_id' => $user->id])
        ->orderDesc('created')
        ->all();
    
    $this->set(compact('post', 'user', 'posts'));
    $this->render('/Users/profile');
}

    public function add()
    {
        $post = $this->Posts->newEmptyEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $users = $this->Posts->Users->find('list')->all();
        $this->set(compact('post', 'users'));
        $this->render('/Users/profile');
    }

    public function edit($id = null)
    {
        $post = $this->Posts->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                return $this->redirect(['action' => 'index']);
            }
        }
        $users = $this->Posts->Users->find('list')->all();
        $this->set(compact('post', 'users'));
        $this->render('/Users/profile');
    }
}

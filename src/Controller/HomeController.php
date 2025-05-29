<?
namespace App\Controller;

use App\Controller\AppController;

class HomeController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
    }

    public function index()
    {
        $session = $this->request->getSession();
        $userId = $session->read('user_id');
        
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
}

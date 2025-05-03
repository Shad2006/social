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
        
    }
}

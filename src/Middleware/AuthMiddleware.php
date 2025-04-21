<?
namespace App\Middleware;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

class AuthMiddleware {
    public function __invoke(ServerRequest $request, Response $response, $next) {
        $allowed = ['Auth' => ['login', 'register']];
        if (!$request->getSession()->check('user_id') && 
            !in_array($request->getParam('controller'), array_keys($allowed)) &&
            !in_array($request->getParam('action'), $allowed[$request->getParam('controller')] ?? [])) {
            
        }
        return $next($request, $response);
    }
}

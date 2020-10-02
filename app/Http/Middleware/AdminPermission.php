<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;

use Closure;
use Auth;
use View;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Validate Admin Profile
        $user=Auth::guard('admin')->user();
        $profile=$user->profile;
        if(!$profile){
            //redirect to error page
            Auth::guard('admin')->logout();
            return redirect('/login');
        }

        //Application Permissions Here!
        $uri = explode('/', Route::current()->uri);
        $controller = count($uri)>1? $uri[1]: 'home';
        $module = \App\AdmModule::where('controller', $controller)->first();
        if(!$module){
            return redirect('admin/home/notfound');
        }
        if($controller=='home'){
            return $next($request);
        }

        $method = explode('@', Route::getCurrentRoute()->getActionName())[1];
        switch ($method) {
            case 'store':
            case 'update':
            case 'sort':
            case 'destroy':
                $action=\App\AdmAction::where('alias', 'administrar')->first();
                break;
            default:
                $action=\App\AdmAction::where('alias', 'listar')->first();
                break;
        }

        $event=\App\AdmEvent::where('module_id', $module->id)->where('action_id', $action->id)->first();
        $permission=\App\AdmPermission::where('event_id', $event->id)->where('profile_id', $profile->id)->first();
        if(!$permission && $profile->id!=1){
            //redirect to error page
            return redirect('admin/home/permission');
        }            

        View::share('current_module', $module);

        return $next($request);
    }
}

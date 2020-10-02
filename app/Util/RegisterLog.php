<?php
namespace App\Util;

use Illuminate\Support\Facades\Route;
use Auth;
use Log;

class RegisterLog {

    public static function login(){

		$module=\App\AdmModule::where('controller', 'login')->first();
		$action=\App\AdmAction::where('alias', 'login')->first();
        $event=\App\AdmEvent::where('module_id', $module->id)->where('action_id', $action->id)->first();
        $comment='El usuario ha ingresado al sistema';
		$user_id=Auth::user()->id;

        \App\AdmLog::create(['user_id'=>Auth::user()->id, 'event_id'=>$event->id, 'comment'=>$comment]);
		Log::info($comment.', user_id='.$user_id);

		return true;
	}

    public static function logout(){

		$module=\App\AdmModule::where('controller', 'login')->first();
		$action=\App\AdmAction::where('alias', 'logout')->first();
        $event=\App\AdmEvent::where('module_id', $module->id)->where('action_id', $action->id)->first();
        $comment='El usuario ha salido del sistema';
		$user_id=Auth::user()->id;

        \App\AdmLog::create(['user_id'=>$user_id, 'event_id'=>$event->id, 'comment'=>$comment]);
		Log::info($comment.', user_id='.$user_id);

		return true;
	}

    public static function add($obj=NULL){

        $controller = explode('/', Route::current()->uri)[1];
        $method     = explode('@', Route::getCurrentRoute()->getActionName())[1];
		$module=\App\AdmModule::where('controller', $controller)->first();

		if(!$module) return false;

		switch ($method) {
			case 'store':
			    $comment='Se ha insertado un item en: '.$module->name;
			    break;
			case 'update':
			    $comment='Se ha actualizado un item en: '.$module->name;
			    break;
			case 'sort':
			    $comment='Se ha ordenado la lista en: '.$module->name;
			    break;
			case 'destroy':
			    $comment='Se ha eliminado un item en: '.$module->name;
			    break;
			default:
				$comment=NULL;
				break;
		}

		$action=\App\AdmAction::where('alias', 'administrar')->first();
        $event=\App\AdmEvent::where('module_id', $module->id)->where('action_id', $action->id)->first();
		$user_id=Auth::user()->id;

        if($action->write_log=='1'){
			if($obj!=NULL) $comment.=', id='.$obj->id;
            //Guardar registro de logs
            \App\AdmLog::create(['user_id'=>$user_id, 'event_id'=>$event->id, 'comment'=>$comment]);
			Log::info($comment.', user_id='.$user_id);
        }

        return true;
  	}
}
?>
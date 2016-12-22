<?php
namespace App\Modules\Profile\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\City\City;
use App\Modules\User\User;
use Auth;
use Config;
use Crypt;
use Input;
use Lang;
use Request;
use Redirect;
use Response;
use Theme;
use Validator;

class ProfileController extends Controller {
	public function index(User $user) {
		return Theme::view('profile::Backend.profile',[
			'page_title' => Lang::get('app.my profile'),
			'data' => $user->join('user_groups','user_groups.id','=','users.user_group_id')
				->selectRaw('users.*,user_groups.name as user_group')
				->find(Auth::user()->id),
		]);
	}
	
	public function do_update() {
		$user_id =  Auth::user()->id;
		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');
		
        $field = array (
			'first_name' => $first_name,
			'last_name' => $last_name,
        );

        $rules = array (
            'first_name' => "required",
			'last_name' => "required",
        );

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$user = new User();
			$user = $user->find($user_id);
			$user->first_name  = $first_name;
			$user->last_name  = $last_name;
			$user->updated_at = date("Y-m-d H:i:s");
			$user->updated_by = Auth::user()->id;
			$user->save();
			
			//params json
			$params ['success'] =  true;
			$params ['message'] =  Lang::get('info.update successfully');				
		}

        return Response::json($params);
	}
	
	public function do_update_password() {
		$user_id =  Auth::user()->id;
		$password = Input::get('password');
		$confirm_password = Input::get('confirm_password');
		
        $field = array (
			'user_id' => $user_id,
			'password' => $password,
			'confirm_password' => $confirm_password,
        );

        $rules = array (
			'user_id' => "required",
			'password' => "required|min:5",
			'confirm_password' => "required|min:5|same:password",
		);

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$user = new User();
			$user = $user->find($user_id);
			$user->password  = bcrypt($password);
			$user->updated_at = date("Y-m-d H:i:s");
			$user->updated_by = Auth::user()->id;
			$user->save();
			
			//params json
			$params ['success'] =  true;
			$params ['message'] =  Lang::get('info.change password successfully');			
		}
		//return response
        return Response::json($params);
	}
	
	
}
<?php
namespace App\Modules\User\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\User\User;
use Config;
use Crypt;
use Input;
use Lang;
use Module;
use Request;
use Redirect;
use Response;
use Theme;
use Validator;

class UserController extends Controller {
	public function index(User $user) {
		return Theme::view('user::Backend.index',[
			'page_title' => Lang::get('app.user'),
			'users' => $user
				->join('user_groups','user_groups.id','=','users.user_group_id')
				->selectRaw('users.*,user_groups.name as user_group')
				->whereRaw("CONCAT(first_name,' ',last_name) LIKE '%".Request::get("query")."%'")
				->sortable(['name' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
			
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = User::join('user_groups','user_groups.id','=','users.user_group_id')
		->selectRaw('users.*,user_groups.name as user_group')
		->where('users.id',$id)
		->first();
		return Theme::view('user::Backend.view',[
			'page_title' => Lang::get('app.user').' '.$get_data->name,
			'data' => $get_data,
			
		]);
	}
	
	public function do_publish($id,User $user) {
		$id = Crypt::decrypt($id);
		$user = $user->find($id);
		if($user) {
			if($user->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update user
			$user->is_active = $active;
			$user->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = User::find($id);
		return Theme::view('user::Backend.form',[
			'page_title' => Lang::get('app.user').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_update() {
		$user_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$user_group_id = Input::get('user_group_id');
		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');
		$email = Input::get('email');
		$password = Input::get('password');
		$confirm_password = Input::get('confirm_password');
		
        $field = array (
			'user_group_id' => $user_group_id,
			'first_name' => $first_name,
            'email' => $email,
			'password' => $password,
			'confirm_password' => $confirm_password,
        );

        $rules = array (
			'user_group_id' => "required",
			'first_name' => "required",
            'email' => (!$user_id ? "required|unique:users,email" : "required|unique:users,email,$user_id"),
			'password' => (!$user_id ? "required|min:5" : ""),
			'confirm_password' => (!$user_id ? "required|min:5|same:password" : ""),
		);

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$user = new User();
			if(!empty($user_id)) {
				//update user
				$user = $user->find($user_id);
				$user->updated_at = date("Y-m-d H:i:s");
				$user->updated_by = Auth::user()->id;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new user
				$user->password  = bcrypt($password);
				$user->created_at = date("Y-m-d H:i:s");
				$user->created_by = Auth::user()->id;
				$message =  Lang::get('info.insert successfully');
			}
			
			$user->first_name = $first_name;
			$user->last_name = $last_name;
			$user->user_group_id  = $user_group_id;
			$user->email = $email;
			$user->save();
			
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/user/view/'.Crypt::encrypt($user->id));
			$params ['message'] =  $message;			
		}
		//return response
        return Response::json($params);
	}
	
	public function do_delete(User $user) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $user->select(['id'])->where('id',$id)->first();
        if($is_exists && $id != 1) {
			/** Batch Delete **/
            $user->where(['id' => $id])->delete();
			/** Batch Delete **/
            $params ['id'] =  $is_exists->id;
            $params ['success'] =  true;
            $params ['message'] =  Lang::get('info.delete successfully');
        } else {
			$params ['id'] =  1;
            $params ['success'] =  false;
            $params ['message'] =  Lang::get('info.delete failed');
		}
        return Response::json($params);
    }
	
	public function reset_password($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = User::find($id);
		return Theme::view('user::Backend.reset-password',[
			'page_title' => Lang::get('app.reset password').' '.($get_data ? $get_data->email : ''),
			'data' => $get_data,
		]);
	}
	
	public function do_reset_password() {
		$user_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
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
			$params ['redirect'] = url('/user/view/'.Crypt::encrypt($user->id));
			$params ['message'] =  Lang::get('info.change password successfully');			
		}
		//return response
        return Response::json($params);
	}
}
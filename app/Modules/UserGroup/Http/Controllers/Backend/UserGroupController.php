<?php
namespace App\Modules\UserGroup\Http\Controllers\Backend;

use Illuminate\Routing\Controller;
use App\Modules\UserGroup\UserGroup;
use App\Modules\UserGroup\UserGroupModule;
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

class UserGroupController extends Controller {
	public function index(UserGroup $user_group) {
		return Theme::view('user-group::Backend.index',[
			'page_title' => Lang::get('app.user group'),
			'user_groups' => $user_group
				->whereRaw("name LIKE '%".Request::get("query")."%'")
				->sortable(['name' => 'asc'])
				->paginate(Config::get('site.limit_pagination')),
			
		]);
	}
	
	public function view($id) {
		$id = Crypt::decrypt($id);
		$get_data = UserGroup::selectRaw("*")
		->where('user_groups.id',$id)
		->first();
		return Theme::view('user-group::Backend.view',[
			'page_title' => Lang::get('app.user group').' '.$get_data->name,
			'data' => $get_data,
			'modules' => Module::sortBy('name')->all(),
		]);
	}
	
	public function do_publish($id,UserGroup $user_group) {
		$id = Crypt::decrypt($id);
		$user_group = $user_group->find($id);
		if($user_group) {
			if($user_group->is_active == 1) 
				$active = 0;
			else
				$active = 1;
			//update user group
			$user_group->is_active = $active;
			$user_group->save();	
		}
		return Redirect::back();
	}
	
	public function form($id = 0) {
		$id = $id ? Crypt::decrypt($id) : 0;
		$get_data = UserGroup::find($id);
		return Theme::view('user-group::Backend.form',[
			'page_title' => Lang::get('app.user group').' '.($get_data ? $get_data->name : ''),
			'data' => $get_data,
			'modules' => Module::sortBy('name')->all(),
		]);
	}
	
	public function do_update() {
		$user_group_id =  Input::has("id") ? Crypt::decrypt(Input::get("id")) : null;
		$name = Input::get('name');
		$description = Input::get('description');
		
        $field = array (
            'name' => $name,
			'description' => $description,
        );

        $rules = array (
            'name' => (!$user_group_id ? "required|unique:user_groups,name" : "required|unique:user_groups,name,$user_group_id"),
			'description' => "required",
		);

        $validate = Validator::make($field,$rules);

        if($validate->fails()) {
            $params = array(
                'success' => false,
                'message' => $validate->getMessageBag()->toArray()
            );
		} else {
			$user_group = new UserGroup();
			if(!empty($user_group_id)) {
				//update user
				$user_group = $user_group->find($user_group_id);
				$user_group->updated_at = date("Y-m-d H:i:s");
				$user_group->updated_by = 1;
				$message = Lang::get('info.update successfully');
			} else {
				//insert new user
				$user_group->created_at = date("Y-m-d H:i:s");
				$user_group->created_by = 1;
				$message =  Lang::get('info.insert successfully');
			}
			
			$user_group->name  = $name;
			$user_group->description = $description;
			$user_group->save();
			$user_group_id = $user_group->id;
			//access token group & delete all access new
			$delete_user_group_module = UserGroupModule::where(['user_group_id'=>$user_group_id])->delete();
			//insert new access
			$modules = Module::all();
			foreach($modules as $module) {
				//read 
				if(Input::has('read-'.$module['slug'])) {
					$user_group_module  = new UserGroupModule();
					$user_group_module->user_group_id = $user_group_id;
					$user_group_module->module_slug = $module['slug']; 
					$user_group_module->access = 'r';
					$user_group_module->save();
				}
				
				//create
				if(Input::has('create-'.$module['slug'])) {
					$user_group_module  = new UserGroupModule();
					$user_group_module->user_group_id = $user_group_id;
					$user_group_module->module_slug = $module['slug']; 
					$user_group_module->access = 'c';
					$user_group_module->save();
				}
				
				//update
				if(Input::has('create-'.$module['slug'])) {
					$user_group_module  = new UserGroupModule();
					$user_group_module->user_group_id = $user_group_id;
					$user_group_module->module_slug = $module['slug']; 
					$user_group_module->access = 'u';
					$user_group_module->save();
				}
				
				//delete
				if(Input::has('create-'.$module['slug'])) {
					$user_group_module  = new UserGroupModule();
					$user_group_module->user_group_id = $user_group_id;
					$user_group_module->module_slug = $module['slug']; 
					$user_group_module->access = 'd';
					$user_group_module->save();
				}
			}
			
			//params json
			$params ['success'] =  true;
			$params ['redirect'] = url('/user-group/view/'.Crypt::encrypt($user_group_id));
			$params ['message'] =  $message;			
		}
		//return response
        return Response::json($params);
	}
	
	public function do_delete(UserGroup $user_group,UserGroupModule $user_group_module) {
        $id = Crypt::decrypt(Input::get("id"));
        $is_exists = $user_group->select(['id'])->where('id',$id)->first();
        if($is_exists && $id != 1) {
			/** Batch Delete **/
            $user_group->where(['id' => $id])->delete();
			$user_group_module->where(['user_group_id' => $id])->delete();
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
}
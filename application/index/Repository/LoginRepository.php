<?php
namespace app\index\repository;
use think\Request; 
use app\index\model\Users;
use think\Loader;
use app\index\validate\LoginValidate;
use think\Session;
use think\Controller;

class LoginRepository
{
    public function __construct(){
    	if(Session::has('uid','think') ){
			return ['code'	=>	1,'msg'	=>	'已经登陆'];
		}
    }

	public function login(){
	
		Request::instance()->isPost() || die('request not  post!');

		$param = Request::instance()->param();
		
		$validate = Loader::validate('LoginValidate');
		if( !$validate->check($param) ){
			return ['code'	=>	0,'msg'	=>	$validate->getError() ];
		}

		$users=Users::get(function($query) use ($param){
		    $query->where('email', $param['email']);
		});
		

		if( !is_object($users) ){
			return  ['code'	=>	1,'msg'	=>	'帐户名不存在'];
		}

		if( md5($param['password']) == $users->password ){
			Session::set('uid',$users->uid,'think');
			return ['code'	=>	1,'msg'	=>	'登陆成功'];
		}else{
			return ['code'	=>	0,'msg'	=>	'密码不对'];
		}
	}


	public function quit(){
		Session::delete('uid','think');
	}

}
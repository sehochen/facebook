<?php
namespace app\index\repository;
use think\Request; 
use app\index\model\Users;
use think\Session;
use think\Loader;
use app\index\validate\UserValidate;

class UserRepository
{	
	public function getInfos()
	{
        $user = Users::find( Session::get('uid','think') );
         return $user->getInfo;   
	}

	public function register()
	{
		Request::instance()->isPost() || die('request not  post!');
		$param = Request::instance()->param();

		$validate = Loader::validate('UserValidate');
		if( !$validate->check($param) ){
			return ['code'	=>	0,'msg'	=>	$validate->getError() ];
		}

		if(  Users::get(['email' => $param['email'] ] ) ){
			return ['code'	=>	0,'msg'	=>	'邮箱已经存在' ];
		}

		if( $param['password'] != $param['c_password'] ){
			return ['code'	=>	0,'msg'	=>	'两次密码不一致' ];
		}

		// $param['password'] = md5($param['password']);

		$user = new Users($param);
			
		if( $user->allowField(true)->save() ){
			return ['code'	=>	1,'msg'	=>	'注册成功' ];
		}else{
			return ['code'	=>	0,'msg'	=>	'注册失败' ];
		}
	}

    protected static function init()
    {
        User::beforeInsert(function ($user) {
            if ($user->status != 1) {
                return false;
            }
        });
    }


}
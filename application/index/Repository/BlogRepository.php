<?php
namespace app\index\repository;
use think\Request; 
use think\Loader;
use app\index\model\Blogs;
use app\index\model\Users;
use app\index\validate\BlogValidate;
use think\Session;
use think\Db;
class BlogRepository
{
	
	public function create()
	{
		Request::instance()->isPost() || die('request not  post!');

		$param = Request::instance()->param();
		$param['uid'] = Session::get('uid','think');
		$param['add_time'] = time();

		$validate = Loader::validate('BlogValidate');

		if( !$validate->check($param) ){
		    return json( ['code' => -1, 'msg' => $validate->getError(), 'time' => time()] );
		}else{
			return json( Blogs::create($param) ?  ['code' => 1, 'msg' => '发布成功', 'time' => time()] : ['code' => 1, 'msg' => '发布失败', 'time' => time()] );
		}     
	}

	// 我的blog列表
	public function blog(){	
		$user = Users::find( Session::get('uid','think') );
		return $user->getBlog;
	}

	public function blogList(){
		return Blogs::alias('a')
			->field('a.*,b.*,c.*')
			->join('__USERINFOS__ b ','b.uid= a.uid')
			->join('__USERS__ c ','c.uid= b.uid')
			->order('add_time', 'desc')
			->limit(5)		
			->select();
	}

}
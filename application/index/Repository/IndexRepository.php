<?php
namespace app\index\repository;
use think\Request; 
use think\Loader;
use app\index\model\Blogs;
use app\index\model\Users;
use app\index\model\Praises; 
use app\index\model\Friends;
use app\index\model\Comments;
use app\index\model\Userinfos;
use app\index\validate\BlogValidate;
use app\index\validate\CommentValidate; 
use app\index\validate\PraiseValidate; 
use think\Session;
use think\Db;


class IndexRepository
{
	
	//发布微博
	public function create()
	{
		Request::instance()->isPost() || die('request not  post!');

		$param = Request::instance()->param();
		$param['uid'] = Session::get('uid','think');
		$param['add_time'] = time();

		$validate = Loader::validate('BlogValidate');

		if( !$validate->check($param) ){
		    return ['code' => -1, 'msg' => $validate->getError()];
		}else{
			return Blogs::create($param) ?  ['code' => 1, 'msg' => '发布成功'] : ['code' => 0, 'msg' => '发布失败'];
		}     
	}

	//我关注的人
	public function myFriends(){
		$param = Friends::field('fid')
		->where(['uid'=>Session::get('uid','think')])
		->select();

		$params=[];
		foreach($param as $v){
			$params[]=$v->fid;
		}
		return $params;
	}


	//我关注人的weibo列表
	public function blogList(){

		$params=$this->myFriends();
		$params=implode(',',$params).','.Session::get('uid','think');

		return Blogs::alias('a')
		->field('a.*,b.name,b.head')
		->join('__USERINFOS__ b ','b.uid= a.uid')
		// ->join('__USERS__ c ','c.uid= b.uid')
		->where('a.uid','in', $params)
    	->order('a.add_time', 'desc')
		->paginate(10);
	}

    public function hours(){
        $hour = date('H',time());
        $welcome=null;
        if($hour>=5 && $hour<11 ){
            $welcome='早上好！';    
        }else if($hour>=11 && $hour<13 ){
            $welcome='中午好！';
        }else if($hour>=13 && $hour<16 ){
            $welcome='下午好！';
        }else if($hour>=16 && $hour<18 ){
            $welcome='傍晚好！';
        }else if($hour>=18 && $hour<23 ){
            $welcome='晚上好！';
        }else if($hour>=23 && $hour<5 ){
            $welcome='凌晨好！';
        }

        return   $welcome;     
    }

	// 评论发布
	public function comments(){
		Request::instance()->isPost() || die('request not  post!');

		$param = Request::instance()->param();
		$param['uid'] = Session::get('uid','think');
		$param['add_time'] = time();
		$param['content']  = isset( $param['editorValue']) ?$param['editorValue']:null;
		if( isset( $param['editorValue'] ) ){
			unset($param['editorValue']);
		} 

		$validate = Loader::validate('CommentValidate');

		if( !$validate->check($param) ){
		    return ['code' => -1, 'msg' => $validate->getError(), 'time' => time()];
		}else{
			return Comments::create($param) ?  ['code' => 1, 'msg' => '发布成功'] : ['code' => 0, 'msg' => '发布失败'];
		}  

	}
    
	// 评论列表
	public function commentList(){
		return Comments::alias('a')
		->field('a.*,a.id as cid,b.*')
		->join('__USERINFOS__ b ','b.uid= a.uid')
		->join('__BLOGS__ c','c.id=a.bid')
    	->order('a.add_time', 'desc')	
		->select();
	}


	//点赞 
	public function praise(){
		Request::instance()->isPost() || die('request not  post!');

		$param = Request::instance()->param();
		$param['uid'] = Session::get('uid','think');
		$param['add_time'] = time();


		$res=Praises::field('bid')
			->where([
				'uid'	=>	$param['uid'],
				'bid'	=>	$param['bid']
				])
			->find();

		if($res){
			$result=Praises::destroy([
				'uid'	=>	$param['uid'],
				'bid'	=>	$param['bid']				
			]);

			return $result ? ['code' => 1, 'msg' => '取消成功','status'=>0] : ['code' => 0, 'msg' => '取消失败','status'=>1];
		}


		$validate = Loader::validate('PraiseValidate');

		if( !$validate->check($param) ){
		    return ['code' => -1, 'msg' => $validate->getError()];
		}else{
			return Praises::create($param) ? ['code' => 1, 'msg' => '点赞成功','status'=>1] : ['code' => 0, 'msg' => '点赞失败','status'=>0];
		}  

	}
    

	//我的点赞列表
	public function myPraise(){
		return Praises::field('bid')
			->where([
				'uid'	=>	Session::get('uid','think'),
				])
			->select();
	}


	//获取某个微博点赞人数的uid
	public function blogPraise($bid){
		return Praises::field('group_concat(uid) as uids')
			->where(['bid'=>$bid])
			->order('add_time', 'desc')
			->find();
	}


	//获取某个微博点赞人数的名字和总数
	public function praiseName(){
		$bid=Request::instance()->param('bid');
		$res=$this->blogPraise($bid);
		$names=Userinfos::field('group_concat(name) as names,count(uid) as counts')
			->where('uid','in', $res->uids)
			->find();

			$nameArray=explode(',',$names->names);
		return [
			'names'		=>	$names->names,
			'first'		=>	$nameArray[0],
			'count'	=>	$names->counts,
		];
	}


	//分享 转发
	public function share(){
		$bid=Request::instance()->param('bid');

		$res=Blogs::field('uid,content')
			->where([ 'id' => $bid ])
			->find();
		
		$param=[
			'uid'	=>	Session::get('uid','think'),
			'add_time'	=>	time(),
			'content'	=>	$res->content,
			'share'		=>	$res->uid
		];	

		// if( $param['uid'] == $param['share'] ){
		// 	return ['code' => -1, 'msg' => '不能转发自己的微博'];	
		// }

		$validate = Loader::validate('BlogValidate');

		if( !$validate->check($param) ){
		    return ['code' => -1, 'msg' => $validate->getError()];
		}else{
			return Blogs::create($param) ?  ['code' => 1, 'msg' => '转发成功'] : ['code' => 0, 'msg' => '转发失败'];
		}  

		return $res;		
	}

	//获取名字
	public function getShareName(){
		$uid=Request::instance()->param('uid');

		$res=Userinfos::field('name,uid')
		->where([ 'uid' => $uid ])
		->find();

		return [
			'name'	=>	$res->name,
			'uid'	=>	$res->uid
		];
	}


	//删除博文
	public function delBlog(){
        $id = Request::instance()->param('id');
        $param = [ 'id'  =>  $id ];

        $users=Blogs::where($param)
            ->delete(); 

		$this->delComment( $id );
		$this->delPraise( $id );
		   
        return $users? ['code'=>1,'msg'=>'删除成功!'] : ['code'=>-1,'msg'=>'删除失败!'];		
	}

	//根据博文id删除评论
	public function delComment($id){
        $param = [ 'bid'  =>  $id ];

        $users=Comments::where($param)
            ->delete();   

		return $users? true : false;
        	
	}

	//根据博文id删除点赞
	public function delPraise($id){
        $param = [ 'bid'  =>  $id ];

        $users=Praises::where($param)
            ->delete();   

		return $users? true : false;
        	
	}

	// 删除评论
	public function delComments(){
        $id = Request::instance()->param('id');
        $param = [ 'id'  =>  $id ];

        $users=Comments::where($param)
            ->delete(); 
		   
        return $users? ['code'=>1,'msg'=>'删除成功!'] : ['code'=>-1,'msg'=>'删除失败!'];		
	}

	// 推荐用户
	public function hotUser(){
		$params=$this->myFriends();
		$params=implode(',',$params).','.Session::get('uid','think');

		return Userinfos::field('name,head,uid')
		->where('uid','not in', $params)
		->limit(10)
		->select();
	}


}
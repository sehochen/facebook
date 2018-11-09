<?php
namespace app\index\repository;
use think\Request; 
use app\index\model\Userinfos;
use app\index\model\Friends;
use app\index\model\Blogs;

class HomeRepository 
{
    
    public function getInfo(){
        $uid = Request::instance()->param('uid');
        return Userinfos::where([
            'uid'   => $uid,
        ])->find();

    }

    // 获取关注好友
     public function getFriend(){
        $uid = Request::instance()->param('uid');
        
        return Friends::alias('a')
        ->field('a.*,b.name,b.head')
		->join('__USERINFOS__ b ','b.uid= a.fid')
        ->where([
            'a.uid'   => $uid,
            ])
        ->select();

    }  

    // 获取fans
    public function getFans(){
        $fid = Request::instance()->param('uid');
        
        return Friends::alias('a')
        ->field('a.*,b.name,b.head')
		->join('__USERINFOS__ b ','b.uid= a.uid')
        ->where([
            'a.fid'   => $fid,
            ])
        ->select();

    }     


     public function getBlog(){
        $uid = Request::instance()->param('uid');
        
		return Blogs::alias('a')
		->field('a.*,b.name,b.head')
		->join('__USERINFOS__ b ','b.uid= a.uid')
		->where(['a.uid'=>$uid])
    	->order('a.add_time', 'desc')
		->paginate(10);

    }   



}

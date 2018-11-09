<?php
namespace app\index\repository;
use think\Request; 
use app\index\model\Userinfos;
use app\index\model\Friends;
use think\Session;

class SearchRepository
{
    public function search(){
        $name = Request::instance()->param('name');
        $user = Userinfos::where([
                'name'  =>  ['like',$name.'%'], 
                ])
            ->where('uid','<>',Session::get('uid','think')) //去除自己
            ->select();

        return $user;
    }

    //我的好友列表
    public function myFriend(){
        $user = Friends::field('fid')
            ->where([
                'uid'  =>  Session::get('uid','think'), 
                ])
            ->order('add_time desc')
            ->select();

        return $user;
    }



    //筛选我的已经添加的好友
    public function searchFriend(){
        $res = $this->search();
        $fid = $this->myFriend();

        static $temp=[];
        foreach ( $res as $key => $value) {

            foreach ($fid as $k => $v) {
                if( $v->fid == $value->uid){
                    $value->status=1;
                }
            }

            isset( $value->status ) || $value->status=0;

               $temp[]=$value;             
        }

        return $temp;
    }



    //添加
    public function addFriend(){
        $fid = Request::instance()->param('fid');
        $param = [
            'uid'       =>  Session::get('uid','think'),
            'fid'       =>  $fid,
            'add_time'  =>  time()
        ];

        if(($param['uid']==$param['fid']) ){
            return ['code'=>-1,'msg'=>'你不能关注自己!'];
        }

        $users=Friends::where([
                'uid'  => $param['uid'] , 
                'fid'  => $param['fid'] , 
                ])
            ->find();
            
        if( $users ){
            return ['code'=>-1,'msg'=>'你已经关注过了!'];
        } 

        $user = new Friends($param);
        return $user->save() ? ['code'=>1,'msg'=>'关注成功!'] : ['code'=>-1,'msg'=>'关注失败!'];
    }


    public function delFriend(){
        $fid = Request::instance()->param('fid');
        $param = [
            'uid'       =>  Session::get('uid','think'),
            'fid'       =>  $fid,
        ];

        $users=Friends::where($param)
            ->delete();        
        return $users? ['code'=>1,'msg'=>'取消关注!'] : ['code'=>-1,'msg'=>'取消失败!'];
    }  


}    
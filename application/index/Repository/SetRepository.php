<?php
namespace app\index\repository;
use think\Request; 
use app\index\model\Userinfos;
use app\index\model\Users;
use think\Session;

class SetRepository
{

    public function update(){
        Request::instance()->isPost() || die('request not  post!');

		$param = Request::instance()->param();

       if( request()->file('image') ) {
           $param['head'] = $this->upload();
       } 

        $uid = Session::get('uid','think');

        $user = new Userinfos();
        return $user->allowField(true)->save($param,['uid' => $uid]) || ['code'	=>	0,'msg'	=>'修改失败' ];
    }    


    public function getInfo(){
        return Userinfos::get( Session::get('uid','think') );
    }    


    public function upload(){

        $file = request()->file('image');

        $user= $this->getInfo();
        if( is_file( dirname(THINK_PATH).'/public' .$user->head )  ) {
            if( $user->head != '/static/home/images/head.jpg' ){
                unlink(  dirname(THINK_PATH).'/public' .$user->head );
            }
        } 

        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){

            return '/uploads/'.$info->getSaveName();

        }else{
            return ['code'	=>	0,'msg'	=> $file->getError() ];
        }
        
    }


    public function getPassword(){
        $res=Users::field('password')
        ->where( ['uid'=>Session::get('uid','think')] )
        ->find();
        return $res->password;
    }   


    public function updatePass(){
        Request::instance()->isPost() || die('request not  post!');
		$param = Request::instance()->param();
        $uid = Session::get('uid','think');

        if( md5( $param['old_password'] ) != $this->getPassword() ){
            return ['code'	=>	0,'msg'	=> '原密码错误' ];
        }
        
        if( $param['new_password'] != $param['c_password'] ){
            return ['code'	=>	0,'msg'	=> '两次密码不一致' ];
        }        

        $param['password']= md5($param['new_password']);
        $user = new Users();
        return $user->allowField(true)->save($param,['uid' => $uid]) || ['code'	=>	0,'msg'	=> '修改失败' ];
    }

}

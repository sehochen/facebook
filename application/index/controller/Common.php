<?php

namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\index\model\Users;
use app\index\repository\IndexRepository;

class Common extends Controller
{
    public function _initialize(){
        
    	if( !Session::get('uid','think') ){
            return $this->redirect("Login/index"); 
        }

        $this->userInfo();
    } 
    
    public function userInfo(){
        $user = Users::find( Session::get('uid','think') );
        $index = new IndexRepository();;
		$this->assign([
            'info'      =>  $user->getInfo,
            'hotUser'   =>  $index->hotUser(),
        ]);    

    }

}

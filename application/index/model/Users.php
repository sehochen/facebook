<?php

namespace app\index\model;
use think\Model;

class Users extends Model
{
    protected $pk = 'uid';
    
    public function getInfo(){
        return $this->hasOne('Userinfos','uid');
    }

    public function getBlog(){
         return $this->hasMany('Blogs','uid');
    }

    protected static function init()
    {
        Users::event('before_insert', function ($user) {
            $user->password = md5($user->password);
        });

        Users::event('after_insert', function ($user) {

            $userInfo = new Userinfos([
                'name'  =>  $user->email,
                'head'  =>  '/static/home/images/head.jpg',
                'uid'   =>  $user->uid                
            ]);
            $userInfo->save();

            $blog = new Blogs([
                'content'  => '<p><img src="http://img.baidu.com/hi/jx2/j_0059.gif" _src="http://img.baidu.com/hi/jx2/j_0059.gif"><span style="line-height: 22.8571px; white-space: normal;">我刚刚注册,请大家多多关照!</span></p>' ,
                'add_time'  =>  time(),
                'uid'   =>  $user->uid                
            ]);
            $blog->save();
          
        });
    }

}

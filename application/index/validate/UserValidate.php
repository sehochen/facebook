<?php
namespace app\index\validate;
use think\Validate;

class UserValidate extends Validate
{

    protected $rule = [
    	'email'	        =>	'require|email',
        'password'      =>  'require',
        'c_password'    =>  'require',
    ];

    protected $message = [
    	'email.require'	        =>  '邮箱不能为空',
        'email.email'	        =>  '邮箱格式不对',
        'password.require'      =>  '密码不能为空',
        'c_password.require'    =>  '确认密码不能为空',
    ];

    protected $scene = [
        'add'   =>  ['email','password','c_password'],
        'edit'  =>  ['email','password','c_password'],
    ];	

}
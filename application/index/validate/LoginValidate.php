<?php
namespace app\index\validate;
use think\Validate;

class LoginValidate extends Validate
{

    protected $rule = [
    	'email'	=>	'require',
        'password'  =>  'require',
    ];

    protected $message = [
    	'email.require'	=>'邮箱不能为空',
        'password.require'  =>  '密码不能为空',

    ];

    protected $scene = [
        'add'   =>  ['email','password'],
        'edit'  =>  ['email','password'],
    ];	

}
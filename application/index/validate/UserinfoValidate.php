<?php
namespace app\index\validate;
use think\Validate;

class UserinfoValidate extends Validate
{
    
    protected $rule = [
    	'name'	=>	'require',
    ];

    protected $message = [
    	'name.require'	=>'名字不能为空',
    ];

    protected $scene = [
        'add'   =>  ['name'],
        'edit'  =>  ['name'],
    ];	
    
}

<?php
namespace app\index\validate;
use think\Validate;

class BlogValidate extends Validate
{

    protected $rule = [
    	'uid'	=>	'require',
        'content'  =>  'require|min:15',
    ];

    protected $message = [
    	'uid.require'	=>'uid不能为空',
        'content.require'  =>  '内容不能为空',
        'content.min'  =>  '内容太少',
    ];

    protected $scene = [
        'add'   =>  ['content'],
        'edit'  =>  ['content'],
    ];	   

}
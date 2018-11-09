<?php
namespace app\index\validate;
use think\Validate;

class CommentValidate extends Validate
{

    protected $rule = [
    	'uid'	        =>	'require',
        'bid'           =>  'require',
        'add_time'      =>  'require',
        'content'       =>  'require|min:15',
    ];

    protected $message = [
    	'uid.require'	      =>  'uid不能为空',
        'bid.require'         =>  'bid不能为空',
        'content.require'	  =>  '内容不能为空',
        'content.min'	      =>  '内容太少',
        'add_time.require'    =>  '时间不能为空',
    ];

    protected $scene = [
        'add'   =>  ['uid','bid','add_time','content'],
        'edit'  =>  ['uid','bid','add_time','content'],
    ];	

}
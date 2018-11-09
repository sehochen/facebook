<?php
namespace app\index\validate;
use think\Validate;

class PraiseValidate extends Validate
{

    protected $rule = [
    	'uid'	        =>	'require',
        'bid'           =>  'require',
        'add_time'      =>  'require',
    ];

    protected $message = [
    	'uid.require'	      =>  'uid不能为空',
        'bid.require'         =>  'bid不能为空',
        'add_time.require'    =>  '时间不能为空',
    ];

    protected $scene = [
        'add'   =>  ['uid','bid','add_time'],
        'edit'  =>  ['uid','bid','add_time'],
    ];	

}
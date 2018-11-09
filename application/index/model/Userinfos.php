<?php

namespace app\index\model;

use think\Model;

class Userinfos extends Model
{
    protected $pk = 'id';
    public function user()
    {
        return $this->belongsTo('Users','uid');
    }
}

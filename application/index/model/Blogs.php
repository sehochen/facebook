<?php

namespace app\index\model;

use think\Model;

class Blogs extends Model
{
    protected $pk = 'id';

    public function user()
    {
        return $this->belongsTo('Users','uid');
    }
        
}

<?php
namespace app\index\controller;
use app\index\repository\IndexRepository;

class Index extends Common
{

	protected $repo;
    
    public function __construct(IndexRepository $repo)
    {
        parent::__construct();
        $this->repo = $repo;

    }	

    public function index()
    {    
        $this->assign([
            'blog'      =>   $this->repo->blogList(),
            'hours'     =>   $this->repo->hours(),
            'comment'   =>   $this->repo->commentList(),
            'praise'    =>   $this->repo->myPraise(),
        ]);
        return view();
    }

    public function save()
    {
    	return $this->repo->create(); 
    }

    public function comment(){
        return $this->repo->comments();
    }

    public function praise(){
        return $this->repo->praise();
    }
    
    public function praiseName(){
        return $this->repo->praiseName();
    }

    public function share(){
        return $this->repo->share();
    }    

    public function getShareName(){
        return $this->repo->getShareName();
    }

    public function delete(){
        return $this->repo->delBlog();
    }


    public function delComment(){
        return $this->repo->delComments();
    }

}

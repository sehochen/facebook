<?php
namespace app\index\controller;
use think\Controller;
use app\index\repository\HomeRepository;
use app\index\repository\IndexRepository;

class Home extends Common
{

	protected $repo;
    protected $index;
    public function __construct(HomeRepository $repo,IndexRepository $index)
    {
        parent::__construct();
        $this->repo = $repo;
        $this->index = $index;
    }	

    public function index(IndexRepository $index)
    {
        $this->assign([
            'infos'    =>  $this->repo->getInfo(),
            'friend'  =>  $this->repo->getFriend(),
            'blog'   =>  $this->repo->getBlog(),
            'fans'   =>  $this->repo->getFans(),  
            'comment'   =>   $this->index->commentList(),
            'praise'    =>   $this->index->myPraise(),   
            'guan'      =>   $this->index->myFriends(),    
        ]);

        // dump( $this->index->myFriends() );
        return view();
    }



}

<?php
namespace app\index\controller;
use think\Request;
use app\index\repository\SetRepository;

class Set extends Common
{
	protected $repo;
    public function __construct(SetRepository $repo)
    {
        parent::__construct();
        $this->repo = $repo;
    }	

    public function index()
    {   
        $this->assign([
            'myInfo'    =>   $this->repo->getInfo(),
        ]);
        // dump( get_defined_constants(1) );
        return view();
    }


    public function save()
    {
         return $this->repo->update();
    }


    public function more()
    {
        $this->assign([
            'myInfo'    =>   $this->repo->getInfo(),
        ]);
        return view();
    }

    public function password()
    {
        return view();
    }

    public function updatePass()
    {
        return $this->repo->updatePass();
    }

}

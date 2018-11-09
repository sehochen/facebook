<?php
namespace app\index\controller;
use think\Request;
use app\index\repository\SearchRepository;

class Search extends Common
{

    protected $repo;
    public function __construct(SearchRepository $repo)
    {
        parent::__construct();
        $this->repo = $repo;
    }	

    public function index()
    {
        $this->assign([
            'user'      =>   $this->repo->searchFriend(),
        ]);
        
        return view();
    }


    public function save()
    {
        return $this->repo->addFriend();
    }

    public function delete()
    {
        return $this->repo->delFriend();
    }

    public function addFriend()
    {
        return $this->repo->addFriend();
    }

}

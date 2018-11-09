<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\repository\LoginRepository;
use app\index\repository\UserRepository;

class Login extends Controller
{
	protected $repo;
    public function __construct(LoginRepository $repo)
    {
        $this->repo = $repo;
    }	

    public function index()
    {
        return view();
    }

    public function save(Request $request)
    {
        $res=$this->repo->login();
        $res['code'] >0 ? $this->success($res['msg'], 'Index/index') : $this->error($res['msg']);
    }

    public function register()
    {
        return view();
    }

    public function reg(UserRepository $resister)
    {
        $res=$resister->register();
        $res['code'] >0 ? $this->success($res['msg'], 'Login/index') : $this->error($res['msg']);
    }

    public function quit()
    {
        $this->repo->quit();
        return $this->redirect("Login/index"); 
    } 


}

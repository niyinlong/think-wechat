<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return json([status=>0,'msg'=>'hello']);
    }
}

<?php
namespace app\index\controller;

class Index
{
    public function index()
    {   
        dump(input("post.a"));
        dump(input("get.token"));
        dump(input("server.HTTP_TOKEN"));
    }
}

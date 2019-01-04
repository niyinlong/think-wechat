<?php
namespace app\wechat\controller;
use think\Controller;
use util\geohash;
use wechat\core\accesstoken;
use wechat\core\jssdk;
use wechat\core\wechat;

class Index extends Controller {

	private $appId = "";
	private $appSecret = "";
	private $token = "";

	public function index() {
		$tool = new wechat($this->appId, $this->appSecret);
		// 权限验证
		//$tool->valid($this->token);
		// 信息应答接口
		$tool->response();
	}

}

<?php

/**
 * @function：微信服务器调用接口
 *
 * */
namespace wechat\core;
use wechat\core\message;
use wechat\core\api;

class wechat {
	
	private $appId;
	private $appSecret;
	//构造函数
	public function __construct($appid, $appsecret) {
		$this->appid = $appid;
		$this->appSecret = $appsecret;
		// 如果没有查询到缓存则添加缓存
		if ((!cache("appid")) || (!cache("appsecret"))) {
			cache("appid", $appid,0);
			cache("appsecret", $appsecret,0);
		}
	}

	//验证函数
	public function valid($token) {
		$signature = input('get.signature');
		$timestamp = input('get.timestamp');
		$nonce = input('get.nonce');
		$echoStr = input('get.echostr');
		//验证的时候清空 APPID 还有 APPsecret
		cache("appid", $this->appid,0);
		cache("appsecret", $this->appSecret,0);
		if ($this -> checkSignature($token, $signature, $timestamp, $nonce)) {
			echo $echoStr;
			exit ;
		}
	}

	//应答函数
	public function response() {
		$postStr = file_get_contents("php://input");
		if (isset($postStr)) {
			$postObj = simplexml_load_string($postStr);
			$msgObj = new message($postObj);
			$api = new api($msgObj);
			switch($msgObj->msgType) {
				//文本信息处理
				case "text" :
					{
						$resultStr = $api -> textHandler();
						echo $resultStr;
					}
					break;
				//处理地理位置信息
				case "location" :
					{
						$resultStr = $api -> locationHandler();
						echo $resultStr;
					}
					break;
				//处理事件
				case "event" :
					{
						$resultStr = $api -> eventHandler();
						echo $resultStr;
					}
					break;
				//图片信息
				case "image" :
					{
						$resultStr = $api -> imageHandler();
						echo $resultStr;
					}
					break;
				//声音信息
				case "voice" :
					{
						$resultStr = $api -> voiceHandler();
						echo $resultStr;
					}
					break;
				//视频信息
				case "video" :
					{
						$resultStr = $api -> videoHandler();
						echo $resultStr;
					}
					break;
				//短视频信息
				case "shortvideo" :
					{
						$resultStr = $api -> shortVideoHandler();
						echo $resultStr;
					}
					break;
				// 链接信息
				case "link" :
					{
						$resultStr = $api -> linkHandler();
						echo $resultStr;
					}
					break;
				default :{
						$resultStr = $api -> defaultHandler();
						echo $resultStr;
					}break;
			}
		} else {
			echo "";
			exit ;
		}
	}

	//验证签名
	private function checkSignature($token, $signature, $timestamp, $nonce) {
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if ($tmpStr == $signature)
			return true;
		else
			return false;
	}

}
?>
<?php
namespace wechat\core;
use wechat\core\accesstoken;
use wechat\core\curl;
class jssdk{
	
	private $appId;
  	private $appSecret;
	
	public function __construct($appId, $appSecret) {
	    $this->appId = $appId;
	    $this->appSecret = $appSecret;
  	}
  	public function getSignPackage() {
	    $jsapiTicket = $this->getJsApiTicket();
	    // 注意 URL 一定要动态获取，不能 hardcode.
	    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	    $timestamp = time();
	    $nonceStr = $this->createNonceStr();
	
	    // 这里参数的顺序要按照 key 值 ASCII 码升序排序
	    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
	    $signature = sha1($string);
	    $signPackage = array(
		      "appId"     => $this->appId,
		      "nonceStr"  => $nonceStr,
		      "timestamp" => $timestamp,
		      "url"       => $url,
		      "signature" => $signature,
		      "rawString" => $string
	    );
	    return $signPackage; 
  	}  	
  	private function getJsApiTicket() {
		$data = json_decode(cache("jsapi_ticket"));
		// 如果为空则设置为过期
		if($data==null){
			$data = json_decode('{"jsapi_ticket":"","expire_time":0}');
		}
		if ($data->expire_time < time()) {
			// 获取accesstoken
			$tool = new accesstoken($this->appId,$this->appSecret);
			$this->accessToken = $tool->getAccessToken();
			// 如果是企业号用以下 URL 获取 ticket
			// $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
			$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$this->accessToken;
			$res = curl::callWebServer($url, '', 'GET');
			$ticket = $res['ticket'];
			if ($ticket){
			     $data->expire_time = time() + 7000;
			     $data->jsapi_ticket = $ticket;
			     cache("jsapi_ticket", json_encode($data),0);
		     }
		} else {
		     $ticket = $data->jsapi_ticket;
		}
		return $ticket;
	}
	private function createNonceStr($length = 16) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for ($i = 0; $i < $length; $i++) {
		    $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
		}
		return $str;
  	}
}

?>
<?php

/**
 * @function：令牌权限认证
 *
 */

namespace wechat\core;
use wechat\core\curl;
/**
 * 获取accesstoken
 * appid appsecret 等在配置文件里可以进行配置
 * accessToken 放在缓存数组中
 */
class accesstoken {
	
	private $appId;
	private $appSecret;
	
	public function __construct($appId, $appSecret) {
	    $this->appId = $appId;
	    $this->appSecret = $appSecret;
  	}
	
	/*
	 *获取accesstoken
	 */
	public function getAccessToken() {
		//从缓存中获取accessToken
		$token = cache("accessToken");
		//如果为空则从服务器端重新获取
		if (!$token) {
			$token = $this -> getTokenByUrl();
			cache("accessToken", $token,0);
		} else {
			//如果已经过期了则重新去服务器端重新获取
			if (!$this -> checkToken($token)) {
				$token = $this -> getTokenByUrl();
				cache("accessToken", $token,0);
			}
		}
		$accessToken = json_decode($token, true);
		return $accessToken["access_token"];
	}

	/*
	 *通过URL获取token操作方法
	 */
	private function getTokenByUrl() {
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $this->appId . '&secret=' . $this->appSecret;
		$accessToken = curl::callWebServer($url, '', 'GET');
		$accessToken['time'] = time();
		$accessTokenJson = json_encode($accessToken);
		return $accessTokenJson;
	}
	
	/*
	 *检测token是否有效
	 *$token 是json格式
	 */
	private function checkToken($token) {
		$accessToken = json_decode($token, true);
		if (time() - $accessToken['time'] < $accessToken['expires_in'] - 100)
			return true;
		else
			return false;
	}

}
?>
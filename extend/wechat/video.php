<?php
/**
 * @function：回复用户视频信息处理类
 * 
 */
namespace wechat;
use wechat\core\response;

/**
 * 在这里处理来自用户的视频信息
 */
class video{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$mediaId='',$thumbMediaId=''){
		$tool = new response();
		return $tool->text($from,$to,"视频接口\n媒体id:[".$mediaId."]\n 时间:[".$time."]\n 消息id:[".$msgId."]\n缩略图id:[".$thumbMediaId."]\n");
		
	}
}
?>
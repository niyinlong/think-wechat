<?php
/**
 * @function：回复用户小视频信息处理类
 * 
 */
namespace wechat;
use wechat\core\response;
/**
 *在这里回复小视频
 */
class shortvideo{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$mediaId='',$thumbMediaId=''){
		$tool = new response();
		return $tool->text($from,$to,"短视频接口\n媒体id:[".$mediaId."]\n 时间:[".$time."]\n 消息id:[".$msgId."]\n缩略图id:[".$thumbMediaId."]\n");
		
	}
}
?>
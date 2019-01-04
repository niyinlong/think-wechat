<?php
/**
 * @function：用户图片响应接口
 * 
 */
namespace wechat;
use wechat\core\response;

/**
 *在这里进行对于图片的回复
 */
class image{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$mediaId='',$picUrl=''){
		$tool = new response();
		return $tool->text($from,$to,"图片接口\n多媒体id:[".$mediaId."]\n 时间:[".$time."]\n 消息id:[".$msgId."]\n 链接:[".$picUrl."]");
	}
}
?>
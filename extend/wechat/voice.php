<?php
/*
 * @function：回复用户声音信息处理类
 * 
 */
namespace wechat;
use wechat\core\response;

/**
 *在这里是回复声音的信息
 */
class voice{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$format,$mediaId,$recognition=''){
		$tool = new response();
		return $tool->text($from,$to,"语音接口\n文本:[".$recognition."]\n 时间:[".$time."]\n 消息id:[".$msgId."]\n格式:[".$format."]\n媒体id:[".$mediaId."]");
	}
}
?>
<?php
/**
 * @function：回复用户文本信息处理类
 * 
 */
namespace wechat;
use wechat\core\response;
/**
 *在这里对于文本信息进行回复
 */
class test{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$title='',$description='',$url=''){
		$tool = new response();
		//返回文本信息
		return $tool->text($from,$to,"测试接口\n 时间:[".$time."]\n 消息id:[".$msgId."]");
	}
}
?>
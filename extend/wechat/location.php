<?php
/**
 * @function：用户地理位置上报响应接口
 * 
 */
namespace wechat;
use wechat\core\response;

class location{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$x=0.0,$y=0.0,$scale=0,$label=''){
		$tool = new response();
		return $tool->text($from,$to,"地理位置\n 纬度:[".$x."]\n经度:[".$y."]\n 时间:[".$time."]\n 消息id:[".$msgId."]\n缩放:[".$scale."]\n信息:[".$label."]\n");
	}
}
?>
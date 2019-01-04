<?php
/**
 * @function：用户事件响应接口
 * 
 */
namespace wechat;
use wechat\core\response;

/**
 * 在这里进行触发事件的回复
 */
class event{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$type,$key,$ticket='',$lat='',$lng='',$precision=''){
		$tool = new response();
		if($type=="CLICK"){
			return $tool->text($from,$to,"<a href='http://wechat.niyinlong.com/index.php/wechat/index/signin?openId=".$from."'>点击扫码签到</a>");
		}
		return $tool->text($from,$to,"刚触发了事件".$type."--".$key.$ticket.$lat.$lng.$precision);//返回文本信息
	}
}
?>
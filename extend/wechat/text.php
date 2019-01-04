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
class text{
	//得到对应的返回数据
	public function getResponse($from,$to,$time,$msgId,$str=''){
		$tool = new response();
		// 如果是手机号则保存openId
		if (preg_match("/^1[35678]\d{9}$/", $str)){
			 db("student")->where('student_phone',$str)->update(['student_opent_id'=>$from]);
			$name =  db("student")->where('student_phone',$str)->value("student_name");
			if($name!=""){
				return $tool->text($from,$to,$name."同学欢迎您使用非凡学院公众号，手机号绑定成功");
			}else{
				return $tool->text($from,$to,$name."该手机号不存在，绑定失败！");
			}
			
		}
		//返回文本信息
		return $tool->text($from,$to,"文字接口\n文本:[".$str."]\n 时间:[".$time."]\n 消息id:[".$msgId."]");
	}
}
?>
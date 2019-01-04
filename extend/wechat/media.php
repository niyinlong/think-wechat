<?php
/**
 * @function：多媒体信息管理接口
 * 
 */
namespace wechat;
use wechat\core\response;
use wechat\core\accesstoken;
/*
*素材管理
*临时素材管理和永久素材管理
*/
class media{
	/*
	*上传临时的素材文件
	*/
	public function upload($uid,$filename, $type){
		$tool = new accesstoken();
		$token = $tool->getAccessToken($uid);
		$queryUrl = 'http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$token.'&type='.$type;
        $data = array();
        $data['media'] = '@'.$filename;
        return Curl::callWebServer($queryUrl, $data, 'POST', 1 , 0);
	}

	/*
	*下载临时的素材文件
	*/
	public function download($uid,$mediaid){
		$tool = new accesstoken();
		$token = $tool->getAccessToken($uid);
		$queryUrl = 'http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$mediaid;
        return Curl::callWebServer($queryUrl, '', 'GET', 0);
	}

}
?>
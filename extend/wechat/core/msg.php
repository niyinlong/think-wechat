<?php

/**
 * @function：数据类型封装类
 * 
 */
namespace wechat\core;

class msg{
	
	// 通用信息
	public $msgType = '';//数据类型
	public $fromUserName = '';//open_id
	public $toUserName = '';//微信公众账号
	public $createTime = 0;//消息创建时间
	public $msgId = '';//信息id
	
	// 事件
	public $eventType = '';//事件类型
	public $eventKey = '';//事件内容
	public $ticket = '';//二维码的ticket，可用来换取二维码图片

	//定时上报的地理位置
	public $lat = 0.0;
	public $lng = 0.0;
	public $precision = ''; //地理位置精度
	
	//用户通过输入框发送的地理位置
	public $latX = 0.0;
	public $lngY = 0.0;
	public $scale = '';//地图缩放大小
	public $label = '';//地图位置信息
	
	// 文本内容上传
	public $keyWord = '';//数据内容
	
	// 多媒体文件上传
	public $picUrl = '';//
	public $mediaId = '';
	public $format = '';//语音类型
	public $thumbMediaId = '';//视频的缩略图
	public $recognition = '';//语音识别结果
	
	// 链接信息
	public $title = '';
	public $description = '';
	public $url = '';
	
	//构造函数
	function __construct(){
			// 获取通用信息
			$this->fromUserName = 'fromUserName';
            $this->toUserName = 'toUserName';
            $this->msgType = 'link';
            $this->createTime = time();
            $this->msgId = 'msgId12345';
            
            if($this->msgType=="text"){
            		$this->keyWord = 'keyWord'; 
            }
            
            if($this->msgType=="image"){
            		$this->picUrl = 'picUrl';
            		$this->mediaId = 'mediaId';
            }
            if($this->msgType=="voice"){
            		$this->format = 'format';
            		$this->mediaId = 'mediaId';
            		$this->recognition = 'recognition';
            }
            
            if($this->msgType=="video" || $this->msgType=="shortvideo"){
            		$this->thumbMediaId = 'video';
            		$this->mediaId = 'video';
            }
            
            if($this->msgType=="location"){
            		 $this->latX ='latX';
            		 $this->lngY ='lngY';
            		 $this->scale = 'scale';
            		 $this->label = 'label';
            }
            
            if($this->msgType=="link"){
            		 $this->title = 'title';
            		 $this->description = 'description';
            		 $this->url = 'url';
            }
            
             if($this->msgType=="event"){
            		$this->eventType = 'eventType';
            		$this->eventKey = 'eventKey';
            		switch($this->eventType){
            			case 'subscribe':$this->ticket = '';break;
            			case 'SCAN':$this->ticket ='';break;
            			case 'LOCATION':{
            				$this->lat = 3.1415926;
            				$this->lng = 3.1415926;
            				$this->precision = '1';
            			} break;
            		}
            }      
	}
}
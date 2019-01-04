<?php

/**
 * @function：数据类型封装类
 * 
 */
namespace wechat\core;

class message{
	
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
	public $scale = 0;//地图缩放大小
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
	function __construct($postObj){
			// 获取通用信息
			$this->fromUserName = trim($postObj->FromUserName);
            $this->toUserName = trim($postObj->ToUserName);
            $this->msgType = trim($postObj->MsgType);
            $this->createTime = $postObj->CreateTime;
            $this->msgId = $postObj->MsgId;
            
            if($this->msgType=="text"){
            		$this->keyWord = trim($postObj->Content); 
            }
            
            if($this->msgType=="image"){
            		$this->picUrl = trim($postObj->PicUrl);
            		$this->mediaId = trim($postObj->MediaId);
            }
            if($this->msgType=="voice"){
            		$this->format = trim($postObj->Format);
            		$this->mediaId = trim($postObj->MediaId);
            		$this->recognition = trim($postObj->Recognition);
            }
            
            if($this->msgType=="video" || $this->msgType=="shortvideo"){
            		$this->thumbMediaId = trim($postObj->ThumbMediaId);
            		$this->mediaId = trim($postObj->MediaId);
            }
            
            if($this->msgType=="location"){
            		 $this->latX =(float)$postObj->Location_X;
            		 $this->lngY =(float)$postObj->Location_Y;
            		 $this->scale = $postObj->Scale;
            		 $this->label = $postObj->Label;
            }
            
            if($this->msgType=="link"){
            		 $this->title = trim($postObj->Title);
            		 $this->description = trim($postObj->Description);
            		 $this->url = trim($postObj->Url);
            }
            
             if($this->msgType=="event"){
            		$this->eventType = $postObj->Event;
            		$this->eventKey = $postObj->EventKey;
            		switch($this->eventType){
            			case 'subscribe':$this->ticket = $postObj->Ticket;break;
            			case 'SCAN':$this->ticket = $postObj->Ticket;break;
            			case 'LOCATION':{
            				$this->lat = (float)$postObj->Latitude;
            				$this->lng = (float)$postObj->Longitude;
            				$this->precision = $postObj->Precision;
            			} break;
            		}
            }      
	}
}
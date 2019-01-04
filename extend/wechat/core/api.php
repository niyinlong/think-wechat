<?php

/**
 * @function：接口统一层。微信公众平台调用本接口，调试也调用本接口
 * 
 */

namespace wechat\core;
use wechat\core\message;
use wechat\response;
use wechat\text;
use wechat\location;
use wechat\event;
use wechat\image;
use wechat\voice;
use wechat\video;
use wechat\shortvideo;
use wechat\link;
use wechat\test;
/**
 * 微信公众账号的接口层，微信响应调用该接口，调试也调用此接口
 */
class api{
    private $msg = null;
    //构造函数
    function __construct($msg) {
        $this->msg = $msg;
    }
    //文本信息处理函数。
    public function textHandler(){      	
         $tool = new text();
         return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->keyWord);
    }
    //地理信息的处理函数。
    public function locationHandler(){       
        $tool = new location();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->latX,$this->msg->lngY,$this->msg->scale,$this->msg->label);
    }
    //事件处理函数。
    public function eventHandler(){        
        $tool = new event();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->eventType,$this->msg->eventKey,$this->msg->ticket,$this->msg->lat,$this->msg->lng,$this->msg->precision);
    }    
    //图片信息处理
    public function imageHandler(){       
        $tool = new image();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->mediaId,$this->msg->picUrl);
    }
    //声音信息处理
    public function voiceHandler(){      
        $tool = new voice();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->format,$this->msg->mediaId,$this->msg->recognition);
    }
    //视频信息处理
    public function videoHandler(){      
        $tool = new video();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->mediaId,$this->msg->thumbMediaId);
    }
    //短视频信息处理
    public function shortVideoHandler(){       
        $tool = new shortvideo();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->mediaId,$this->msg->thumbMediaId);
    }
   	//链接处理
    public function linkHandler(){       
        $tool = new link();
        return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId,$this->msg->title,$this->msg->description,$this->msg->url);
    }
    // 未知类型数据
    public function defaultHandler(){
    		 $tool = new test();
    		 return $tool->getResponse($this->msg->fromUserName,$this->msg->toUserName,$this->msg->createTime,$this->msg->msgId);
    }
}
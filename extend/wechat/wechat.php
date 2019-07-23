<?php
// 公众号接口定义
interface  wechat{
    public function text($from,$to,$time,$msgId,$str='');
    public function image($from,$to,$time,$msgId,$mediaId='',$picUrl='');
    public function event($from,$to,$time,$msgId,$type,$key,$ticket='',$lat='',$lng='',$precision='');
    public function link($from,$to,$time,$msgId,$title='',$description='',$url='');
    public function location($from,$to,$time,$msgId,$x=0.0,$y=0.0,$scale=0,$label='');
    public function upload($uid,$filename, $type);
    public function download($uid,$mediaid);
    public function shortvideo($from,$to,$time,$msgId,$mediaId='',$thumbMediaId='');
    public function video($from,$to,$time,$msgId,$mediaId='',$thumbMediaId='')
    public function voice($from,$to,$time,$msgId,$format,$mediaId,$recognition='');
}
?>
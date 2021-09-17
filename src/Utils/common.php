<?php
/**
 * Created by Fanguochao
 * User: fgc
 * Date: 2021-09-16
 * Time: 22:30
 * Desc: 公共函数
 */

if(!function_exists('today')){
    function today(){
        return date("Y-m-d H:i:s");
    }
}

function getResponse($createPsn){
    $Resp = $createPsn->execute();//execute方法发起请求
    $Json = json_decode($Resp->getBody());
    return $Json;
}
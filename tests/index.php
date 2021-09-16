<?php

include_once "../vendor/autoload.php";

use factory\Factory;
use factory\base\Account;

$filePath = "./test.pdf"; // 合同模板
if(!is_file($filePath)){
    echo '文件不存在';exit;
}

$config = [
    'host'=>'https://smlopenapi.esign.cn',
    'project_id'=>'7438874691',
    'project_scert'=>'70f26a078be0856b64115db0a5e27df3'
];

// 个人账号信息 ，用于创建个人账号接口传入
$thirdPartyUserIdPsn='142430199410303113';//thirdPartyUserId参数，用户唯一标识，自定义保持唯一即可
$namePsn='范国超';//name参数，姓名
$idTypePsn="CRED_PSN_CH_IDCARD";//idType参数，证件类型
$idNumberPsn='142430199410303113';//idNumber参数，证件号
$mobilePsn='15635419575';//mobile参数，手机号


Factory::init($config['host'], $config['project_id'], $config['project_scert']);

$accountId = createAccount($thirdPartyUserIdPsn, $namePsn, $idTypePsn, $idNumberPsn, $mobilePsn);
var_dump($accountId);die;

function createAccount($thirdPartyUserIdPsn, $namePsn, $idTypePsn, $idNumberPsn, $mobilePsn){
    $createPsn = Account::createPersonByThirdPartyUserId(
        $thirdPartyUserIdPsn,
        $namePsn,
        $idTypePsn,
        $idNumberPsn);
    $createPsn->setMobile($mobilePsn);
    $createPsnResp = $createPsn->execute();//execute方法发起请求
    $createPsnJson = json_decode($createPsnResp->getBody());
    $accountId = $createPsnJson->data->accountId;//生成的个人账号保存好，后续接口调用需要使用
    return $accountId;
}


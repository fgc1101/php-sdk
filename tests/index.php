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

//------------------------企业账号信息用于创建机构账号接口传入----------------
$thirdPartyUserIdOrg="91110108576895548B";//thirdPartyUserId参数，用户唯一标识，自定义保持唯一即可
$nameOrg="北京优思安科技有限公司";//name参数，机构名称
$idTypeOrg="CRED_ORG_USCC";//idType参数，证件类型
$idNumberOrg="";//idNumber参数,机构证件号


Factory::init($config['host'], $config['project_id'], $config['project_scert']);

// 先查询、没有的话应该再创建
$obj = getResponse(Account::QryPersonByThirdId($thirdPartyUserIdPsn));
if($obj->code == 0){
    //成功
    $accountId = $obj->data->accountId;
}else{
    // 失败的情况下就创建个人账号
    $personalAccountObj = getResponse(Account::createAccount($thirdPartyUserIdPsn, $namePsn, $idTypePsn, $idNumberPsn, $mobilePsn));
    $accountId = $personalAccountObj->data->accountId;
}


// 企业账号也是先创建，没有的话再创建
$orgObj = getResponse(Account::qryOrganizationsByThirdId($thirdPartyUserIdOrg));

if($orgObj->code == 0){
    $orgId = $obj->data->accountId;
}else{
    // 创建企业账号
    $orgAccount = getResponse(Account::createOrganizationsByThirdPartyUserId($thirdPartyUserIdOrg, $accountId, $nameOrg, $idTypeOrg, $idNumberOrg));
    $orgId = $orgAccount->data->accountId;
}







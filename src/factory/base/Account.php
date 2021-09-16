<?php
/**
 * Created by Fanguochao
 * User: fgc
 * Date: 2021-09-16
 * Time: 22:44
 * Desc:
 */

namespace factory\base;

use factory\account\CreatePersonByThirdPartyUserId;

class Account
{
    public static function createPersonByThirdPartyUserId($thirdPartyUserId, $name, $idType, $idNumber){
        return new createPersonByThirdPartyUserId($thirdPartyUserId,$name,$idType,$idNumber);
    }
}
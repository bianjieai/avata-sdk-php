<?php

namespace Bianjieai\AvataSdkPhp\Service;

use http\Client;
use PHPUnit\Framework\TestCase;

class MTTest extends TestCase
{
    public function testCreateMTClasses(): void
    {
        $client = new \Bianjieai\AvataSdkPhp\Client(array(
            "domain" => "http://192.168.150.41:18081",
            "api_key" => "000001",
            "api_secret" => "123456"
        ));

        $params = array(
            "name" => "123",
            "owner" => "1234",
            "operation_id" => "12345",
        );
        $result = $client->CreateMTClass(new \CreateMTClassReq($params));
        print $result;
    }

}

<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Service;

use Bianjieai\AvataSdkPhp\Exception\InvalidArgumentException;
use GuzzleHttp\Client;

class Base
{
    /**
     * @var Client http请求客户端
     */
    protected static $http_client;

    public function __construct()
    {
        if (is_null(self::$http_client)) {
            throw new InvalidArgumentException("initialize the client first");
        }
    }
}
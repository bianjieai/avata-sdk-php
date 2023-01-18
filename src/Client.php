<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp;

use Bianjieai\AvataSdkPhp\Service\Base;
use Bianjieai\AvataSdkPhp\Service\Accounts;
use Bianjieai\AvataSdkPhp\Exception\InvalidArgumentException;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class Client extends Base
{
    /**
     * @请求Avata服务超时时间
     */
    const HTTP_TIMEOUT = 10;

    /**
     * @var Accounts 链账户服务
     */
    public $accounts;

    /**
     * @var NFTS NFT服务
     */
    public $NFTS;

    /**
     * Client constructor
     */
    public function __construct(array $cfg = [])
    {
        if (empty($cfg)) {
            throw new InvalidArgumentException("please set the configuration items");
        }
        if (!isset($cfg["api_key"]) || $cfg["api_key"] == "") {
            throw new InvalidArgumentException("the api key for the project is required");
        }
        if (!isset($cfg["api_secret"]) || $cfg["api_secret"] == "") {
            throw new InvalidArgumentException("the api secret for the project is required");
        }
        if (!isset($cfg["domain"]) || $cfg["domain"] == "") {
            throw new InvalidArgumentException("the avata domain address needs to be configured");
        }
        if (!isset($cfg["http_timeout"]) || $cfg["http_timeout"] == "") {
            $cfg["http_timeout"] = self::HTTP_TIMEOUT;
        }
        parent::$http_client = new Utils($cfg);
        $this->accounts = new Accounts();
        parent::__construct();
    }
}
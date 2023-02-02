<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class TransferMTReq extends BaseRequest
{
    /**
     * 转移的数量（默认为 1 ）
     * @var int
     */
    public $amount;

    /**
     * MT 接收者地址，支持任一 Avata 内合法链账户地址
     * @var string
     */
    public $recipient;

    /**
     * TransferMTReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string
     */
    public function getRecipientKey(): string
    {
        return "recipient";
    }

    /**
     * @return string
     */
    public function getAmountKey(): string
    {
        return "amount";
    }
}
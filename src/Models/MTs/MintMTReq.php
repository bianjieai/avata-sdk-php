<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class MintMTReq extends BaseRequest
{
    /**
     * MT 数量，不填写数量时，默认发行数量为 1
     * @var int
     */
    public $amount;

    /**
     * MT 接收者地址，支持任一文昌链合法链账户地址，默认为 MT 类别的权属者地址
     * @var string
     */
    public $recipient;

    /**
     * MintMTReq constructor.
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
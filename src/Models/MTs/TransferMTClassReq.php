<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class TransferMTClassReq extends BaseRequest
{
    /**
     * MT 类别接收者地址，支持任一 Avata 内合法链账户地址
     * @var string
     */
    public $recipient;

    /**
     * TransferMTClassReq constructor.
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
}
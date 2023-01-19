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
     * MT 类别接收者地址，支持任一 Avata 内合法链账户地址
     * @var string
     */
    public $recipient;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public $tag;

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

    /**
     * @return string
     */
    public function getTagKey(): string
    {
        return "tag";
    }
}
<?php

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class TransferMTClassReq extends BaseRequest
{
    /**
     * MT 类别接收者地址，支持任一 Avata 内合法链账户地址
     * @var string
     */
    public string $recipient;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public array $tag;

    /**
     * TransferMTClassReq constructor.
     * @param string $recipient
     * @param array $tag
     * @param string $operation_id
     */
    public function __construct(string $recipient, string $operation_id, array $tag)
    {
        $this->recipient = $recipient;
        $this->tag = $tag;
        $this->operation_id = $operation_id;
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
    public function getTagKey(): string
    {
        return "tag";
    }

}
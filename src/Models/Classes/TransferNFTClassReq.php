<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class TransferNFTClassReq extends BaseRequest
{
    /**
     * @var string NFT 类别 ID required
     */
    public $class_id = "";

    /**
     * @var string NFT 类别权属者地址 required
     */
    public $owner = "";

    /**
     * @var string NFT 类别接收者地址，支持任一 Avata 平台内合法链账户地址 required
     */
    public $recipient = "";

    /**
     * @var array 交易标签
     *
     * 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位
     * 自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     */
    public $tag = [];

    /**
     * TransferNFTClassReq constructor.
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
    public function getTagKey(): string
    {
        return "tag";
    }
}
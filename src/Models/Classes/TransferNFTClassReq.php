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
}
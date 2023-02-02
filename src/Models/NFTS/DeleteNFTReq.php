<?php
/**
 *
 * User: yu
 * Date: 2023/1/19
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class DeleteNFTReq extends BaseRequest
{
    /**
     * @var string NFT 类别 ID required
     */
    public $class_id = "";

    /**
     * @var string NFT 持有者地址，也是 Tx 签名者地址 required
     */
    public $owner = "";

    /**
     * @var string NFT ID required
     */
    public $nft_id = "";

    /**
     * DeleteNFTReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return array 转数组
     */
    public function toArray() :array
    {
        return array_filter((array)$this);
    }
}
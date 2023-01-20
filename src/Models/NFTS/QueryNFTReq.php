<?php
/**
 *
 * User: yu
 * Date: 2023/1/20
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryNFTReq extends BaseRequest
{
    /**
     * @var string NFT 类别 ID required
     */
    public $class_id = "";

    /**
     * @var string NFT ID required
     */
    public $nft_id = "";

    /**
     * QueryNFTReq constructor.
     * @param string $class_id
     * @param string $nft_id
     */
    public function __construct(string $class_id, string $nft_id)
    {
        $this->class_id = $class_id;
        $this->nft_id = $nft_id;
    }
}
<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryNFTClassReq extends BaseRequest
{
    /**
     * @var string NFT 类别 ID
     */
    public $id = "";

    /**
     * QueryNFTClassReq constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
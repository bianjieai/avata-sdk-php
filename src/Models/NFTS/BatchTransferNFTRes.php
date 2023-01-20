<?php
/**
 *
 * User: yu
 * Date: 2023/1/19
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


class BatchTransferNFTRes
{
    /**
     * 操作ID
     * @var string
     */
    public $operation_id = "";

    /**
     * CreateNFTClassesRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->operation_id = $data["operation_id"];
    }
}
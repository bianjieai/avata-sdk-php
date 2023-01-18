<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


class TransferNFTClassRes
{
    /**
     * 操作ID
     * @var string
     */
    public $operation_id = "";

    /**
     * TransferNFTClassRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->operation_id = $data["operation_id"];
    }
}
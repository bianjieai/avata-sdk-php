<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Record;


class CreateRecordRes
{
    /**
     * @var string 操作ID
     */
    public $operation_id = "";

    /**
     * CreateRecordRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->operation_id = $data["operation_id"];
    }
}
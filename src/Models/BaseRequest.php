<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models;

class BaseRequest
{
    /**
     * @var string 游标，默认为 0
     */
    public $offset = "0";

    /**
     * @var string 每页记录数，默认为 10，上限为 50
     */
    public $limit = "10";

    /**
     * @var string 操作ID
     */
    public $operation_id;

    /**
     * @return string
     */
    public function getOperationIDKey(): string
    {
        return "operation_id";
    }
}
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
     * @var string 操作ID
     */
    public $operation_id;


    /**
     * @return string
     */
    public function getOperationIDKey() :string
    {
        return "operation_id";
    }
}
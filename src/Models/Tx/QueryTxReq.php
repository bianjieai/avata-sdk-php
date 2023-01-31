<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Tx;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryTxReq extends BaseRequest
{

    /**
     * QueryTxReq constructor.
     * @param string $operation_id
     */
    public function __construct(string $operation_id)
    {
        $this->operation_id = $operation_id;
    }
}
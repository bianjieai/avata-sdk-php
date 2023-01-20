<?php
/**
 *
 * User: yu
 * Date: 2023/1/11
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;


class BatchCreateAccountsRes
{
    const _ACCOUNTS = "accounts";
    const _OPERATION_ID = "operation_id";

    /**
     * @var array 链账户地址列表
     */
    public $accounts = [];

    /**
     * 操作ID
     * @var string
     */
    public $operation_id = "";

    /**
     * BatchCreateAccountsRes constructor.
     * @param array $account
     * @param string $operation_id
     */
    public function __construct(array $data)
    {
        $this->accounts = $data[self::_ACCOUNTS];
        $this->operation_id = $data[self::_OPERATION_ID];
    }
}
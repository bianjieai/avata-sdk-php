<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;

class CreateAccountsRes
{
    /**
     * @var string 链账户地址
     */
    public $account = "";

    /**
     * 链账户名称
     * @var string
     */
    public $name = "";

    /**
     * 操作ID
     * @var string
     */
    public $operation_id = "";

    /**
     * CreateAccountsRes constructor.
     * @param array $errors
     */
    public function __construct(array $data = [])
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}
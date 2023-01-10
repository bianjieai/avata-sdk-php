<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Response;

class AccountResponse
{
    /**
     * @var string 链账户地址
     */
    private $account;

    /**
     * 链账户名称
     * @var string
     */
    private $name;

    /**
     * 操作ID
     * @var string
     */
    private $operation_id;

    /**
     * AccountResponse constructor.
     * @param array $errors
     */
    public function __construct(array $data = [])
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }

    /**
     * @return string 获取链账户
     */
    public function getAccount() :string
    {
        return $this->account;
    }

    /**
     * @return string 获取链账户名称
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @return string 获取操作ID
     */
    public function getOperationID() :string
    {
        return $this->operation_id;
    }
}
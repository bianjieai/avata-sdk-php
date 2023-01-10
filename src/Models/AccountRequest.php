<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models;


class AccountRequest
{
    /**
     * @var string 创建链账户
     */
    private $name;

    /**
     * @var string 操作ID
     */
    private $operationID;

    /**
     * AccountRequest constructor.
     * @param string $name
     * @param string $operationID
     */
    public function __construct(string $name, string $operationID)
    {
        $this->name = $name;
        $this->operationID = $operationID;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOperationID() :string
    {
        return $this->operationID;
    }

    /**
     * @return string
     */
    public function getNameKey() :string
    {
        return "name";
    }

    /**
     * @return string
     */
    public function getOperationIDKey() :string
    {
        return "operation_id";
    }
}
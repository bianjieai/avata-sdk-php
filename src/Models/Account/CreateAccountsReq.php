<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Account;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateAccountsReq extends BaseRequest
{
    /**
     * @var string 创建链账户
     */
    public $name;

    /**
     * CreateAccountsReq constructor.
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
    public function getNameKey() :string
    {
        return "name";
    }


}


<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */
namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Models\AccountRequest;
use Bianjieai\AvataSdkPhp\Response\AccountResponse;
use Bianjieai\AvataSdkPhp\Exception\InvalidArgumentException;
use Bianjieai\AvataSdkPhp\Response\ExceptionResponse;
use Bianjieai\AvataSdkPhp\Response\Response;
use Bianjieai\AvataSdkPhp\Utils\Utils;
use GuzzleHttp\Exception\ClientException;


final class Account extends BaseService
{
    /**
     * 创建链账户
     * @param string $name 链账户名称
     * @param string $operationID 操作ID
     * @return AccountResponse
     */
    public function CreateAccount(AccountRequest $params) :Response
    {
        $this->validate($params);
        try {
            $account = Utils::httpPost("/v1beta1/account", [
                $params->getNameKey()           => $params->getName(),
                $params->getOperationIDKey()    => $params->getOperationID(),
            ]);
        } catch (ClientException $e) {
            return Utils::exceptionHandle($e);
        }
        $data = Utils::formatBody($account);
        $response = new Response($account->getStatusCode(), "", $data["data"], new ExceptionResponse());
        return $response;
    }

    /**
     * 验证必填参数
     *
     * @param string $name
     * @param string $operationID
     * @return bool
     */
    protected function validate(AccountRequest $params) :bool
    {
        if ($params->getName() == "") {
            throw new InvalidArgumentException("name is required");
        }
        if ($params->getOperationID() == "") {
            throw new InvalidArgumentException("operation_id is required");
        }
        return true;
    }
}
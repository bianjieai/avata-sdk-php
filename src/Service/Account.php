<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */
namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Exception\InvalidArgumentException;
use Bianjieai\AvataSdkPhp\Models\Account\BatchCreateAccountsReq;
use Bianjieai\AvataSdkPhp\Models\Account\CreateAccountsReq;
use Bianjieai\AvataSdkPhp\Models\Account\QueryAccountReq;
use Bianjieai\AvataSdkPhp\Models\ExceptionRes;
use Bianjieai\AvataSdkPhp\Models\BaseResponse;
use Bianjieai\AvataSdkPhp\Models\HttpRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;
use GuzzleHttp\Exception\ClientException;


final class Account extends Base
{
    /**
     * 创建链账户
     *
     * @param string $name 链账户名称
     * @param string $operationID 操作ID
     * @return BaseResponse
     */
    public function CreateAccount(CreateAccountsReq $request) : BaseResponse
    {
        if ($request->name == "") {
            return new BaseResponse(BaseResponse::$code_error, "name is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $account = Utils::httpPost("/account", [
                $request->getNameKey()           => $request->name,
                $request->getOperationIDKey()    => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }

        $data = Utils::formatBody($account);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes([]), new HttpRes($account->getStatusCode(), ""));
        return $response;
    }

    /**
     * 批量创建链账户
     *
     * @param BatchCreateAccountsReq $request
     * @return BaseResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function BatchCreateAccount(BatchCreateAccountsReq $request) :BaseResponse
    {
        if ($request->count == 0) {
            $request->count = 1;
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $account = Utils::httpPost("/accounts", [
                $request->getCountKey()         => $request->count,
                $request->getOperationIDKey()   => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }

        $data = Utils::formatBody($account);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes([]), new HttpRes($account->getStatusCode(), ""));
        return $response;
    }

    public function QueryAccount(QueryAccountReq $request) :BaseResponse
    {

    }
}
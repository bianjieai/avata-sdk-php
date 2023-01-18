<?php

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Models\BaseResponse;
use Bianjieai\AvataSdkPhp\Models\ExceptionRes;
use Bianjieai\AvataSdkPhp\Models\HttpRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;
use CreateMTClassReq;
use TransferMTClassReq;

final class MT extends Base
{
    /**
     * 创建 MT 类别
     *
     * MT 类别是 IRITA 底层链对同一资产类型的识别和集合，方便资产发行方对链上资产进行管理和查询。
     * 所以链上资产在发行前，都需要创建 MT 类别，用以声明其抽象属性。
     *
     * @param CreateMTClassReq $request
     * @return BaseResponse
     */
    public function CreateMTClass(CreateMTClassReq $request): BaseResponse
    {
        if ($request->name == "") {
            return new BaseResponse(BaseResponse::$code_error, "name is required");
        }
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $account = Utils::httpPost("/mt/classes", [
                $request->getNameKey() => $request->name,
                $request->getOwnerKey() => $request->owner,
                $request->getDataKey() => $request->data,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }

        $data = Utils::formatBody($account);
        return new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes([]), new HttpRes($account->getStatusCode(), ""));
    }

    /**
     * 转让 MT 类别
     *
     * MT 类别是 IRITA 底层链对同一资产类型的识别和集合，方便资产发行方对链上资产进行管理和查询。
     * 所以链上资产在发行前，都需要创建 MT 类别，用以声明其抽象属性。
     *
     * @param string $classID
     * @param string $owner
     * @param TransferMTClassReq $request
     * @return BaseResponse
     */
    public function TransferMTClass(string $classID, string $owner, TransferMTClassReq $request): BaseResponse
    {
        if ($request->recipient == "") {
            return new BaseResponse(BaseResponse::$code_error, "recipient is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $account = Utils::httpPost(printf("/mt/class-transfers/%s/%s", $classID, $owner), [
                $request->getRecipientKey() => $request->recipient,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }

        $data = Utils::formatBody($account);
        return new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes([]), new HttpRes($account->getStatusCode(), ""));
    }


}
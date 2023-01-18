<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Models\BaseResponse;
use Bianjieai\AvataSdkPhp\Models\Classes\CreateNFTClassesReq;
use Bianjieai\AvataSdkPhp\Models\Classes\QueryNFTCLassesReq;
use Bianjieai\AvataSdkPhp\Models\Classes\QueryNFTClassReq;
use Bianjieai\AvataSdkPhp\Models\Classes\TransferNFTClassReq;
use Bianjieai\AvataSdkPhp\Models\ExceptionRes;
use Bianjieai\AvataSdkPhp\Models\HttpRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class NFT_Classes extends Base
{
    /**
     * 创建 NFT 类别
     *
     * NFT 类别是 IRITA 底层链对同一资产类型的识别和集合，方便资产发行方对链上资产进行管理和查询。
     * 所以在发行 NFT 前，都需要创建 NFT 类别，用以声明其抽象属性
     *
     * @param CreateNFTClassesReq $request
     * @return BaseResponse
     */
    public function CreateNFTClasses(CreateNFTClassesReq $request) :BaseResponse
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
            $classes = Utils::HttpPost("/nft/classes", $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($classes);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($classes->getStatusCode(), ""));
        return $response;
    }

    /**
     * 查询 NFT 类别
     *
     * 根据查询条件，展示 Avata 平台内的 NFT 类别列表
     *
     * @param QueryNFTCLassesReq $request
     * @return BaseResponse
     */
    public function QueryNFTClasses(QueryNFTCLassesReq $request) :BaseResponse
    {
        try {
            $classes = Utils::HttpGet("/nft/classes", $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($classes);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($classes->getStatusCode(), ""));
        return $response;
    }

    /**
     * 查询 NFT 类别详情
     *
     * 根据查询条件，展示 Avata 平台内的 NFT 类别的详情信息
     *
     * @param QueryNFTClassReq $request
     * @return BaseResponse
     */
    public function QueryNFTClass(QueryNFTClassReq $request) :BaseResponse
    {
        if ($request->id == "") {
            return new BaseResponse(BaseResponse::$code_error, "id is required");
        }
        try {
            $classes = Utils::HttpGet(sprintf("/nft/classes/%s", $request->id), []);
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($classes);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($classes->getStatusCode(), ""));
        return $response;
    }

    /**
     * 转让 NFT 类别
     *
     * NFT 类别权属者（NFT Class Owner），拥有在该 NFT 类别中发行 NFT 的权限和转让该 NFT 类别的权限
     * 注意：「Avata」API 服务平台「允许」应用平台方将 NFT 类别转让给「任一 Avata 平台内合法链账户地址」
     *
     * @param TransferNFTClassReq $request
     * @return BaseResponse
     */
    public function TransferNFTClass(TransferNFTClassReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->recipient == "") {
            return new BaseResponse(BaseResponse::$code_error, "recipient is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }
        try {
            $body = [
                $request->getRecipientKey()    => $request->recipient,
                $request->getOperationIDKey()  => $request->operation_id,
            ];
            if (count($request->tag) > 1) {
                $body[$request->getTagKey()] = $request->tag;
            }
            $classes = Utils::HttpPost(sprintf("/nft/class-transfers/%s/%s", $request->class_id, $request->owner), $body);
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($classes);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($classes->getStatusCode(), ""));
        return $response;
    }
}
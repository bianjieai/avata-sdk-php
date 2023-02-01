<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Exception\Exception;
use Bianjieai\AvataSdkPhp\Models\Record\CreateRecordReq;
use Bianjieai\AvataSdkPhp\Models\Record\CreateRecordRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class Record extends Base
{
    /**
     * 数字作品存证接口
     *
     * 如果您是 BSN 文昌链-天和 / BSN 文昌链-天舟原生平台托管模式项目，可以使用该项目参数，通过该接口对某一类信息或文件在区块链上做存证，并且获得文昌链下发的存证证书
     * 请求成功之后，可以通过上链交易结果查询接口查询存证上链结果和获取证书下载链接。证书下载链接并非长期有效，请您尽快将证书文件下载至本地并妥善
     *
     * @param CreateRecordReq $request
     * @return CreateRecordRes
     * @throws Exception
     */
    public function CreateRecord(CreateRecordReq $request): CreateRecordRes
    {
        if ($request->type == 0) {
            throw new Exception("type is required");
        }
        if ($request->name == "") {
            throw new Exception("name is required");
        }
        if ($request->description == "") {
            throw new Exception("description is required");
        }
        if ($request->hash == "") {
            throw new Exception("hash is required");
        }
        if ($request->hash_type == 0) {
            throw new Exception("hash_type is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }
        try {
            $record = Utils::HttpPost("/record/records", $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($record);
        return new CreateRecordRes($data["data"]);
    }
}
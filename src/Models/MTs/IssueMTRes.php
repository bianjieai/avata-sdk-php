<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class IssueMTRes
{
    /**
     * 操作ID
     * @var string
     */
    public $operation_id = "";

    /**
     * IssueMTRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->operation_id = $data["operation_id"];
    }
}
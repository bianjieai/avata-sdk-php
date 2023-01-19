<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class EditMTRes
{
    /**
     * 操作ID
     * @var string
     */
    public $operation_id = "";

    /**
     * EditMTRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->operation_id = $data["operation_id"];
    }
}
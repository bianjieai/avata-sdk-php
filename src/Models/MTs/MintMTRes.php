<?php

class MintMTRes
{
    /**
     * 操作ID
     * @var string
     */
    public string $operation_id = "";

    /**
     * MintMTRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
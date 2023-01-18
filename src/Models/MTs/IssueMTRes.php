<?php

class IssueMTRes
{
    /**
     * 操作ID
     * @var string
     */
    public string $operation_id = "";

    /**
     * IssueMTRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
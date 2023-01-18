<?php

class EditMTRes
{
    /**
     * 操作ID
     * @var string
     */
    public string $operation_id = "";

    /**
     * EditMTRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
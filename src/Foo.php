<?php

namespace App;

class Foo implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return [];
    }
}

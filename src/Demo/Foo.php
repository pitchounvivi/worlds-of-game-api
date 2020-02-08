<?php

namespace Wog\Demo;


class Foo
{
    private
        /**
         * @var bool
         */
        $myAttr,

        /**
         * @var string
         */
        $myAttr2,

        /**
         * @var int
         */
        $myAttr3;


    public function __construct()
    {
        $this->myAttr = true;
        $this->myAttr2 = "Hello";
    }
}
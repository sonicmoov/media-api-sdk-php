<?php

namespace MediaDivision\SDK;

interface BaseClientInterface
{
    /**
     * @param  array $config
     * @return Client
     */
    public static function factory($config = array());

    /**
     * @throws \Exception
     */
    public function initialize();
}
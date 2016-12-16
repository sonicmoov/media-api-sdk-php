<?php

namespace MediaDivision\SDK;

require_once __DIR__ . "/BaseClient.php";

class Client extends BaseClient
{
    /**
     * @return array
     */
    public function execute()
    {
        return $this
            ->addHeader("X-Mdf-Authorization", $this->getToken())
            ->send();
    }
}
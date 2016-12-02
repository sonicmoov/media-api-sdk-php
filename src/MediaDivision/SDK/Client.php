<?php

namespace MediaDivision\SDK;

require_once __DIR__ . "/BaseClient.php";

class Client extends BaseClient
{
    /**
     * @return array
     */
    public function send()
    {
        return $this
            ->addHeader("Authorization", $this->getToken())
            ->send();
    }
}
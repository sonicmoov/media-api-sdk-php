<?php

namespace MediaDivision\SDK;

require_once __DIR__ . "/BaseClient.php";
require_once __DIR__ . "/ClientInterface.php";

class Client extends BaseClient implements ClientInterface
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
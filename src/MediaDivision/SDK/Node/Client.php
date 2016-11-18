<?php

namespace MediaDivision\SDK\Node;

require_once __DIR__ . "/../BaseClient.php";

use  MediaDivision\SDK\BaseClient;

class Client extends BaseClient
{
    /**
     * @var string
     */
    const BASE_PATH = "/api/client/node";


    public function get()
    {

    }

    /**
     * @param  int    $client_id
     * @param  string $account
     * @param  string $password
     * @return array
     */
    public function create($client_id, $account, $password)
    {
        return $this
            ->setMethod("POST")
            ->setPath(self::BASE_PATH)
            ->addQuery("client_id", $client_id)
            ->addQuery("account", $account)
            ->addQuery("password", $password)
            ->send();
    }

    /**
     * @param $node_id
     * @param array $update
     * @return array
     */
    public function update($node_id, $update = array())
    {
        $query = array_merge(array("id" => $node_id), $update);
        return $this
            ->setMethod("PUT")
            ->setPath(self::BASE_PATH)
            ->setQuery($query)
            ->send();
    }

    /**
     * @param  int $node_id
     * @return array
     */
    public function delete($node_id)
    {
        return $this
            ->setMethod("PUT")
            ->setPath(self::BASE_PATH."/".$node_id)
            ->send();
    }
}
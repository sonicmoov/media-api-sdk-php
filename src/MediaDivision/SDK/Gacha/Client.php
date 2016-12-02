<?php

namespace MediaDivision\SDK\Gacha;

require_once __DIR__ . "/../BaseClient.php";

use  MediaDivision\SDK\BaseClient;

class Client extends BaseClient
{
    /**
     * @var string
     */
    const BASE_PATH = "/api/gacha";

    /**
     * @param  mixed $user_id
     * @param  int   $gacha_id
     * @return array
     */
    public function one($user_id, $gacha_id)
    {
        return $this
            ->setPath(implode("/", array($user_id, $gacha_id)))
            ->send();
    }

    /**
     * @param  mixed  $user_id
     * @param  string $platform
     * @param  int    $display_type
     * @return array
     */
    public function all($user_id, $platform = "", $display_type = 0)
    {

        $this->setPath((string) $user_id);

        if ($platform) {
            $this->addParameter("platform", $platform);
        }

        if ($display_type) {
            $this->addParameter("display_type", $display_type);
        }

        return $this->send();
    }

    /**
     * @param  mixed $user_id
     * @param  int   $gacha_id
     * @param  int   $item_id
     * @param  int   $item_type_id
     * @return array
     */
    public function lottery($user_id, $gacha_id, $item_id = 0, $item_type_id = 0)
    {
        $this
            ->setMethod("POST")
            ->setPath("/lottery")
            ->addQuery("user_id",  $user_id)
            ->addQuery("gacha_id", $gacha_id);

        if ($item_id && $item_type_id) {
            $this
                ->addQuery("item_id",      $item_id)
                ->addQuery("item_type_id", $item_type_id);
        }

        return $this->send();
    }

    /**
     * @param  string $execute_id
     * @return array
     */
    public function execute($execute_id)
    {
        return $this
            ->setMethod("PUT")
            ->setPath(implode("/", array("execute", $execute_id)))
            ->send();
    }

    public function result()
    {

    }

    public function log()
    {

    }

    /**
     * @param  array $data
     * @return array
     */
    public function create($data = array())
    {
        return $this
            ->addHeader("Authorization", $this->getToken())
            ->setMethod("POST")
            ->setPath("/gacha/create")
            ->setQuery($data)
            ->send();
    }

    public function update()
    {

    }

    public function delete()
    {

    }

}
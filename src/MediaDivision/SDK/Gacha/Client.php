<?php

namespace MediaDivision\SDK;

require_once __DIR__ . "../BaseClient.php";

class Client extends BaseClient
{

    /**
     * @var Client
     */
    protected static $singleton = null;

    /**
     * Client constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        parent::__construct($config);

        if (isset($config["client_id"])) {
            $this->setClientId($config["client_id"]);
        }

        if (isset($config["account"])) {
            $this->setClientId($config["account"]);
        }

        if (isset($config["password"])) {
            $this->setClientId($config["password"]);
        }

        // init
        $this->initialize();
    }

    /**
     * @param  array $config
     * @return Client
     */
    public static function factory($config = array())
    {
        if (self::$singleton === null) {
            self::$singleton = new static($config);
        }
        return self::$singleton;
    }

    public function get()
    {

    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
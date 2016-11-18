<?php

namespace MediaDivision\SDK;

use \SimpleApi\Client;
use \Exception;

class BaseClient extends Client
{

    /**
     * @var string
     */
    const TOKEN_PATH = "/api/token/refresh";

    /**
     * @var null|string
     */
    protected $token = null;

    /**
     * @var int
     */
    protected $client_id = 0;

    /**
     * @var string
     */
    protected $account = "";

    /**
     * @var string
     */
    protected $password = "";

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

    /**
     * @return null|string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param null $token
     */
    public function setToken($token = null)
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param int $client_id
     */
    public function setClientId($client_id = 0)
    {
        $this->client_id = (int) $client_id;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $account
     */
    public function setAccount($account = "")
    {
        $this->account = (string) $account;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password = "")
    {
        $this->password = (string) $password;
    }

    /**
     * @throws Exception
     */
    public function initialize()
    {
        // valid
        if (!$this->getClientId() ||
            !$this->getAccount()  ||
            !$this->getPassword() ||
            !$this->getEndPoint()
        ) {
            throw new Exception(
                "initialize error set config 'end_point' and 'client_id' and 'account' and 'password'."
            );
        }

        $response = $this
            ->setPath(self::TOKEN_PATH)
            ->setMethod("PUT")
            ->add("client_id", $this->getClientId())
            ->add("account", $this->getAccount())
            ->add("password", $this->getPassword())
            ->send();

        // set token
        if (isset($response["response"]) && isset($response["response"]["access_token"])) {
            $this->setToken($response["response"]["access_token"]);
        }
    }


}
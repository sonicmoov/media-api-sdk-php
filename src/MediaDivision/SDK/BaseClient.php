<?php

namespace MediaDivision\SDK;

use \SimpleApi\Client;
use \Exception;

class BaseClient extends Client
{

    /**
     * @var string
     */
    const TOKEN_PATH = "/api/token";

    /**
     * @var string
     */
    const TOKEN_METHOD = "PUT";

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

        if (isset($config["account"])) {
            $this->setAccount($config["account"]);
        }

        if (isset($config["password"])) {
            $this->setPassword($config["password"]);
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
        if (!$this->getAccount()  ||
            !$this->getPassword() ||
            !$this->getEndPoint()
        ) {
            throw new Exception(
                "initialize error set config 'end_point' and 'account' and 'password'."
            );
        }

        $response = $this
            ->setPath(self::TOKEN_PATH)
            ->setMethod(self::TOKEN_METHOD)
            ->addQuery("account",  $this->getAccount())
            ->addQuery("password", $this->getPassword())
            ->send();

        // set token
        if (isset($response["response"]) && isset($response["response"]["access_token"])) {
            $this->setToken((string) $response["response"]["access_token"]);
        }
    }
}
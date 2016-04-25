<?php
namespace Ftob\LeaderBoardBundle\Repositories\Contracts;

use GuzzleHttp\Psr7\Uri;

class HttpConnection
{
    /** @var  string */
    protected $url;
    /** @var  bool */
    protected $ssl;
    /** @var  null|int */
    protected $port;

    public function __construct(Uri $url, $ssl = true, $port = null)
    {
        $this->url = $url;
        $this->ssl = $ssl;
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return boolean
     */
    public function isSsl()
    {
        return $this->ssl;
    }

    /**
     * @return int|null
     */
    public function getPort()
    {
        return $this->port;
    }


}
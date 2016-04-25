<?php
namespace Ftob\LeaderBoardBundle\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use Psr\Http\Message\ResponseInterface;

/**
 * The Server class is used to control a scripted webserver  that
 * will respond to HTTP requests with queued responses.
 *
 * Mock responses that don't require data to be transmitted over HTTP a great
 * for testing.  Mock response, however, cannot test the actual sending of an
 * HTTP request using cURL.  This test server allows the simulation of any
 * number of HTTP request response transactions to test the actual sending of
 * requests over the wire without having to leave an internal network.
 */
class Server
{
    /** @var Client */
    private static $client;

    private static $started = false;

    public static $url = 'http://127.0.0.1:8000/';

    public static $port = 8000;



    public static function stop()
    {
        if (self::$started) {
            self::getClient()->request('GET', 'stop');
        }
        self::$started = false;
    }

    public static function wait($maxTries = 5)
    {
        $tries = 0;
        while (!self::isListening() && ++$tries < $maxTries) {
            usleep(100000);
        }
        if (!self::isListening()) {
            throw new \RuntimeException('Unable to contact node.js server');
        }
    }

    public static function start()
    {
        if (self::$started) {
            return;
        }
        if (!self::isListening()) {
            exec('php -S 0.0.0.0:8000 ' . __DIR__ . '/Serverd.php >> /tmp/server.log 2>&1 &');
            self::wait();
        }
        self::$started = true;
    }

    private static function isListening()
    {
        try {
            self::getClient()->request('GET', 'test', [
                'connect_timeout' => 5,
                'timeout'         => 5
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    private static function getClient()
    {
        if (!self::$client) {
            self::$client = new Client([
                'base_uri' => self::$url,
                'sync'     => true,
            ]);
        }
        return self::$client;
    }
}
<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    // '*';
    //protected $headers = Request:: HEADER_X_FORWARDED_AWS_ELB;
    protected $proxies = '*';
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
     //[
         //'192.168.1.1',
        // '192.168.1.2',
        //  '154.160.23.126',
        //  '54.173.229.200',
        //  '54.175.230.252',
     //];

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    //  protected $headers = [
    //      Request::HEADER_FORWARDED => 'FORWARDED',
    //      Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
    //      Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
    //      Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
    //      Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
    //  ];
}

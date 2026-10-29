<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;

    /**
     * Proxies confiáveis definidos por TRUSTED_PROXIES (IPs separados por vírgula ou "*").
     * Necessário atrás do proxy HTTPS da STI para gerar URLs com https.
     *
     * @return array<int, string>|string|null
     */
    protected function proxies()
    {
        $proxies = env('TRUSTED_PROXIES');

        if (empty($proxies)) {
            return $this->proxies;
        }

        return $proxies === '*' ? '*' : array_map('trim', explode(',', $proxies));
    }
}

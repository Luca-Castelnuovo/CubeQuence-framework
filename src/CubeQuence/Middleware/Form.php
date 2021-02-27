<?php

declare(strict_types=1);

namespace CQ\Middleware;

use Closure;
use CQ\Helpers\Request;
use CQ\Response\Json;

class Form extends Middleware
{
    /**
     * Interpret FormData
     *
     * @return Closure|Json
     */
    public function handleChild(Closure $next): Closure | Json
    {
        if (!Request::isForm(request: $this->request)) {
            return $this->respond->prettyJson(
                message: 'Invalid Content-Type',
                data: [
                    'details' => "Content-Type should be 'application/x-www-form-urlencoded'",
                ],
                code: 415
            );
        }

        $data = (object) $this->request->getParsedBody();

        $this->request->data = $data;

        return $next($this->request);
    }
}

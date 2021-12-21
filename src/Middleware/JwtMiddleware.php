<?php

namespace Electra\Jwt\Middleware;

use Electra\Core\Context\ContextAware;
use Electra\Core\Event\EventInterface;
use Electra\Jwt\Context\ElectraJwtContextInterface;
use Electra\Jwt\Utility\Jwts;
use Electra\Web\Context\WebContextInterface;
use Electra\Web\Middleware\MiddlewareInterface;

/**
 * Class JwtMiddleware
 *
 * @package Electra\Jwt\Middleware
 * @method ElectraJwtContextInterface | WebContextInterface getContext()
 */
class JwtMiddleware implements MiddlewareInterface
{
  use ContextAware;

  /**
   * @param callable|EventInterface $event
   *
   * @return bool
   * @throws \Exception
   */
  public function run($event): bool
  {
    $ctx = $this->getContext();
    $request = $ctx->request();

    $jwt = null;

    // If auth header is set
    if($authHeaderValue = $request->header('Authorization'))
    {
      [$schema, $jwt] = explode(' ', $authHeaderValue);
    }
    // Else if the jwt cookie is set
    else if($request->hasCookie('jwt'))
    {
      $jwt = $request->cookie('jwt');
    }

    if($jwt)
    {
      // Parse token
      $jwtToken = Jwts::parseJwt($jwt, $ctx->getJwtSecret());

      if($jwtToken && $jwtToken->verified)
      {
        $ctx->setJwt($jwtToken);
      }
    }

    return true;
  }
}

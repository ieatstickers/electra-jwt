<?php

namespace Electra\Jwt\Middleware;

use Electra\Core\Context\ContextAware;
use Electra\Core\Event\EventInterface;
use Electra\Core\Exception\ElectraException;
use Electra\Core\Exception\ElectraUnauthorizedException;
use Electra\Jwt\Context\ElectraJwtContext;
use Electra\Jwt\Context\ElectraJwtContextInterface;
use Electra\Jwt\Event\ElectraJwtEvents;
use Electra\Jwt\Event\ParseJwt\ParseJwtPayload;
use Electra\Web\Endpoint\EndpointInterface;
use Electra\Web\Middleware\MiddlewareInterface;

/**
 * Class JwtMiddleware
 *
 * @package Electra\Jwt\Middleware
 * @method ElectraJwtContextInterface getContext()
 */
class JwtMiddleware implements MiddlewareInterface
{
  use ContextAware;

  /**
   * @param EventInterface $event
   *
   * @return bool
   * @throws ElectraException
   */
  public function run(EventInterface $event): bool
  {
    $ctx = $this->getContext();
    $request = $ctx->request();

    // If auth header is set
    if ($authHeaderValue = $request->header('Authorization'))
    {
      [$schema, $jwt] = explode(' ', $authHeaderValue);

      // Parse token
      $parseJwtPayload = ParseJwtPayload::create();
      $parseJwtPayload->jwt = $jwt;
      $parseJwtPayload->secret = $ctx->getJwtSecret();
      $parseJwtResponse = ElectraJwtEvents::parseJwt($parseJwtPayload);

      if ($parseJwtResponse->token && $parseJwtResponse->token->verified)
      {
        $ctx->setJwt($parseJwtResponse->token);
      }
    }

    // If endpoint is authenticated & no token is set
    if (
      $event instanceof EndpointInterface
      && $event->requiresAuth()
      && !$ctx->getJwt()
    )
    {
      throw (new ElectraUnauthorizedException('Unauthorized'))
        ->addMetaData('endpoint', get_class($event))
        ->addMetaData('token', $ctx->getJwt());
    }

    return true;
  }
}

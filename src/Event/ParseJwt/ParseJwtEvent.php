<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Context\ContextInterface;
use Electra\Core\Event\AbstractEvent;
use Electra\Jwt\Api\JwtApi;
use Electra\Jwt\Context\ElectraJwtContext;
use Electra\Jwt\Context\ElectraJwtContextInterface;

/**
 * Class ParseJwtEvent
 *
 * @method ElectraJwtContextInterface getContext()
 */
class ParseJwtEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return ParseJwtPayload::class;
  }

  /**
   * @param ParseJwtPayload $payload
   * @return ParseJwtResponse
   * @throws \Exception
   */
  protected function process($payload): ParseJwtResponse
  {
    $token = JwtApi::parseJwt($payload->jwt);

    $response = ParseJwtResponse::create();

    if ($token)
    {
      $token->verified = JwtApi::verifySignature($token, $payload->secret ?: $this->getContext()->getJwtSecret());
      $response->token = $token;
    }

    return $response;
  }
}

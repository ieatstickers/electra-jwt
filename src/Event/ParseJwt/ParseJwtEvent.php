<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractEvent;
use Electra\Jwt\Api\JwtApi;
use Electra\Jwt\ElectraJwt;

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
   */
  protected function process($payload): ParseJwtResponse
  {
    $token = JwtApi::parseJwt($payload->jwt);

    $response = ParseJwtResponse::create();
    $token->verified = JwtApi::verifySignature($token, $payload->secret ?: ElectraJwt::getSecret());
    $response->token = $token;

    return $response;
  }
}
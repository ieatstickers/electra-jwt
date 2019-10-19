<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractEvent;
use Electra\Jwt\Api\JwtApi;

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
    $response->header = $token->header;
    $response->payload = $token->payload;
    $response->signature = $token->signature;
    $response->verified = JwtApi::verifySignature($token, $payload->secret);

    return $response;
  }
}
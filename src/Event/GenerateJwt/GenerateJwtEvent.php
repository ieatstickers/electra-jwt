<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractEvent;
use Electra\Error\Exception;
use Electra\Jwt\Api\JwtApi;
use Electra\Utility\Arrays;

class GenerateJwtEvent extends AbstractEvent
{
  /** @return string */
  public function getPayloadClass(): string
  {
    return GenerateJwtPayload::class;
  }

  /**
   * @param GenerateJwtPayload $payload
   * @return GenerateJwtResponse
   * @throws Exception
   */
  protected function process($payload): GenerateJwtResponse
  {
    $header = $payload->jwtHeader;
    $alg = Arrays::getByKey('alg', $header);
    $typ = Arrays::getByKey('typ', $header);

    if ($alg !== 'HS256')
    {
      throw new Exception("Cannot generate JWT. Unrecognised header value 'alg': $alg");
    }

    if ($typ !== 'jwt')
    {
      throw new Exception("Cannot generate JWT. Unrecognised header value 'typ': $typ");
    }

    $response = GenerateJwtResponse::create();
    $response->jwt = JwtApi::generateJwt(
      $payload->jwtHeader,
      $payload->jwtPayload,
      $payload->secret
    );

    return $response;
  }
}
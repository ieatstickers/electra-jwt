<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractEvent;
use Electra\Core\Exception\ElectraException;
use Electra\Jwt\Api\JwtApi;
use Electra\Jwt\Context\ElectraJwtContextInterface;
use Electra\Utility\Arrays;

/**
 * Class GenerateJwtEvent
 *
 * @method ElectraJwtContextInterface getContext()
 */
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
   * @throws ElectraException
   * @throws \Exception
   */
  protected function process($payload): GenerateJwtResponse
  {
    $header = $payload->jwtHeader;
    $alg = Arrays::getByKey('alg', $header);
    $typ = Arrays::getByKey('typ', $header);

    if ($alg !== 'HS256')
    {
      throw (new ElectraException("Cannot generate JWT. Unrecognised header value 'alg': $alg"))
        ->addMetaData('alg', $alg);
    }

    if ($typ !== 'jwt')
    {
      throw (new ElectraException("Cannot generate JWT. Unrecognised header value 'typ': $typ"))
        ->addMetaData('typ', $typ);
    }

    $response = GenerateJwtResponse::create();
    $response->jwt = JwtApi::generateJwt(
      $payload->jwtHeader,
      $payload->jwtPayload,
      $payload->secret ?: $this->getContext()->getJwtSecret()
    );

    return $response;
  }
}

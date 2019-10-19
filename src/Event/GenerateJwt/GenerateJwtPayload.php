<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractPayload;

class GenerateJwtPayload extends AbstractPayload
{
  /** @var array */
  public $jwtHeader = [ 'alg' => 'HS256', 'typ' => 'jwt' ];
  /** @var array */
  public $jwtPayload = [];
  /** @var string */
  public $secret;

  /** @return GenerateJwtPayload */
  public static function create(): GenerateJwtPayload
  {
    return new self();
  }

  /** @return array */
  protected function getRequiredProperties(): array
  {
    return ['jwtHeader', 'jwtPayload', 'secret'];
  }

  /** @return array */
  protected function getPropertyTypes(): array
  {
    return [ 'jwtHeader' => 'array', 'jwtPayload' => 'array', 'secret' => 'string' ];
  }

}
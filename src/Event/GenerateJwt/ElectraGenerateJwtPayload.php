<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractPayload;

class ElectraGenerateJwtPayload extends AbstractPayload
{
  /** @var array */
  public $jwtHeader = [ 'alg' => 'HS256', 'typ' => 'jwt' ];
  /** @var array */
  public $jwtPayload = [];
  /** @var string */
  public $secret;

  /** @return ElectraGenerateJwtPayload */
  public static function create(): ElectraGenerateJwtPayload
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
<?php

namespace Electra\Jwt\Event\GenerateJwt;

use Electra\Core\Event\AbstractPayload;
use Electra\Core\Event\Type\Type;

/**
 * Class GenerateJwtPayload
 * @package Electra\Jwt\Event\GenerateJwt
 * @method $this static create($data = [])
 */
class GenerateJwtPayload extends AbstractPayload
{
  /** @var array */
  public $jwtHeader = [ 'alg' => 'HS256', 'typ' => 'jwt' ];
  /** @var array */
  public $jwtPayload = [];
  /** @var string */
  public $secret;

  /** @return array */
  protected function getRequiredProperties(): array
  {
    return ['jwtHeader', 'jwtPayload'];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [ 'jwtHeader' => Type::array(), 'jwtPayload' => Type::array(), 'secret' => Type::string() ];
  }

}

<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractPayload;

class ElectraParseJwtPayload extends AbstractPayload
{
  /** @var string */
  public $jwt;
  /** @var string */
  public $secret;

  /** @return array */
  public function getRequiredProperties(): array
  {
    return [
      'jwt',
      'secret'
    ];
  }

  /** @return array */
  public function getPropertyTypes(): array
  {
    return [
      'jwt' => 'string',
      'secret' => 'string'
    ];
  }

  /** @return ElectraParseJwtPayload */
  public static function create(): ElectraParseJwtPayload
  {
    return new self();
  }
}
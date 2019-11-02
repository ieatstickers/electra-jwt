<?php

namespace Electra\Jwt\Event\ParseJwt;

use Electra\Core\Event\AbstractPayload;

class ParseJwtPayload extends AbstractPayload
{
  /** @var string */
  public $jwt;
  /** @var string */
  public $secret;

  /** @return array */
  public function getRequiredProperties(): array
  {
    return [
      'jwt'
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

  /** @return ParseJwtPayload */
  public static function create(): ParseJwtPayload
  {
    return new self();
  }
}
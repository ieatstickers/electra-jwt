<?php

namespace Electra\Jwt\Event;

use Electra\Jwt\Event\GenerateJwt\GenerateJwtEvent;
use Electra\Jwt\Event\GenerateJwt\GenerateJwtPayload;
use Electra\Jwt\Event\GenerateJwt\GenerateJwtResponse;
use Electra\Jwt\Event\ParseJwt\ParseJwtPayload;
use Electra\Jwt\Event\ParseJwt\ParseJwtResponse;
use Electra\Jwt\Event\ParseJwt\ParseJwtEvent;

class ElectraJwtEvents
{
  /**
   * @param GenerateJwtPayload $payload
   * @return GenerateJwtResponse
   * @throws \Exception
   */
  public static function generateJwt(GenerateJwtPayload $payload): GenerateJwtResponse
  {
    return (new GenerateJwtEvent())->execute($payload);
  }

  /**
   * @param ParseJwtPayload $payload
   * @return ParseJwtResponse
   * @throws \Exception
   */
  public static function parseJwt(ParseJwtPayload $payload): ParseJwtResponse
  {
    return (new ParseJwtEvent())->execute($payload);
  }
}
<?php

namespace Electra\Jwt\Event;

use Electra\Jwt\Event\GenerateJwt\ElectraGenerateJwtEvent;
use Electra\Jwt\Event\GenerateJwt\ElectraGenerateJwtPayload;
use Electra\Jwt\Event\GenerateJwt\ElectraGenerateJwtResponse;
use Electra\Jwt\Event\ParseJwt\ElectraParseJwtPayload;
use Electra\Jwt\Event\ParseJwt\ParseJwtResponse;
use Electra\Jwt\Event\ParseJwt\ParseJwtEvent;

class ElectraJwtEvents
{
  /**
   * @param ElectraGenerateJwtPayload $payload
   * @return ElectraGenerateJwtResponse
   * @throws \Exception
   */
  public static function generateJwt(ElectraGenerateJwtPayload $payload): ElectraGenerateJwtResponse
  {
    return (new ElectraGenerateJwtEvent())->execute($payload);
  }

  /**
   * @param ElectraParseJwtPayload $payload
   * @return ParseJwtResponse
   * @throws \Exception
   */
  public static function parseJwt(ElectraParseJwtPayload $payload): ParseJwtResponse
  {
    return (new ParseJwtEvent())->execute($payload);
  }
}
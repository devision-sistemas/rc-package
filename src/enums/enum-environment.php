<?php

namespace Reaction\Base\Enums;

enum EnumEnvironment: String
{
  case LOCAL = 'local';
  case STAGING = 'staging';
  case PRODUCTION = 'production';
}

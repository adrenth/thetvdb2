<?php

declare(strict_types=1);

namespace Adrenth\Thetvdb\Exception;

use RuntimeException;

final class TokenNotFoundInResponseException extends RuntimeException implements TheTvdbException
{
}

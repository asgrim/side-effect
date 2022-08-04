<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\Dispatchable;
use Asgrim\SideEffect\Framework;
use PDO;

final class CreateDatabase implements Dispatchable
{
    public function __construct(private string $dsn, private ?string $username, private ?string $password)
    {}

    public function __toString() : string
    {
        Framework::$dumpingGround[PDO::class] = new PDO(
            $this->dsn,
            $this->username,
            $this->password,
            [
                // Why would you ever want to change these? You don't, so shut up.
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
            ]
        );

        return '';
    }
}

<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\Framework;

final class PerformDatabaseQuery implements \Asgrim\SideEffect\Dispatchable
{
    /**
     * @param list<array{key:string|int, value:mixed}> $parameters
     */
    public function __construct(private string $query, private array $parameters)
    {
    }

    public function __toString() : string
    {
        $pdo = Framework::$dumpingGround[\PDO::class];
        assert($pdo instanceof \PDO);

        $statement = $pdo->prepare($this->query);

        foreach ($this->parameters as $parameter) {
            $parameterValueReference = $parameter['value'];

            // This is a feature: https://gist.github.com/asgrim/22859d7af570c33ee52f34564c24afb2
            $statement->bindParam($parameter['index'], $parameterValueReference);
        }

        $statement->execute();

        return json_encode($statement->fetchAll(), JSON_THROW_ON_ERROR);
    }
}

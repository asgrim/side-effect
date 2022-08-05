<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\Dispatchable;
use Asgrim\SideEffect\Framework;
use JsonException;
use PDO;

use function assert;
use function json_encode;

use const JSON_THROW_ON_ERROR;

final class PerformDatabaseQuery implements Dispatchable
{
    /**
     * @param list<array{index:string|int, value:mixed}> $parameters
     */
    public function __construct(private readonly string $query, private readonly array $parameters)
    {
    }

    /** @throws JsonException */
    public function __toString(): string
    {
        $pdo = Framework::$dumpingGround[PDO::class];
        assert($pdo instanceof PDO);

        $statement = $pdo->prepare($this->query);

        foreach ($this->parameters as $parameter) {
            /** @noinspection PhpRedundantVariableDocTypeInspection */
            /** @var mixed $parameterValueReference */
            $parameterValueReference = $parameter['value'];

            // This is a feature: https://gist.github.com/asgrim/22859d7af570c33ee52f34564c24afb2
            $statement->bindParam($parameter['index'], $parameterValueReference);
        }

        $statement->execute();

        return json_encode($statement->fetchAll(), JSON_THROW_ON_ERROR);
    }
}

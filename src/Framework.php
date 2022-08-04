<?php

declare(strict_types=1);

namespace Asgrim\SideEffect;

use Asgrim\SideEffect\Features\InjectsRequestDecorator;
use Psr\Http\Message\ServerRequestInterface;
use Stringable;

final class Framework implements Stringable
{
    /** @var array<string,mixed> */
    public static array $dumpingGround;
    /** @var list<Dispatchable> */
    private array $dispatchables;

    /**
     * @param ServerRequestInterface $request
     * @param list<Dispatchable|callable(ServerRequestInterface):Dispatchable> $dispatchables
     */
    public function __construct(
        ServerRequestInterface $request,
        array $dispatchables
    ) {
        self::$dumpingGround[ServerRequestInterface::class] = $request;

        $this->dispatchables = array_map(
            static function (Dispatchable $dispatchable): Dispatchable {
                return self::someSecretMagicToMakeThingsTasty($dispatchable);
            },
            $dispatchables
        );
    }

    public static function someSecretMagicToMakeThingsTasty(Dispatchable $dispatchable): Dispatchable
    {
        if ($dispatchable instanceof CanHaveRequestInjected) {
            $dispatchable = new InjectsRequestDecorator($dispatchable);
        }

        return $dispatchable;
    }

    public function __toString() : string
    {
        return array_reduce(
            $this->dispatchables,
            function (string $carry, Dispatchable $dispatchable): string {
                return $carry . $dispatchable;
            },
            ''
        );
    }
}

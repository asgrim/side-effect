<?php /** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Asgrim\SideEffect\Features\AbstractController;
use Asgrim\SideEffect\Framework;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/vendor/autoload.php';

echo (new Framework(
    ServerRequest::fromGlobals(),
    [
        new class extends AbstractController {
            public function __toString() : string
            {
                return sprintf('<h1>Hello %s</h1>', $this->request->getQueryParams()['who'] ?? 'world');
            }
        },
    ]
));

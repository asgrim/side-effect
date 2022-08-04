<?php /** @noinspection DevelopmentDependenciesUsageInspection */

declare(strict_types=1);

use Asgrim\SideEffect\Dispatchable;
use Asgrim\SideEffect\Features\AbstractController;
use Asgrim\SideEffect\Features\CreateDatabase;
use Asgrim\SideEffect\Features\InjectsRequestDecorator;
use Asgrim\SideEffect\Features\PerformDatabaseQuery;
use Asgrim\SideEffect\Features\ShutTheHellUpDecorator;
use Asgrim\SideEffect\Framework;
use Asgrim\SideEffect\SideEffect;
use GuzzleHttp\Psr7\ServerRequest;

require_once __DIR__ . '/vendor/autoload.php';

echo (new Framework(
    ServerRequest::fromGlobals(),
    [
        new CreateDatabase(
            'sqlite::memory:',
            null,
            null
        ),
        new InjectsRequestDecorator(new class extends AbstractController {
            public function __toString() : string
            {
                $name = ($this->request->getQueryParams()['who'] ?? 'world');

                return ''
                    . new SideEffect(new ShutTheHellUpDecorator(new PerformDatabaseQuery('CREATE TABLE IF NOT EXISTS names (name VARCHAR(30))', [])))
                    . new SideEffect(new ShutTheHellUpDecorator(new PerformDatabaseQuery('INSERT INTO names VALUES (:name)', [['index' => 'name', 'value' => $name]])))
                    . '<h1>Hello ' . $name . '</h1>'
                    . '<p>I said hello to you ' . json_decode((string) (new SideEffect(new PerformDatabaseQuery('SELECT COUNT(*) AS times FROM names WHERE name = :name', [['index' => 'name', 'value' => $name]]))), true)[0]['times'] . ' times</p>';
            }
        }),
    ]
));

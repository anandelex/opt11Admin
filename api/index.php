<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;


    require_once '../vendor/autoload.php';
    require_once '../src/config/preferences.php';
    require_once '../src/config/mysql.php';
    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];
    $c = new \Slim\Container($configuration);
    $app = new \Slim\App($c);
    // $app = new \Slim\App;

    require_once '../src/routes/codelist.php';
    require_once '../src/routes/battingStyle.php';
    require_once '../src/routes/bowlingStyle.php';
    require_once '../src/routes/playerRoles.php';
    require_once '../src/routes/teams.php';
    require_once '../src/routes/players.php';
    require_once '../src/routes/series.php';
    require_once '../src/routes/squads.php';
    $app->run();
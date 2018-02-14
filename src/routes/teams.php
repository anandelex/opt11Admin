<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/teams', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT temId, temName, temShortName, temDisplayName, temStatus FROM teammaster");
            $teams=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($teams);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/teams_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT temId, temName, temShortName, temDisplayName, temStatus FROM teammaster");
            $teams=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($teams).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/team/{temId}', function (Request $request, Response $response) {
        try {
            $temId=$request->getAttribute('temId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT temId, temName, temShortName, temDisplayName, temStatus FROM teammaster WHERE temId=$temId");
            $team=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($team);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/team/add', function (Request $request, Response $response) {
        try {
            $temName=$request->getParam('temName');
            $temShortName=$request->getParam('temShortName');
            $temDisplayName=$request->getParam('temDisplayName');
            $temStatus=$request->getParam('temStatus');
            $temAddedBy=1;
            $temUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO teammaster (temName,temShortName,temDisplayName,temStatus,temAddedBy,temDateAdded,temUpdatedBy,temDateUpdated) VALUES (:temName,:temShortName,:temDisplayName,:temStatus,:temAddedBy,NOW(),:temUpdatedBy,NOW())");
            $rows=$res->execute([":temName"=>$temName,":temShortName"=>$temShortName,":temDisplayName"=>$temDisplayName,":temStatus"=>$temStatus,":temAddedBy"=>$temAddedBy,":temUpdatedBy"=>$temUpdatedBy]);
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/team/update/{temId}', function (Request $request, Response $response) {
        try {
            $temId=$request->getAttribute('temId');
            $temName=$request->getParam('temName');
            $temShortName=$request->getParam('temShortName');
            $temDisplayName=$request->getParam('temDisplayName');
            $temStatus=$request->getParam('temStatus');
            $temUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE teammaster SET temName=:temName,temShortName=:temShortName,temDisplayName=:temDisplayName,temStatus=:temStatus ,temUpdatedBy=:temUpdatedBy,temDateUpdated=NOW() WHERE temId=:temId");
            $rows=$res->execute([":temName"=>$temName,":temShortName"=>$temShortName,":temDisplayName"=>$temDisplayName,":temStatus"=>$temStatus,":temUpdatedBy"=>$temUpdatedBy,":temId"=>$temId]);
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/team/delete/{temId}', function (Request $request, Response $response) {
        try {
            $temId=$request->getAttribute('temId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM teammaster WHERE temId=:temId");
            $rows=$res->execute([":temId"=>$temId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
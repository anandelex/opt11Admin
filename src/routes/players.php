<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/players', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT plrId, plrName, plrShortName, plrDisplayName, plrStatus FROM playermaster");
            $players=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($players);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/players_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT plrId, plrName, plrShortName, plrDisplayName, plrStatus FROM playermaster");
            $players=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($players).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/player/{plrId}', function (Request $request, Response $response) {
        try {
            $plrId=$request->getAttribute('plrId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT plrId, plrName, plrShortName, plrDisplayName, plrDOB, plrBatStyle, plrBowlStyle, plrMajorRole, plrStatus FROM playermaster WHERE plrId=$plrId");
            $player=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($player);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/player/add', function (Request $request, Response $response) {
        try {
            $plrName=$request->getParam('plrName');
            $plrShortName=$request->getParam('plrShortName');
            $plrDisplayName=$request->getParam('plrDisplayName');
            $plrDOB=$request->getParam('plrDOB');
            $plrBatStyle=$request->getParam('plrBatStyle');
            $plrBowlStyle=$request->getParam('plrBowlStyle');
            $plrMajorRole=$request->getParam('plrMajorRole');
            $plrStatus=$request->getParam('plrStatus');
            $plrAddedBy=1;
            $plrUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO playermaster (plrName,plrShortName,plrDisplayName,plrDOB,plrBatStyle,plrBowlStyle,plrMajorRole,plrStatus,plrAddedBy,plrDateAdded,plrUpdatedBy,plrDateUpdated) VALUES (:plrName,:plrShortName,:plrDisplayName,:plrDOB,:plrBatStyle,:plrBowlStyle,:plrMajorRole,:plrStatus,:plrAddedBy,NOW(),:plrUpdatedBy,NOW())");
            $rows=$res->execute([":plrName"=>$plrName,":plrShortName"=>$plrShortName,":plrDisplayName"=>$plrDisplayName,":plrDOB"=>$plrDOB,":plrBatStyle"=>$plrBatStyle,":plrBowlStyle"=>$plrBowlStyle,":plrMajorRole"=>$plrMajorRole,":plrStatus"=>$plrStatus,":plrAddedBy"=>$plrAddedBy,":plrUpdatedBy"=>$plrUpdatedBy]);
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/player/update/{plrId}', function (Request $request, Response $response) {
        try {
            $plrId=$request->getAttribute('plrId');
            $plrName=$request->getParam('plrName');
            $plrShortName=$request->getParam('plrShortName');
            $plrDisplayName=$request->getParam('plrDisplayName');
            $plrDOB=$request->getParam('plrDOB');
            $plrBatStyle=$request->getParam('plrBatStyle');
            $plrBowlStyle=$request->getParam('plrBowlStyle');
            $plrMajorRole=$request->getParam('plrMajorRole');
            $plrStatus=$request->getParam('plrStatus');
            $plrUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE playermaster SET plrName=:plrName,plrShortName=:plrShortName,plrDisplayName=:plrDisplayName,plrDOB=:plrDOB,plrBatStyle=:plrBatStyle,plrBowlStyle=:plrBowlStyle,plrMajorRole=:plrMajorRole,plrStatus=:plrStatus,plrUpdatedBy=:plrUpdatedBy,plrDateUpdated=NOW() WHERE plrId=:plrId");
            $rows=$res->execute([":plrName"=>$plrName,":plrShortName"=>$plrShortName,":plrDisplayName"=>$plrDisplayName,":plrDOB"=>$plrDOB,":plrBatStyle"=>$plrBatStyle,":plrBowlStyle"=>$plrBowlStyle,":plrMajorRole"=>$plrMajorRole,":plrStatus"=>$plrStatus,":plrUpdatedBy"=>$plrUpdatedBy,":plrId"=>$plrId]);
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/player/delete/{plrId}', function (Request $request, Response $response) {
        try {
            $plrId=$request->getAttribute('plrId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM playermaster WHERE plrId=:plrId");
            $rows=$res->execute([":plrId"=>$plrId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
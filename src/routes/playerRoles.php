<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/player_roles', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT prlId, prlRole, prlStatus FROM playerroles");
            $playerroles=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($playerroles);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/player_roles_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT prlId, prlRole, prlStatus FROM playerroles");
            $playerroles=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($playerroles).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/player_role/{prlId}', function (Request $request, Response $response) {
        try {
            $prlId=$request->getAttribute('prlId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT prlId, prlRole, prlStatus FROM playerroles WHERE prlId=$prlId");
            $playerrole=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($playerrole);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/player_role/add', function (Request $request, Response $response) {
        try {
            $prlRole=$request->getParam('prlRole');
            $prlStatus=$request->getParam('prlStatus');
            $prlAddedBy=1;
            $prlUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO playerroles (prlRole,prlStatus,prlAddedBy,prlDateAdded,prlUpdatedBy,prlDateUpdated) VALUES (:prlRole,:prlStatus,:prlAddedBy,NOW(),:prlUpdatedBy,NOW())");
            $rows=$res->execute([":prlRole"=>$prlRole,":prlStatus"=>$prlStatus,":prlAddedBy"=>$prlAddedBy,":prlUpdatedBy"=>$prlUpdatedBy]);
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/player_role/update/{prlId}', function (Request $request, Response $response) {
        try {
            $prlId=$request->getAttribute('prlId');
            $prlRole=$request->getParam('prlRole');
            $prlStatus=$request->getParam('prlStatus');
            $prlUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE playerroles SET prlRole=:prlRole,prlStatus=:prlStatus ,prlUpdatedBy=:prlUpdatedBy,prlDateUpdated=NOW() WHERE prlId=:prlId");
            $rows=$res->execute([":prlRole"=>$prlRole,":prlStatus"=>$prlStatus,":prlUpdatedBy"=>$prlUpdatedBy,":prlId"=>$prlId]);
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/player_role/delete/{prlId}', function (Request $request, Response $response) {
        try {
            $prlId=$request->getAttribute('prlId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM playerroles WHERE prlId=:prlId");
            $rows=$res->execute([":prlId"=>$prlId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
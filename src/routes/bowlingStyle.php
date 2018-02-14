<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/bowling_styles', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT bwsId, bwsStyle, bwsStatus FROM bowlingstyle");
            $bowlingstyles=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($bowlingstyles);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/bowling_styles_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT bwsId, bwsStyle, bwsStatus FROM bowlingstyle");
            $bowlingstyles=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($bowlingstyles).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/bowling_style/{bwsId}', function (Request $request, Response $response) {
        try {
            $bwsId=$request->getAttribute('bwsId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT bwsId, bwsStyle, bwsStatus FROM bowlingstyle WHERE bwsId=$bwsId");
            $bowlingstyle=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($bowlingstyle);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/bowling_style/add', function (Request $request, Response $response) {
        try {
            $bwsStyle=$request->getParam('bwsStyle');
            $bwsStatus=$request->getParam('bwsStatus');
            $bwsAddedBy=1;
            $bwsUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO bowlingstyle (bwsStyle,bwsStatus,bwsAddedBy,bwsDateAdded,bwsUpdatedBy,bwsDateUpdated) VALUES (:bwsStyle,:bwsStatus,:bwsAddedBy,NOW(),:bwsUpdatedBy,NOW())");
            $rows=$res->execute([":bwsStyle"=>$bwsStyle,":bwsStatus"=>$bwsStatus,":bwsAddedBy"=>$bwsAddedBy,":bwsUpdatedBy"=>$bwsUpdatedBy]);
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/bowling_style/update/{bwsId}', function (Request $request, Response $response) {
        try {
            $bwsId=$request->getAttribute('bwsId');
            $bwsStyle=$request->getParam('bwsStyle');
            $bwsStatus=$request->getParam('bwsStatus');
            $bwsUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE bowlingstyle SET bwsStyle=:bwsStyle,bwsStatus=:bwsStatus ,bwsUpdatedBy=:bwsUpdatedBy,bwsDateUpdated=NOW() WHERE bwsId=:bwsId");
            $rows=$res->execute([":bwsStyle"=>$bwsStyle,":bwsStatus"=>$bwsStatus,":bwsUpdatedBy"=>$bwsUpdatedBy,":bwsId"=>$bwsId]);
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/bowling_style/delete/{bwsId}', function (Request $request, Response $response) {
        try {
            $bwsId=$request->getAttribute('bwsId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM bowlingstyle WHERE bwsId=:bwsId");
            $rows=$res->execute([":bwsId"=>$bwsId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
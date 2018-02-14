<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/batting_styles', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT btsId, btsStyle, btsStatus FROM battingstyle");
            $battingstyles=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($battingstyles);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->any('/batting_styles_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT btsId, btsStyle, btsStatus FROM battingstyle");
            $battingstyles=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($battingstyles).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/batting_style/{btsId}', function (Request $request, Response $response) {
        try {
            $btsId=$request->getAttribute('btsId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT btsId, btsStyle, btsStatus FROM battingstyle WHERE btsId=$btsId");
            $battingstyle=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($battingstyle);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/batting_style/add', function (Request $request, Response $response) {
        try {
            $btsStyle=$request->getParam('btsStyle');
            $btsStatus=$request->getParam('btsStatus');
            $btsAddedBy=1;
            $btsUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO battingstyle (btsStyle,btsStatus,btsAddedBy,btsDateAdded,btsUpdatedBy,btsDateUpdated) VALUES (:btsStyle,:btsStatus,:btsAddedBy,NOW(),:btsUpdatedBy,NOW())");
            $rows=$res->execute([":btsStyle"=>$btsStyle,":btsStatus"=>$btsStatus,":btsAddedBy"=>$btsAddedBy,":btsUpdatedBy"=>$btsUpdatedBy]);
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/batting_style/update/{btsId}', function (Request $request, Response $response) {
        try {
            $btsId=$request->getAttribute('btsId');
            $btsStyle=$request->getParam('btsStyle');
            $btsStatus=$request->getParam('btsStatus');
            $btsUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE battingstyle SET btsStyle=:btsStyle,btsStatus=:btsStatus ,btsUpdatedBy=:btsUpdatedBy,btsDateUpdated=NOW() WHERE btsId=:btsId");
            $rows=$res->execute([":btsStyle"=>$btsStyle,":btsStatus"=>$btsStatus,":btsUpdatedBy"=>$btsUpdatedBy,":btsId"=>$btsId]);
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/batting_style/delete/{btsId}', function (Request $request, Response $response) {
        try {
            $btsId=$request->getAttribute('btsId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM battingstyle WHERE btsId=:btsId");
            $rows=$res->execute([":btsId"=>$btsId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
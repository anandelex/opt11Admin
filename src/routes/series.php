<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/series', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT ser.serId, ser.serName, ser.serShortName, ser.serDisplayName, ser.serStartDt, ser.serEndDt, ser.serVisibleStartDt, ser.serVisibleEndDt, ser.serStatus, GROUP_CONCAT(tem.temDisplayName) AS teams, GROUP_CONCAT(tem.temId) AS temIds FROM seriesmaster ser LEFT JOIN seriesteamxref stx ON ser.serId=stx.stxSerId LEFT JOIN teammaster tem ON tem.temId=stx.stxTemId GROUP BY ser.serId");
            $series=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($series);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/series_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT ser.serId, ser.serName, ser.serShortName, ser.serDisplayName, ser.serStartDt, ser.serEndDt, ser.serVisibleStartDt, ser.serVisibleEndDt, ser.serStatus, GROUP_CONCAT(tem.temDisplayName) AS teams, GROUP_CONCAT(tem.temId) AS temIds FROM seriesmaster ser LEFT JOIN seriesteamxref stx ON ser.serId=stx.stxSerId LEFT JOIN teammaster tem ON tem.temId=stx.stxTemId GROUP BY ser.serId");
            $series=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($series).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/series/{serId}', function (Request $request, Response $response) {
        try {
            $serId=$request->getAttribute('serId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT ser.serId, ser.serName, ser.serShortName, ser.serDisplayName, ser.serStartDt, ser.serEndDt, ser.serVisibleStartDt, ser.serVisibleEndDt, ser.serStatus, GROUP_CONCAT(tem.temDisplayName) AS teams, GROUP_CONCAT(tem.temId) AS temIds FROM seriesmaster ser LEFT JOIN seriesteamxref stx ON ser.serId=stx.stxSerId LEFT JOIN teammaster tem ON tem.temId=stx.stxTemId GROUP BY ser.serId Having ser.serId=".$serId);
            $series=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($series);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/series/add', function (Request $request, Response $response) {
        try {
            $serName=$request->getParam('serName');
            $serShortName=$request->getParam('serShortName');
            $serDisplayName=$request->getParam('serDisplayName');
            $serStartDt=$request->getParam('serStartDt');
            $serEndDt=$request->getParam('serEndDt');
            $serVisibleStartDt=$request->getParam('serVisibleStartDt');
            $serVisibleEndDt=$request->getParam('serVisibleEndDt');
            $serStatus=$request->getParam('serStatus');
            $stx=$request->getParam('stx');
            $serAddedBy=1;
            $serUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO seriesmaster (serName,serShortName,serDisplayName,serStartDt,serEndDt,serVisibleStartDt,serVisibleEndDt,serStatus,serAddedBy,serDateAdded,serUpdatedBy,serDateUpdated) VALUES (:serName,:serShortName,:serDisplayName,:serStartDt,:serEndDt,:serVisibleStartDt,:serVisibleEndDt,:serStatus,:serAddedBy,NOW(),:serUpdatedBy,NOW())");
            $rows=$res->execute([":serName"=>$serName,":serShortName"=>$serShortName,":serDisplayName"=>$serDisplayName,":serStartDt"=>$serStartDt,":serEndDt"=>$serEndDt,":serVisibleStartDt"=>$serVisibleStartDt,":serVisibleEndDt"=>$serVisibleEndDt,":serStatus"=>$serStatus,":serAddedBy"=>$serAddedBy,":serUpdatedBy"=>$serUpdatedBy]);
            $stxSerId=$mysqlCon->lastInsertId();
            for($i=0; $i<count($stx); $i++) {
                $res=$mysqlCon->prepare("INSERT INTO seriesteamxref (stxSerId,stxTemId,stxStatus,stxAddedBy,stxDateAdded,stxUpdatedBy,stxDateUpdated) VALUES (:stxSerId,:stxTemId,1,:stxAddedBy,NOW(),:stxUpdatedBy,NOW())");
                $rows=$res->execute([":stxSerId"=>$stxSerId,":stxTemId"=>$stx[$i],":stxAddedBy"=>$serAddedBy,":stxUpdatedBy"=>$serUpdatedBy]);
            }
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/series/update/{serId}', function (Request $request, Response $response) {
        try {
            $serId=$request->getAttribute('serId');
            $serName=$request->getParam('serName');
            $serShortName=$request->getParam('serShortName');
            $serDisplayName=$request->getParam('serDisplayName');
            $serStartDt=$request->getParam('serStartDt');
            $serEndDt=$request->getParam('serEndDt');
            $serVisibleStartDt=$request->getParam('serVisibleStartDt');
            $serVisibleEndDt=$request->getParam('serVisibleEndDt');
            $stx=$request->getParam('stx');
            $serStatus=$request->getParam('serStatus');
            $serUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE seriesmaster SET serName=:serName,serShortName=:serShortName,serDisplayName=:serDisplayName,serStartDt=:serStartDt,serEndDt=:serEndDt,serVisibleStartDt=:serVisibleStartDt,serVisibleEndDt=:serVisibleEndDt,serStatus=:serStatus,serUpdatedBy=:serUpdatedBy,serDateUpdated=NOW() WHERE serId=:serId");
            $rows=$res->execute([":serName"=>$serName,":serShortName"=>$serShortName,":serDisplayName"=>$serDisplayName,":serStartDt"=>$serStartDt,":serEndDt"=>$serEndDt,":serVisibleStartDt"=>$serVisibleStartDt,":serVisibleEndDt"=>$serVisibleEndDt,":serStatus"=>$serStatus,":serUpdatedBy"=>$serUpdatedBy,":serId"=>$serId]);

            $res=$mysqlCon->prepare("UPDATE seriesteamxref SET stxStatus=0 WHERE stxSerId=:serId AND stxTemId=:stxTemId");
            $rows=$res->execute([":serId"=>$serId,":stxTemId"=>$stx[$i]]);
            for($i=0; $i<count($stx); $i++) {
                $res=$mysqlCon->prepare("SELECT stxStatus FROM seriesteamxref WHERE stxSerId=:serId AND  stxTemId=:stxTemId");
                $res->execute([":serId"=>$serId,":stxTemId"=>$stx[$i]]);
                if($res->rowCount()==0) {
                    $res=$mysqlCon->prepare("INSERT INTO seriesteamxref (stxSerId,stxTemId,stxStatus,stxAddedBy,stxDateAdded,stxUpdatedBy,stxDateUpdated) VALUES (:serId,:stxTemId,1,:stxAddedBy,NOW(),:stxUpdatedBy,NOW())");
                    $rows=$res->execute([":serId"=>$serId,":stxTemId"=>$stx[$i],":stxAddedBy"=>$serUpdatedBy,":stxUpdatedBy"=>$serUpdatedBy]);
                }
                else {
                    $res=$mysqlCon->prepare("UPDATE seriesteamxref SET stxStatus=1 WHERE stxSerId=:serId AND stxTemId=:stxTemId");
                    $rows=$res->execute([":serId"=>$serId,":stxTemId"=>$stx[$i]]);
                }
            }
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/series/delete/{serId}', function (Request $request, Response $response) {
        try {
            $serId=$request->getAttribute('serId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM seriesmaster WHERE serId=:serId");
            $rows=$res->execute([":serId"=>$serId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
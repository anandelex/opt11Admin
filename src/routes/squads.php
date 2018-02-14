<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/squads', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT stx.stxId, ser.serDisplayName, tem.temDisplayName FROM seriesteamxref stx LEFT JOIN seriesmaster ser ON stx.stxSerId=ser.serId AND stx.stxStatus=1 AND ser.serStatus=1 LEFT JOIN teammaster tem ON stx.stxTemId=tem.temId AND tem.temStatus=1");
            $squads=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($squads);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/squads_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT stx.stxId, ser.serDisplayName, tem.temDisplayName FROM seriesteamxref stx LEFT JOIN seriesmaster ser ON stx.stxSerId=ser.serId AND stx.stxStatus=1 AND ser.serStatus=1 LEFT JOIN teammaster tem ON stx.stxTemId=tem.temId AND tem.temStatus=1");
            $squads=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($squads).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/squad/{stxId}', function (Request $request, Response $response) {
        try {
            $stxId=$request->getAttribute('stxId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT stx.stxId, ser.serDisplayName, tem.temDisplayName, GROUP_CONCAT(sqd.sqdPlrId) AS players FROM seriesteamxref stx LEFT JOIN seriesmaster ser ON stx.stxSerId=ser.serId AND stx.stxStatus=1 AND ser.serStatus=1 LEFT JOIN teammaster tem ON stx.stxTemId=tem.temId AND tem.temStatus=1 LEFT JOIN squadmaster sqd ON stx.stxId=sqd.sqdStxId AND sqd.sqdStatus=1 GROUP BY stx.stxId Having stx.stxId=".$stxId);
            $squad=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($squad);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/squad_players/{stxId}', function (Request $request, Response $response) {
        try {
            $stxId=$request->getAttribute('stxId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT sqdPlrId, sqdprlId, sqdPrice, sqdPoints FROM squadmaster WHERE sqdStatus=1 AND sqdStxId=".$stxId);
            $squad=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($squad);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/squad/add', function (Request $request, Response $response) {
        try {
            $temName=$request->getParam('temName');
            $temShortName=$request->getParam('temShortName');
            $temDisplayName=$request->getParam('temDisplayName');
            $temStatus=$request->getParam('temStatus');
            $temAddedBy=1;
            $user=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO squadmaster (temName,temShortName,temDisplayName,temStatus,temAddedBy,temDateAdded,temUpdatedBy,temDateUpdated) VALUES (:temName,:temShortName,:temDisplayName,:temStatus,:temAddedBy,NOW(),:temUpdatedBy,NOW())");
            $rows=$res->execute([":temName"=>$temName,":temShortName"=>$temShortName,":temDisplayName"=>$temDisplayName,":temStatus"=>$temStatus,":temAddedBy"=>$temAddedBy,":temUpdatedBy"=>$user]);
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/squad/update/{stxId}', function (Request $request, Response $response) {
        try {
            $stxId=$request->getAttribute('stxId');
            $sqdId=$request->getParam('sqdId');
            $delSqdFlag=$request->getParam('delSqdFlag');
            $sqdPlrId=$request->getParam('sqdPlrId');
            $sqdprlId=$request->getParam('sqdprlId');
            $sqdPrice=$request->getParam('sqdPrice');
            $sqdPoints=$request->getParam('sqdPoints');
            $user=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            
            for($i=0; $i<count($sqdId); $i++) {
                if($delSqdFlag[$i]==0) {
                    if($sqdId[$i]==0) {
                        $res=$mysqlCon->prepare("INSERT INTO squadmaster (sqdStxId,sqdPlrId,sqdprlId,sqdPrice,sqdPoints,sqdStatus,sqdAddedBy,sqdDateAdded,sqdUpdatedBy,sqdDateUpdated) VALUES (:sqdStxId,:sqdPlrId,:sqdprlId,:sqdPrice,:sqdPoints,1,:sqdAddedBy,NOW(),:sqdUpdatedBy,NOW())");
                        $rows=$res->execute([":sqdStxId"=>$stxId,":sqdPlrId"=>$sqdPlrId[$i],":sqdprlId"=>$sqdprlId[$i],":sqdPrice"=>$sqdPrice[$i],":sqdPoints"=>$sqdPoints[$i],":sqdAddedBy"=>$user,":sqdUpdatedBy"=>$user]);
                    }
                    else {
                        $res=$mysqlCon->prepare("UPDATE squadmaster SET sqdStxId=:sqdStxId,sqdPlrId=:sqdPlrId,sqdprlId=:sqdprlId,sqdPrice=:sqdPrice,sqdPoints=:sqdPoints,sqdUpdatedBy=:sqdUpdatedBy,sqdDateUpdated=NOW() WHERE sqdId=:sqdId");
                        $rows=$res->execute([":sqdStxId"=>$stxId,":sqdPlrId"=>$sqdPlrId[$i],":sqdprlId"=>$sqdprlId[$i],":sqdPrice"=>$sqdPrice[$i],":sqdPoints"=>$sqdPoints[$i],":sqdUpdatedBy"=>$user,":sqdId"=>$sqdId[$i]]);
                    }
                }
                else if($sqdId[$i]!=0) {
                    $res=$mysqlCon->prepare("UPDATE squadmaster SET sqdStxId=:sqdStxId,sqdPlrId=:sqdPlrId,sqdprlId=:sqdprlId,sqdPrice=:sqdPrice,sqdPoints=:sqdPoints,sqdStatus=0,sqdUpdatedBy=:sqdUpdatedBy,sqdDateUpdated=NOW() WHERE sqdId=:sqdId");
                    $rows=$res->execute([":sqdStxId"=>$stxId,":sqdPlrId"=>$sqdPlrId[$i],":sqdprlId"=>$sqdprlId[$i],":sqdPrice"=>$sqdPrice[$i],":sqdPoints"=>$sqdPoints[$i],":sqdUpdatedBy"=>$user,":sqdId"=>$sqdId[$i]]);
                }
            }
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/squad/delete/{temId}', function (Request $request, Response $response) {
        try {
            $temId=$request->getAttribute('temId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM squadmaster WHERE temId=:temId");
            $rows=$res->execute([":temId"=>$temId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
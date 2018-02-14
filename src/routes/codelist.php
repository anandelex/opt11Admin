<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app->get('/codelists', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT cdlId, cdlName, cdlStatus FROM codelistmaster");
            $codelist=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($codelist);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/codelists_dt', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT cdlId, cdlName, cdlStatus FROM codelistmaster");
            $codelist=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return '{ "data": '.json_encode($codelist).'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/codelist/{cdlId}', function (Request $request, Response $response) {
        try {
            $cdlId=$request->getAttribute('cdlId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT cdlId, cdlName, cdlStatus FROM codelistmaster WHERE cdlId=$cdlId");
            $codelist=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($codelist);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/codelist_values/{clvCdlId}', function (Request $request, Response $response) {
        try {
            $clvCdlId=$request->getAttribute('clvCdlId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT clvId, clvValue, clvDisplayText, clvOrder FROM codelistvalue WHERE clvStatus=1 AND clvCdlId=$clvCdlId ORDER BY clvOrder");
            $codelistValues=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($codelistValues);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/codelist/add', function (Request $request, Response $response) {
        try {
            $cdlName=$request->getParam('cdlName');
            $cdlStatus=$request->getParam('cdlStatus');
            $clvValue=$request->getParam('clvValue');
            $clvDisplayText=$request->getParam('clvDisplayText');
            $clvOrder=$request->getParam('clvOrder');
            $delClvFlag=$request->getParam('delClvFlag');
            $clvId=$request->getParam('clvId');
            $cdlAddedBy=1;
            $cdlUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO codelistmaster (cdlName,cdlStatus,cdlAddedBy,cdlDateAdded,cdlUpdatedBy,cdlDateUpdated) VALUES (:cdlName,:cdlStatus,:cdlAddedBy,NOW(),:cdlUpdatedBy,NOW())");
            $rows=$res->execute([":cdlName"=>$cdlName,":cdlStatus"=>$cdlStatus,":cdlAddedBy"=>$cdlAddedBy,":cdlUpdatedBy"=>$cdlUpdatedBy]);
            $cdlId=$mysqlCon->lastInsertId();
            for($i=0; $i<count($clvId); $i++) {
                if($delClvFlag[$i]==0) {
                    $res=$mysqlCon->prepare("INSERT INTO codelistvalue (clvCdlId,clvValue,clvDisplayText,clvOrder,clvStatus,clvAddedBy,clvDateAdded,clvUpdatedBy,clvDateUpdated) VALUES (:cdlId,:clvValue,:clvDisplayText,:clvOrder,1,:clvAddedBy,NOW(),:clvUpdatedBy,NOW())");
                    $rows=$res->execute([":cdlId"=>$cdlId,":clvValue"=>$clvValue[$i],":clvDisplayText"=>$clvDisplayText[$i],":clvOrder"=>$clvOrder[$i],":clvAddedBy"=>$cdlAddedBy,":clvUpdatedBy"=>$cdlUpdatedBy]);
                }
            }
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/codelist/update/{cdlId}', function (Request $request, Response $response) {
        try {
            $cdlId=$request->getAttribute('cdlId');
            $cdlName=$request->getParam('cdlName');
            $cdlStatus=$request->getParam('cdlStatus');
            $clvValue=$request->getParam('clvValue');
            $clvDisplayText=$request->getParam('clvDisplayText');
            $clvOrder=$request->getParam('clvOrder');
            $delClvFlag=$request->getParam('delClvFlag');
            $clvId=$request->getParam('clvId');
            $cdlUpdatedBy=1;

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE codelistmaster SET cdlName=:cdlName,cdlStatus=:cdlStatus,cdlUpdatedBy=:cdlUpdatedBy,cdlDateUpdated=NOW() WHERE cdlId=:cdlId");
            $rows=$res->execute([":cdlName"=>$cdlName,":cdlStatus"=>$cdlStatus,":cdlUpdatedBy"=>$cdlUpdatedBy,":cdlId"=>$cdlId]);
            $mysql=null;
            for($i=0; $i<count($clvId); $i++) {
                if($delClvFlag[$i]==0) {
                    if($clvId[$i]==0) {
                        $res=$mysqlCon->prepare("INSERT INTO codelistvalue (clvCdlId,clvValue,clvDisplayText,clvOrder,clvStatus,clvAddedBy,clvDateAdded,clvUpdatedBy,clvDateUpdated) VALUES (:cdlId,:clvValue,:clvDisplayText,:clvOrder,1,:clvAddedBy,NOW(),:clvUpdatedBy,NOW())");
                        $rows=$res->execute([":cdlId"=>$cdlId,":clvValue"=>$clvValue[$i],":clvDisplayText"=>$clvDisplayText[$i],":clvOrder"=>$clvOrder[$i],":clvAddedBy"=>$cdlUpdatedBy,":clvUpdatedBy"=>$cdlUpdatedBy]);
                    }
                    else {
                        $res=$mysqlCon->prepare("UPDATE codelistvalue SET clvValue=:clvValue,clvDisplayText=:clvDisplayText,clvOrder=:clvOrder,clvUpdatedBy=:clvUpdatedBy,clvDateUpdated=NOW() WHERE clvId=:clvId");
                        $rows=$res->execute([":clvValue"=>$clvValue[$i],":clvDisplayText"=>$clvDisplayText[$i],":clvOrder"=>$clvOrder[$i],":clvUpdatedBy"=>$cdlUpdatedBy,":clvId"=>$clvId[$i]]);
                    }
                }
                else {
                    $res=$mysqlCon->prepare("UPDATE codelistvalue SET clvValue=:clvValue,clvDisplayText=:clvDisplayText,clvOrder=:clvOrder,clvStatus=0,clvUpdatedBy=:clvUpdatedBy,clvDateUpdated=NOW() WHERE clvId=:clvId");
                    $rows=$res->execute([":clvValue"=>$clvValue[$i],":clvDisplayText"=>$clvDisplayText[$i],":clvOrder"=>$clvOrder[$i],":clvUpdatedBy"=>$cdlUpdatedBy,":clvId"=>$clvId[$i]]);
                }
            }
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/codelist/delete/{cdlId}', function (Request $request, Response $response) {
        try {
            $cdlId=$request->getAttribute('cdlId');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM codelistmaster WHERE cdlId=:cdlId");
            $rows=$res->execute([":cdlId"=>$cdlId]);
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
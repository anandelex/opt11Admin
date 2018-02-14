<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    $app = new \Slim\App;
    $app->get('/api/customers', function (Request $request, Response $response) {
        try {
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT * FROM customers");
            $customers=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($customers);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->get('/api/customer/{id}', function (Request $request, Response $response) {
        try {
            $id=$request->getAttribute('id');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->query("SELECT * FROM customers WHERE id=$id");
            $customer=$res->fetchAll(PDO::FETCH_OBJ);
            $mysql=null;
            return json_encode($customer);
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->post('/api/customer/add', function (Request $request, Response $response) {
        try {
            $fullname=$request->getParam('fullname');
            $email=$request->getParam('email');
            $phone=$request->getParam('phone');

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("INSERT INTO customers (fullname,email,phone) VALUES (:fullname,:email,:phone)");
            $res->bindParam(":fullname",$fullname);
            $res->bindParam(":email",$email);
            $res->bindParam(":phone",$phone);
            $rows=$res->execute();
            $mysql=null;
            return '{"Status":"Inserted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->put('/api/customer/update/{id}', function (Request $request, Response $response) {
        try {
            $id=$request->getAttribute('id');
            $fullname=$request->getParam('fullname');
            $email=$request->getParam('email');
            $phone=$request->getParam('phone');

            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("UPDATE customers SET fullname=:fullname,email=:email,phone=:phone WHERE id=$id");
            $rows=$res->execute([":fullname"=>$fullname,":email"=>$email,":phone"=>$phone]);
            $mysql=null;
            return '{"Status":"Updated","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
    $app->delete('/api/customer/delete/{id}', function (Request $request, Response $response) {
        try {
            $id=$request->getAttribute('id');
            $mysql=new mysql();
            $mysqlCon=$mysql->connect();
            $res=$mysqlCon->prepare("DELETE FROM customers WHERE id=$id");
            $rows=$res->execute();
            $mysql=null;
            return '{"Status":"Deleted","AfftectedRows":'.$rows.'}';
        }
        catch (PDOException $Exception) {
            echo '{"error": {"text":"'.$Exception->getMessage( ).'","code":"'.(int)$Exception->getCode( ).'"} }';
        }
    });
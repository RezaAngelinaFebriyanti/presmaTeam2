<?php
    function connection() : PDO{
        $host = "LAPTOP-ODRK022O"; //nama server\nama_instance
        $database = "sistemprestasi";

        $dsn = "sqlsrv:Server=$host;Database=$database";
        $uid = "";
        $pwd = "";
        $conn = new PDO($dsn,$uid, $pwd);    
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
?>
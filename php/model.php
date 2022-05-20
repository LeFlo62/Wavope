<?php
    include_once './php/mysql.php';
    $bdh = new DBHandler();

    function getCards(){
        global $bdh;
        $reqdata = $bdh->getInstance()->prepare("SELECT title, date, content FROM cards ORDER BY date desc"); 
        $reqdata->execute();
        $data = $reqdata->fetchAll();
        return $data;
    }

    function getUserData($user_id){
        global $bdh;
        $requserdata = $bdh->getInstance()->prepare('SELECT * FROM user_data WHERE user_id = :user_id');
        $requserdata->bindparam('user_id', $user_id, PDO::PARAM_INT);
        $requserdata->execute();
        $userdata = $requserdata->fetch();
        return $userdata;
    }

    function getUsers(){
        global $bdh;
        $reqdata = $bdh->getInstance()->prepare("SELECT id,firstname,lastname,email,birthdate,user_rank,banned FROM users JOIN user_data ON users.id = user_data.user_id GROUP BY users.id;");
        $reqdata->execute();
        $data = $reqdata->fetchAll();
        return $data;
    }

    function getDevices(){
        global $bdh;
        $reqdata = $bdh->getInstance()->prepare("SELECT product_number,name,firstname,lastname,user_rank,products.user_id FROM products JOIN user_data ON products.user_id = user_data.user_id");
        $reqdata->execute();
        $data = $reqdata->fetchAll();
        return $data;
    }

    function getFAQ(){
        global $bdh;
        $reqfaq = $bdh->getInstance()->prepare("SELECT * FROM faq ORDER BY ordering");
        $reqfaq->execute();
        $faq = $reqfaq->fetchAll();
        return $faq;
    }

?>
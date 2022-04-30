<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    }

    if(!isset($_SESSION['id'])) { 
		header("Location: /login.php");
        exit;
	}

    if($_SESSION['user_rank'] !== 'admin'){
        header("Location: /");
        exit;
    }
?>
<link rel="stylesheet" href="./back-office/css/users.css">
<div class="users-table">
    <div class="users-table-row title">
        <div class="users-table-col">
            Prénom
        </div>
        <div class="users-table-col">
            Nom
        </div>
        <div class="users-table-col">
            E-Mail
        </div>
        <div class="users-table-col">
            Date de naissance
        </div>
        <div class="users-table-col">
            Type
        </div>
    </div>
    <?php
        include_once './php/mysql.php';

        $bdh = new DBHandler();

        $reqdata = $bdh->getInstance()->prepare("SELECT firstname,lastname,email,birthdate,user_rank FROM users JOIN user_data ON users.id = user_data.user_id GROUP BY users.id;");
        $reqdata->execute();
        $data = $reqdata->fetchAll();

        foreach($data as $row){
            echo '<div class="users-table-row">
            <div class="users-table-col">
                <p class="hint">Prénom: </p>'. $row['firstname'] .'
            </div>
            <div class="users-table-col">
                <p class="hint">Nom: </p>'. $row['lastname'] .'
            </div>
            <div class="users-table-col">
                <p class="hint">E-Mail: </p>'. $row['email'] .'
            </div>
            <div class="users-table-col">
                <p class="hint">Date de naissance: </p>'. $row['birthdate'] .'
            </div>
            <div class="users-table-col">
                <p class="hint">Type: </p>'. $row['user_rank'] .'
            </div>
        </div>';
        }
    ?>
</div>
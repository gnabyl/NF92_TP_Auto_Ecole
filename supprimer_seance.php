<?php
    include('config.php');

    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
    
    $required_params = array('idseance');

// ==================== FUNCTIONS ====================

function check_params($params) {
    foreach ($GLOBALS['required_params'] as $param_name) {
        if (empty($params[$param_name]))
            return false;
    }
    return true;
}
// ====================== MAIN =======================
    if (!check_params($_POST)) {
        echo "Bad request<br>";
	    return;
    }

    echo "<head>
        <meta charset='utf-8'/>
        <link rel='stylesheet' type='text/css' href='bootstrap-4.3.1/css/bootstrap.min.css'>
        <link rel='stylesheet' type='text/css' href='css/container.css'>
    </head>";

    $idseance = $_POST['idseance'];
    $connect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("Can't connect to database");
    mysqli_query($connect, "SET NAMES utf8");

/*  
 *  Désincription des élèves de la séance
 *  à cause d'une clé étrangère
 */
    $query = "DELETE FROM inscription
                WHERE idseances=$idseance";

    echo $query;
    mysqli_query($connect, $query);
// ============================================
  
// ============ Supprimer la séance ===========
    $query = "DELETE FROM seances
                WHERE idseance=$idseance";
    mysqli_query($connect, $query);
// ============================================

    mysqli_close($connect);
?>
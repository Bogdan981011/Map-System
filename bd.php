<?php
function getBD(){
        // Read environment variables, using local defaults if they are not set
        $host   = getenv('DB_HOST') ?: 'gondola.proxy.rlwy.net';
        $port   = getenv('DB_PORT') ?: '49734';
        $dbname = getenv('DB_NAME') ?: 'railway';
        $user   = getenv('DB_USER') ?: 'root';
        $pass   = getenv('DB_PASS') ?: 'JUfpvmsHwIYVJAghRMNHCPzKQRsCrUTY';
    
        // Construct the DSN using host, port, and database name
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    
        try {
            $bdd = new PDO($dsn, $user, $pass);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

function getData($bdd, $table){
        if ($table == 'economie'){
                $stmt = $bdd->prepare("SELECT * 
                                FROM $table, pays
                                WHERE $table.id_country = pays.id_pays");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }elseif ($table == 'pays'){
                $stmt = $bdd->prepare("SELECT * 
                                FROM $table");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
                $stmt = $bdd->prepare("SELECT * 
                                FROM $table, pays
                                WHERE $table.id_pays = pays.id_pays");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}
?>

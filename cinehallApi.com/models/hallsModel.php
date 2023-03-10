<?php 
require("connection.php");
    class halls {
        function gethalls(){
            $test = new connection;
            $con = $test->connection();
            $response = array();
            if ($con) {
            $sql = "SELECT h.id , m.price , m.title , m.image , m.description , h.label FROM `halls` h , `movies` m WHERE h.movie = m.id and h.is_full = 0;";
            $result = mysqli_query($con, $sql);
            if($result) {
                $x = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $response [$x]['id'] = $row['id'];
                    $response [$x]['title'] = $row['title'];
                    $response [$x]['image'] = $row['image'];
                    $response [$x]['label'] = $row['label'];
                    $response [$x]['price'] = $row['price'];
                    $response [$x]['description'] = $row['description'];
                    $x++;
                }
                return json_encode($response, JSON_PRETTY_PRINT);
            }
            }
        }
        function getSingle($id){
            $test = new connection;
            $con = $test->connection();
            $response = array();
            if ($con) {
            $sql = "SELECT h.id , m.price , m.title , m.image , m.description , h.label FROM `halls` h , `movies` m WHERE h.movie = m.id and h.id = $id";
            $result = mysqli_query($con, $sql);
            if($result) {
                $x = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $response [$x]['id'] = $row['id'];
                    $response [$x]['title'] = $row['title'];
                    $response [$x]['image'] = $row['image'];
                    $response [$x]['label'] = $row['label'];
                    $response [$x]['price'] = $row['price'];
                    $response [$x]['description'] = $row['description'];
                    $x++;
                }
                return json_encode($response, JSON_PRETTY_PRINT);
            }
            }
        }
        function creathalls($label,$movie){
            $test = new connection;
            $conn = $test->connection();
            
            if($conn->connect_error){
                die('conection failed :'.$conn->connect_error);
                echo "error";
                }else{
                $sql="INSERT INTO `halls` (`label`,`movie`) VALUES (?,?)";
                $resultat = $conn->prepare($sql);
                $resultat->bind_param("sd",$label,$movie);
                $resultat->execute() or die("Erreur lors de l'execution de la requete: ");
                echo "Success";
            }
        }
        function updatehalls($id,$label,$movie){
            $test = new connection;
            $conn = $test->connection();
            $sql="UPDATE `halls` SET `label` = '$label', `movie` = $movie WHERE `id` = $id ;";
            if($conn->connect_error){
               die('conection failed :'.$conn->connect_error);
               echo "error";
               }else{
                $resultat = $conn->prepare($sql);
                $resultat->execute() or die("Erreur lors de l'execution de la requete: ");
                echo "Success";
            }
    }
        function deletehalls($id){
            $test = new connection;
            $conn = $test->connection();
            if($conn->connect_error){
                die('conection failed :'.$conn->connect_error);
                echo "error";
            }else{
                 $sql = "DELETE FROM `halls` WHERE `halls`.`id` = ?";
                 $resultat = $conn->prepare($sql);
                 $resultat->bind_param("d",$id);
                 $resultat->execute() or die("Erreur lors de l'execution de la requete: ");
                 echo "Success:";
            }
        }
    }
?>
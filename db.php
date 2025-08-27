<?php 
    function Connect_DB() {
        $connect = new mysqli("127.0.0.1:3306", "root", "", "bd_ctpmn");
        if ($connect->connect_error) {
            die("Conexión fallida: " . $connect->connect_error); 
        }
        else{
            return $connect;
        }
    }

/*
    function Add_data()  {
    $connection = Connect_DB();
    $nombre = "Mbappe";
    $email = "email@gmail.com";
    $sql = "INSERT INTO users (nombre, email) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $nombre, $email);
    if ($stmt->execute()) {
        echo "\nUsuario registrado correctamente.";
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
    }

    function Delete_data() {
    $connection = Connect_DB();
    $nombre = "Mussolini";
    $sql = "DELETE FROM users WHERE nombre = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $nombre);
    if ($stmt->execute()) {
        echo "\nUsuario eliminado correctamente.";
    } else {
        echo "Error al eliminar: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
    }

    function Access_data(){
        $connection = Connect_DB();
        $id = "2";
        $sql = "SELECT id, nombre, email FROM users WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $user = $result->fetch_assoc();

            $id = $user["id"];
            $nombre = $user["nombre"];
            $email = $user["email"];

            echo "User 1: \n";
            echo "ID: ", $id, "\n";
            echo "Nombre: ", $nombre, "\n";
            echo "correo: ", $email, "\n";
        }
    }
        
    function Update_data(){
        $connection = Connect_DB();
        $sql = "UPDATE users SET email = ? WHERE nombre = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();

        $stmt->close();
        $connection->close();
    }
*/
?>


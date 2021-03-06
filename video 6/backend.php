<?php
    
    $pdo = new PDO("mysql:dbname=reactfirst;host=127.0.0.1", "root", "");
    
    if(isset($_POST['accion'])) {
        switch($_POST['accion']) {
            
            // Inserta la información
            case 1:
                $statement = $pdo->prepare('INSERT INTO tareas(titulo, estatus) VALUE (:titulo, 1)');
                $statement->execute(array('titulo' => $_POST['titulo']));
                
                header('Content-Type: application/json');
                $results = ['response' => 'bien guardar =)'];
                $json = json_encode($results);
                echo $json;
                
            break;

            // Borrar la información
            case 2:
                $statement = $pdo->prepare('DELETE FROM tareas WHERE id = :id');
                $statement->execute(array('id' => $_POST['id']));
                
                header('Content-Type: application/json');
                $results = ['response' => 'bien borrar =)'];
                $json = json_encode($results);
                echo $json;
            break;

            // Modifica la información
            case 3:
                $statement = $pdo->prepare("UPDATE tareas SET estatus=:estatus WHERE id=:id");
                $statement->execute(array("estatus" => $_POST['estatus'], "id" => $_POST['id']));
                
                header('Content-Type: application/json');
                $results = ['response' => 'bien Modificar =)'];
                $json = json_encode($results);
                echo $json;
            break;

            // Opcion invalida
            default:
                $results = ['response' => 'Mal opcion invalida =('];
                $json = json_encode($results);
                echo $json;
            break;
        }
    } else {
        header('Content-Type: application/json');
        $statement = $pdo->prepare("SELECT * FROM tareas");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
    }
    
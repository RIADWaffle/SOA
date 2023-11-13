<?php
require "config/Conexion.php";

  //print_r($_SERVER['REQUEST_METHOD']);
switch($_SERVER['REQUEST_METHOD']) {
  case 'GET':

      // Consulta SQL para seleccionar datos de la tabla
      $sql = "SELECT id,img,name,salary,type,place FROM jobs";

      $query = $conexion->query($sql);

      if ($query->num_rows > 0) {
          $data = array();
          while ($row = $query->fetch_assoc()) {
              $data[] = $row;
          }
          // Devolver los resultados en formato JSON
          header('Content-Type: application/json');
          echo json_encode($data);
      } else {
          echo "No se encontraron registros en la tabla.";
      }

      $conexion->close();
      break;

/////////////////// POST REQUEST /////////////////////////
    case 'POST':
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir los datos del formulario HTML
        $img = $_POST['PST_img'];
        $name = $_POST['PST_name'];
        $salary = $_POST['PST_salary'];
        $type = $_POST['PST_type'];
        $place = $_POST['PST_place'];
    
        // Insertar los datos en la tabla
        $sql = "INSERT INTO jobs (img, name, salary, type, place) VALUES ('$img', '$name','$salary', '$type', '$place')"; // Reemplaza con el nombre de tu tabla
    
        if ($conexion->query($sql) === TRUE) {
            echo "Datos insertados con éxito.";
            
        } else {
            echo "Error al insertar datos: " . $conexion->error;
        }
    } else {
        echo "Esta API solo admite solicitudes POST.";
    }
    
    $conexion->close();
      break;


/////////////////// DELETE REQUEST /////////////////////////
      case 'DELETE':
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
          // Procesar solicitud DELETE
          $id = $_GET['id'];
          $sql = "DELETE FROM jobs WHERE id = $id";
      
          if ($conexion->query($sql) === TRUE) {
              echo "Registro eliminado con éxito.";
          } else {
              echo "Error al eliminar registro: " . $conexion->error;
          }
          } else {
              echo "Método de solicitud no válido.";
          }
          $conexion->close();
          break;

/////////////////// PATCH REQUEST /////////////////////////
      case 'PATCH':
        if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
          parse_str(file_get_contents("php://input"), $datos);

          // INICIAR VARIABLES
          $id = $_GET['id'];    
          $img = isset($datos['img']) ? $datos['img'] : null;
          $name = isset($datos['name']) ? $datos['name'] : null;
          $salary = isset($datos['salary']) ? $datos['salary'] : null;
          $type = isset($datos['type']) ? $datos['type'] : null;
          $place = isset($datos['place']) ? $datos['place'] : null;

          // REVIZAR CAMBIOS
          if ($_SERVER['REQUEST_METHOD'] === 'PATCH') { // Método PATCH
            $actualizaciones = array();

            if (!empty($img)) {
                $actualizaciones[] = "img = '$img'";
            }
            if (!empty($name)) {
                $actualizaciones[] = "name = '$name'";
            }
            if (!empty($salary)) {
                $actualizaciones[] = "salary = '$salary'";
            }
            if (!empty($type)) {
                $actualizaciones[] = "type = '$type'";
            }
            if (!empty($place)) {
                $actualizaciones[] = "place = '$place'";
            }
    
            $actualizaciones_str = implode(', ', $actualizaciones);
            $sql = "UPDATE jobs SET $actualizaciones_str WHERE id = $id";
        }


          // Procesar solicitud PATCH
      
          if ($conexion->query($sql) === TRUE) {
              echo "Registro actualizado con éxito. (PATCH)";
          } else {
              echo "Error al actualizar registro: " . $conexion->error;
          }
          } else {
              echo "Método de solicitud no válido.";
          }
          $conexion->close();
          break;

/////////////////// PUT REQUEST /////////////////////////
          case 'PUT':
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
              
              $id = $_GET['id'];
              $img = $_GET['img'];
              $name = $_GET['name'];
              $salary = $_GET['salary'];
              $type = $_GET['type'];
              $place = $_GET['place'];
          
              if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                  $sql = "UPDATE jobs SET img='$img', name='$name', salary='$salary', type='$type', place='$place' WHERE id=$id";
              } 
              if ($conexion->query($sql) === TRUE) {
                  echo "Registro actualizado con éxito. (PUT)";
              } else {
                  echo "Error al actualizar registro: " . $conexion->error;
              }
          } else {
              echo "Método de solicitud no válido.";
          }
          
          $conexion->close();
      
            break;



/////////////////// OPTIONS REQUEST /////////////////////////
      case 'OPTIONS':
        // Habilitar CORS para cualquier origen
        header("Access-Control-Allow-Origin: *");
        
        // Permitir métodos HTTP específicos
        header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS, HEAD, LINK");
        
        // Permitir encabezados personalizados
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        
        // Permitir credenciales
        header("Access-Control-Allow-Credentials: true");
        
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // Responder a la solicitud OPTIONS sin procesar nada más
            http_response_code(200);
            exit;
        }
           break;


/////////////////// HEAD REQUEST /////////////////////////
        case 'HEAD':
            if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
              // Establecer encabezados de respuesta
              header('Content-Type: application/json');
              header('Custom-Header: PHP 8, HTML ');
          } else {
              http_response_code(405); // Método no permitido
              echo 'Método de solicitud no válido';
          }
            break;

/////////////////// LINK REQUEST /////////////////////////
        case'LINK':
            $apiUrl = 'https://ejemplo.com/tu_endpoint'; // Reemplaza con la URL de tu API
            $resourceUri = '/ruta/a/tu/recurso'; // Reemplaza con la ruta de tu recurso
            $linkHeader = '<' . $resourceUri . '>; rel="link-type"'; // Define el encabezado Link
              
            $options = [
                'http' => [
                    'method' => 'LINK',
                    'header' => 'Link: ' . $linkHeader,
                ],
            ];

///////////////////////////////////////////////////////////
      $conexion->close();
      break;

     default:
       echo 'undefined request type!';
  }
?>
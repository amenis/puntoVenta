<?php
///CLASE PARA CONECTAR CON MYSQL.....////
error_reporting(0);
class ConexionMySQL{

  private $conexion;
  private $total_consultas;

  public function ConexionMySQL(){
    if(!isset($this->conexion)){
      $this->conexion = mysqli_connect("localhost","root","prototype","db_puntoventa")
        or die("No se pudo establecer una conexion con el servidor, consulte a Soporte...!");
      //mysqli_select_db($this->conexion,"db_puntoventa") or die("Ocurrio un problema al seleccionar la base de datos, consulte a Soporte...!");
    }
  }

  public function consulta($consulta){
    //error_reporting(0);
    $this->total_consultas++;
    $resultado = mysqli_query($this->conexion,$consulta);
    if(!$resultado){
      echo 'Error en MySQL: ' . mysqli_error($this->conexion);
      //echo "0";
      //exit;
    }
    return $resultado;
  }

  public function buscar_array($consulta){
    error_reporting(0);
   return mysqli_fetch_array($consulta);
  }

  public function numero_de_registros($consulta){
   error_reporting(0);
   return mysqli_num_rows($consulta);
  }

  public function getTotalConsultas(){
   return $this->total_consultas;
  }

  public function DesconectaServer(){
    error_reporting(0);
    mysqli_close($this->conexion);
  }

  public function getError(){
    mysqli_error($this->conexion);
  }

}
?>
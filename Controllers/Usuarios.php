<?php
class Usuarios extends Controller {
    private $views;

    public function __construct() {
        session_start();
        parent::__construct();
        $this->views = new Views(); 
    }

    public function index() {
        $this->views->getView($this, "index");
    }

    public function validar() {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos están vacíos";
        } else {
            $usuario = $_POST['usuario']; 
            $clave = $_POST['clave'];
            $data = $this->model->getUsuario($usuario, $clave); 
            if ($data) {
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $msg = "ok";
            } else {
                $msg = "Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
?>

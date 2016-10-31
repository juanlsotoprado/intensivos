<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('login/Login_model');
        $this->load->model('General');
    }

    public function index() {

        if (!$this->session->userdata('usuario') || ($this->session->userdata('registrado') != "registrado")) {

            $this->load->view('Login/Login');
        } else {

            redirect('/app', 'refresh');
        }
    }

    public function Validar() {

        if (!$this->session->userdata('usuario') || ($this->session->userdata('registrado') != "registrado")) {

            $usuario = isset($_POST['usuario']);
            $password = isset($_POST['password']);
            $ldap = isset($_POST['ldap']);

            if (($password) && ($usuario) && ($ldap)) {

                //  $result['usuario'] = "jsoto";
                //  $result['registrado'] = "registrado";
                // $result['perfil'] = $result2;
                // $result['sede'] = $result4;
                // $result['perfil_seleccionado'] = $result3;
                // $this->session->set_userdata($result);
                // redirect('/app', 'refresh');

                if ($_POST['ldap'] == "false") {

                    $_POST['usuario'] = trim($_POST['usuario']);
                    $_POST['password'] = trim($_POST['password']);

                    $result = $this->Login_model->ValidarUsuario_ldap($_POST['usuario'], $_POST['password']);

                    if ($result) {

                        $_SESSION['registrado'] = TRUE;
                        $result2['usuario'] = $result['sistem']['nombre1'] . " " . $result['sistem']['apellido1'];
                        $result2['cedula'] = $result['ldap']['numcedula'];
                        $result2["oficina"] = $result['ldap']["oficina"];


                        $result2["ieu"] = $result['sistem']["nombre_ieu"];
                        $result2["id_perfil"] = $result['sistem']["id_perfil"];
                        $result2["id_tipo_persona"] = $result['sistem']["id_tipo_persona"];
                        $result2["nombre_perfil"] = $result['sistem']["nombre_perfil"];
                        $result2["correo"] = $_POST['usuario'] . "@mppeuct.gob.ve";



                        if ($result2["id_perfil"] == 3) {
                            $result2["universidad"] = $this->General->Get_universidades_usuario($result2["cedula"]);
                            // error_log(print_r($result2["universidad"], true));
                        }

                        if ($result2["id_perfil"] == 3) {
                            $result2["universidad"] = $this->General->Get_universidades_usuario($result2["cedula"]);
                            // error_log(print_r($result2["universidad"], true));
                        }

                        $this->session->set_userdata($result2);
                        redirect('/app', 'refresh');
                    } else {

                        redirect('/login', 'refresh');
                    }
                } else {

                    $result = $this->Login_model->ValidarUsuario_sistema($_POST['usuario'], $_POST['password']);


                    $this->General->Validar_estudiante_ieu($result['sistem']["cedula"]);



                    if ($result) {


                        if ($result['sistem']["id_perfil"] == 4) {

                            $data_validar_estudiante = $this->General->Validar_estudiante_ieu($result['sistem']["cedula"]);

                            if (!$data_validar_estudiante) {

                                redirect('/login', 'refresh');
                            }

                            //  error_log(print_r("entro", true));

                            $this->General->Validar_inicio_session($result['sistem']["cedula"]);

                            $result2["postulado"] = $this->Login_model->Validar_postulacion($result['sistem']["cedula"]);
                        }



                        $_SESSION['registrado'] = TRUE;
                        $result2["cedula"] = $result['sistem']["cedula"];
                        $result2['usuario'] = $result['sistem']['nombre1'] . " " . $result['sistem']['apellido1'];
                        $result2["id_perfil"] = $result['sistem']["id_perfil"];
                        $result2["ieu"] = $result['sistem']["nombre_ieu"];
                        $result2["id_tipo_persona"] = $result['sistem']["id_tipo_persona"];
                        $result2["nombre_perfil"] = $result['sistem']["nombre_perfil"];
                        $result2["correo"] = $_POST['usuario'];

                        //  error_log(print_r($result2["id_perfil"], true));





                        if ($result2["id_perfil"] == 3) {
                            $result2["universidad"] = $this->General->Get_universidades_usuario($result2["cedula"]);
                            error_log(print_r($result2["universidad"], true));
                        }


                        $this->session->set_userdata($result2);

                        // error_log(print_r($result2, true));


                        redirect('/app', 'refresh');
                    } else {

                        redirect('/login', 'refresh');
                    }
                }
            } else {

                redirect('/login', 'refresh');
                error_log('Revento usuario y clave');

                exit;
            }
        } else {
//            
            redirect('/login', 'refresh');
            error_log('Revento usuario y clave');
        }
    }

    public function Cerrar() {
        $this->Login_model->CerrarSession();
        redirect('/login', 'refresh');
    }

}

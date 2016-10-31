<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_servicios extends CI_Controller {

    function __construct() {
        parent::__construct();

        // error_log(print_r($this->uri->segment(2), true));


        if ($this->uri->segment(2) != 'get_datos_saime' && $this->uri->segment(2) != 'verificar_correo_estudiante' && $this->uri->segment(2) != 'get_estudiante_validado' && $this->uri->segment(2) != 'get_estados' && $this->uri->segment(2) != 'get_etnias' && $this->uri->segment(2) != 'get_discapacidades' && $this->uri->segment(2) != 'get_municipios' && $this->uri->segment(2) != 'get_parroquias' && $this->uri->segment(2) != 'actualizar_estudiante' && file_get_contents('php://input') == false) {

            if (!$this->session->userdata('usuario') || ($this->session->userdata('registrado') != "registrado")) {

                redirect('/login', 'refresh');
            }
        }

        $this->load->model('General');
    }

    public function actualizar_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        //  error_log(print_r($_POST, true));
        $params = array();

        $params['casos'] = $this->General->Actualizar_estudiante($_POST);

        //error_log(print_r($_POST, true));

        $this->Respuesta_json($_POST);
    }

    public function get_estados() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_estados();

        $this->Respuesta_json($params);
    }

    public function get_carrera_existente() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos']['existe'] = $this->General->Get_carrera_existente();
        
        
        $this->Respuesta_json($params);
    }

 

    public function get_etnias() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_etnias($_POST);

        $this->Respuesta_json($params);
    }

    public function get_discapacidades() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_discapacidades($_POST);

        $this->Respuesta_json($params);
    }

    public function get_municipios() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        // error_log(print_r($_POST,true));

        $params = array();

        $params['casos'] = $this->General->Get_municipios($_POST);

        $this->Respuesta_json($params);
    }

    public function get_parroquias() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_parroquias($_POST);

        $this->Respuesta_json($params);
    }

    public function cambiar_clave() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Cambiar_clave($_POST);

        $this->Respuesta_json($params);
    }

    public function get_datos_saime() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_persona_saime($_POST['cedula']);

        if ($params['casos']) {

            $params['casos']['usuario_exitente'] = $this->get_ver_usuario_existe($_POST) ? 'true' : 'false';
        }

        $this->Respuesta_json($params);
    }

    public function get_datos_saime_profesor_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_persona_saime($_POST['cedula']);

        if ($params['casos']) {

            $params['casos']['usuario_exitente'] = $this->get_ver_usuario_existe_ieu($_POST) ? 'true' : 'false';
        }


        $this->Respuesta_json($params);
    }

    public function get_estudiante_validado($data = false) {

        if ($data) {

            $_POST = $data;
        }



        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Get_persona_saime($_POST['cedula']);

        $temp = $params['casos'];

        if ($params['casos']) {

            $params['casos'] = $this->General->Get_estudiante_validado($_POST);

            if ($params['casos'] == 'true') {

                $params['casos'] = $temp;
            }
        } else {

            $params['casos'] = '1';
        }

        // error_log(print_r($temp, true));

        $this->Respuesta_json($params);
    }

    public function verificar_correo() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params['casos'] = $this->get_correo_existe($_POST) ? 'true' : 'false';


        $this->Respuesta_json($params);
    }

    public function verificar_correo_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params['casos'] = $this->get_correo_estudiante_existe($_POST) ? 'true' : 'false';


        $this->Respuesta_json($params);
    }

    public function get_datos_mppeuct_saime() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();
        $params['casos'] = $this->General->Get_persona_saime($_POST['cedula']);

        $this->Respuesta_json($params);
    }

    public function get_universidades() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();
        $params['casos'] = $this->General->Get_universidades();

        $this->Respuesta_json($params);
    }

    public function get_universidades_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_universidades_estudiante();

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function get_usuarios_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();
        $params['casos'] = $this->General->Get_usuarios_ieu();

        $this->Respuesta_json($params);
    }

    public function get_ver_usuario_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        //  error_log(print_r($_POST, true));


        $params = array();

        $params['casos'] = $this->General->Get_usuario_ieu($_POST);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

    public function get_ver_usuario_existe($cedula) {


        $params = $this->General->Get_usuario_existente($cedula);

        // error_log(print_r($params, true));

        return $params;
    }

    public function get_ver_usuario_existe_ieu($cedula) {

        $params = $this->General->Get_usuario_existente_ieu($cedula);

        //  error_log(print_r($params, true));

        return $params;
    }

    public function get_correo_existe($correo) {


        $params = $this->General->Get_correo_existente($correo);

        return $params;
    }

    public function get_correo_estudiante_existe($data) {


        $params = $this->General->Get_correo_estudiante_existe($data);

        return $params;
    }

    public function registrar_usuario_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Registrar_usuario_ieu($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function modificar_usuario_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Modificar_usuario_ieu($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function set_estatus_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Set_estatus_ieu($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function set_restablecer_clave() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->set_restablecer_clave($_POST);

        // error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function set_restablecer_clave_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->set_restablecer_clave_estudiante($_POST);

        // error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function Respuesta_json($json) {

        if ($json) {

            echo json_encode($json);
        } else {

            echo json_encode('false');
        }
    }

//--------------------------- profesor

    public function registrar_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Registrar_profesor($_POST);

        $this->Respuesta_json($params);
    }

    public function get_ver_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        // error_log(print_r($_POST, true));

        $params = array();

        $params['casos'] = $this->General->Get_profesor($_POST);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

    public function get_profesores() {

        ///   error_log(print_r("llego", true));

        $params = array();
        $params['casos'] = $this->General->Get_profesores();

        $this->Respuesta_json($params);
    }

    public function set_estatus_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Set_estatus_profesor($_POST);

        //     error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

    public function modificar_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Modificar_profesor($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

//---------------------------fin profesor
//--------------------------- estudiante

    public function registrar_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();


        $params['casos'] = $this->General->Registrar_estudiante($_POST);

        $this->Respuesta_json($params);
    }

    public function get_ver_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        //error_log(print_r($_POST, true));

        $params = array();

        $params['casos'] = $this->General->Get_estudiante($_POST);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

    public function get_estudiantes() {

        ///   error_log(print_r("llego", true));

        $params = array();
        $params['casos'] = $this->General->Get_estudiantes();

        $this->Respuesta_json($params);
    }

    public function get_postulaciones_realizadas() {

        ///   error_log(print_r("llego", true));

        $params = array();
        $params['casos'] = $this->General->Get_postulaciones_realizadas();

        $this->Respuesta_json($params);
    }

    public function set_estatus_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Set_estatus_estudiante($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function set_restablecer_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Set_restablecer_estudiante($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function get_vincular_seccion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_vincular_seccion($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function get_profesores_sin_vinculacion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_profesores_sin_vinculacion();

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function get_secciones_disponibles() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_secciones_disponibles($_POST);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

    public function get_materias_disponibles() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_materias_disponibles($_POST);


        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }
    
        public function get_materias_disponibles_vinculadas() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_materias_disponibles_vinculadas($_POST);


        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }
    
    
    

    public function modificar_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Modificar_estudiante($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function get_vincular_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Get_vincular_profesor($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function get_vincular_profesor_id() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Get_vincular_profesor_id($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function registrar_profesor_vincular() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();



        $params['casos'] = $this->General->Registrar_profesor_vincular($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

//---------------------------fin profesor

    public function get_carreras_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();


        if (file_get_contents('php://input') == false) {

            $params['casos'] = $this->General->Get_carreras_ieu();
        } else {

            $params['casos'] = $this->General->Get_carreras_ieu($_POST);
        }



        $this->Respuesta_json($params);
    }

    public function get_carreras_vinculadas() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Get_carreras_vinculadas($_POST);


        $this->Respuesta_json($params);
    }

    public function get_materias() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_materias();
        //  error_log(print_r($params, true));


        $this->Respuesta_json($params);
    }

    public function get_materia_id() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_materia_id($_POST);
        //  error_log(print_r($params, true));


        $this->Respuesta_json($params);
    }

    public function get_secciones() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_secciones();
        //  error_log(print_r($params, true));


        $this->Respuesta_json($params);
    }

    public function get_secciones_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_secciones_profesor();
        //  error_log(print_r($params, true));


        $this->Respuesta_json($params);
    }

    public function get_secciones_vinculadas_disponibles() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_secciones_vinculadas_disponibles($_POST);
        error_log(print_r($params, true));


        $this->Respuesta_json($params);
    }

    public function registrar_seccion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();


        $params['casos'] = $this->General->Registrar_seccion($_POST);

        $this->Respuesta_json($params);
    }

    public function registrar_postulacion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();


        $params['casos'] = $this->General->Registrar_postulacion($_POST);

        $this->Respuesta_json($params);
    }

    public function Set_estatus_seccion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Set_estatus_seccion($_POST);
        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function Set_estatus_materia() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Set_estatus_materia($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function set_estatus_postulacion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Set_estatus_postulacion($_POST);

        //   error_log(print_r($_POST, true));
        $this->Respuesta_json($params);
    }

    public function registrar_materia() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Registrar_materia($_POST);

        $this->Respuesta_json($params);
    }
    
     public function registrar_carrera() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Registrar_carrera($_POST);

        $this->Respuesta_json($params);
    }
    
    public function modificar_carrera() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Modificar_carrera($_POST);

        $this->Respuesta_json($params);
    }
    
    

    public function modificar_materia() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Modificar_materia($_POST);

        $this->Respuesta_json($params);
    }

    public function modificar_carrera_estudiante() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Modificar_carrera_estudiante($_POST);

        $this->Respuesta_json($params);
    }

    public function modificar_vinculacion() {

        $_POST = json_decode(file_get_contents('php://input'), true);


        $params = array();

        $params['casos'] = $this->General->Modificar_vinculacion($_POST);

        $this->Respuesta_json($params);
    }

    public function eliminar_postulacion() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Eliminar_postulacion($_POST);

        $this->Respuesta_json($params);
    }

    public function desvincular_profesor() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Desvincular_profesor($_POST);

        $this->Respuesta_json($params);
    }

    public function get_materias_vinculadas_disponibles() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->Get_materias_vinculadas_disponibles($_POST);

        $this->Respuesta_json($params);
    }

    public function get_postulaciones() {

        $params = array();

        $params['casos'] = $this->General->Get_postulaciones();

        $this->Respuesta_json($params);
    }
    
    
    
    
    
    
    
    
     // ------------------------------------------------ nuevo reportes ------------------->
    
    
    
    public function reporte_cantidad_estudiante_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_estudiante_ieu($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

    public function reporte_cantidad_docente_ieu() {
        
   

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_docente_ieu();

       

        $this->Respuesta_json($params);
    }

    public function reporte_cantidad_estudiante_carrera_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_estudiante_carrera_ieu();

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
     public function reporte_cantidades_personas_tipo() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidades_personas_tipo($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }

      public function reporte_cantidad_estudiantes_sin_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_estudiantes_sin_ieu($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
    public function reporte_cantidad_estudiantes_sin_carrera() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_estudiantes_sin_carrera($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
        public function reporte_cantidad_en_ieupersona_y_no_en_persona() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_en_ieupersona_y_no_en_persona($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
      public function reporte_cantidad_en_carrerapersona_y_no_en_persona() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_en_carrerapersona_y_no_en_persona($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
      public function reporte_cantidad_docentes_sin_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_docentes_sin_ieu($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
    
      public function reporte_cantidad_estudiantes_validado_postulado_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_estudiantes_validado_postulado_ieu($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
    
      public function reporte_cantidad_estudiantes_validado_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_estudiantes_validado_ieu($_POST['cedula']);

        // error_log(print_r($params, true));

        $this->Respuesta_json($params);
    }
    
      public function reporte_cantidad_carreras_materias_secciones_por_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_cantidad_carreras_materias_secciones_por_ieu($_POST['cedula']);

        error_log(print_r("llego", true));

        $this->Respuesta_json($params);
    }
    
     public function reporte_todas_carreras_materias_secciones_por_ieu() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte_todas_carreras_materias_secciones_por_ieu($_POST['cedula']);

        error_log(print_r("llego", true));

        $this->Respuesta_json($params);
    }
    
    public function reporte1_para_el_calculo() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte1_para_el_calculo($_POST['cedula']);

        error_log(print_r("llego", true));

        $this->Respuesta_json($params);
    }
    
    
     public function reporte2_para_el_calculo() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte2_para_el_calculo($_POST['cedula']);

       // error_log(print_r("llego", true));

        $this->Respuesta_json($params);
    }
    
    
      public function reporte3_para_el_calculo() {

        $_POST = json_decode(file_get_contents('php://input'), true);

        $params = array();

        $params['casos'] = $this->General->reporte3_para_el_calculo($_POST['cedula']);

      //  error_log(print_r("llego", true));

        $this->Respuesta_json($params);
    }


    // ------------------------------------------------ nuevo reportes fin------------------->

}

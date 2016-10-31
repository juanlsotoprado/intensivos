<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ($this->uri->segment(2) != 'Validar_Inscripcion') {

            if (!$this->session->userdata('usuario') || ($this->session->userdata('registrado') != "registrado")) {

                redirect('/login', 'refresh');
            }
        }

        $this->load->model('General');
    }

    // ------------------------------------------------ nuevo reportes ------------------->




    public function Reportes() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/reportes', $data);
    }

    public function Reportes_vistas($vista = false) {

        $data['user_sesion'] = $this->session->all_userdata();

        $ruta = 'App/Reportes/' . $vista;
        // error_log(print_r($ruta, true));

        $this->load->view($ruta, $data);
    }

    // ------------------------------------------------ nuevo reportes fin------------------->



    public function index() {

        // $result = $this->session->all_userdata();
        //   error_log(print_r($this->session->all_userdata(), true));

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('Header', $data);
        $this->load->view('Menu', $data);
        $this->load->view('Home');
        $this->load->view('Footer', $data);
    }

    public function Edtar_materia() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-editar_materia', $data);
    }

    public function Edtar_carrera() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-editar_carrera', $data);
    }

    public function Editar_carrera() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu_editar_carrera_estudiante', $data);
    }

    public function Administrar_carreras() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-registro_carrera', $data);
    }

    public function Agregar_materia() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-registro_materia', $data);
    }

    public function cambiar_clave() {



        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/cambiar-clave', $data);
    }

    public function Administrar_materia() {


        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/mppeuct-registro-ieu', $data);
    }

    public function Agregar_profesor() {


        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/profesor-registro', $data);
    }

    public function Agregar_estudiante() {


        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/estudiante-registro', $data);
    }

    public function Postulacion() {

        // error_log('hola mundo');


        $data['user_sesion'] = $this->session->all_userdata();

        //  echo "hola mundo";

        $this->load->view('App/mppeuct-postulacion_estudiante', $data);
    }

    public function Inicio() {


        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/mppeuct-registro-ieu', $data);
    }

    public function En_construccion() {


        $data['user_sesion'] = $this->session->all_userdata();

        // $this->load->view('App/mppeuct_informacion_ieu', $data);


        echo "<p>
<blockquote>
    Estimado Profesor(a) " . $_SESSION['usuario'] . ", según la información suministrada en reunión del día 15 de julio de 2016 con los responsables institucionales de los cursos intensivos. Para completar las etapas de activación del sistema de intensivos 2016 deberá enviar la información referente a las materias, profesores y estudiantes de su IEU.
    <br><br>

    A continuación se presenta el formato que deberá descargar, llenar y posteriormente enviar al correo <b>intensivos@mppeuct.gob.ve</b>
    <br><br>
    Formato:  (Link de descarga del <a style='text-decoration: underline; color:blue;' href='" . base_url('publico/docs/Pre-registro_Sistema_Intensivos_2016.xls') . "' target = '_blank'> formato.xls</a>)
    <br><br>
    Instructivo de llenado: (Link de descarga del <a style='text-decoration: underline; color:blue;' href='" . base_url('publico/docs/Instructivo_Archivo.pdf') . "' target = '_blank'> instructivo .pdf</a>)

    <br><br>   <br><br>

    <b>Esta información debe ser enviada antes el día 25 de Julio de 2016.</b>

</blockquote>
</p>";
    }

    public function Gestionar_ieu() {


        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/mppeuct-gestionar-ieu', $data);
    }

    public function instructivo() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-instructivo', $data);
    }

    public function oficio() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-oficio', $data);
    }

    public function Registrar_usuario_mppeuct() {


        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/mppeuct-registro_usuario', $data);
    }

    public function Ver_caso() {

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/ver_caso', $data);
    }

    public function Edtar_ieu() {

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/mppeuct-modificacion', $data);
    }

    //--------------------------- profesor

    public function Gestionar_profesor() {

        $data['user_sesion'] = $this->session->all_userdata();
        // echo "hola mundo";

        $this->load->view('App/profesor-administracion', $data);
    }

    public function Ver_profesor() {

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/ver_profesor', $data);
    }

    public function Edtar_profesor() {

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/profesor-modificacion', $data);
    }

    public function Vincular_profesor() {
        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/ieu_vincular_profesor', $data);
    }

    public function Edtar_vinacular_profesor() {
        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/ieu_vincular_profesor_modificar', $data);
    }

    public function Gestionar_estudiante() {

        $data['user_sesion'] = $this->session->all_userdata();
        // echo "hola mundo";

        $this->load->view('App/estudiante-administracion', $data);
    }

    //---------------------------fin profesor
    //--------------------------- estudiante

    public function Administrar_postulaciones() {

        $data['user_sesion'] = $this->session->all_userdata();
        // echo "hola mundo";

        $this->load->view('App/estudiante-administracion_postulaciones', $data);
    }

    public function Ver_estudiante() {

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/ver_estudiante', $data);
    }

    public function Edtar_estudiante() {

        $data['user_sesion'] = $this->session->all_userdata();

        $this->load->view('App/estudiante-modificacion', $data);
    }

    //---------------------------fin estudiante
    //
   
        //--------------------------- matematica


    public function Agregar_seccion() {

        $data['user_sesion'] = $this->session->all_userdata();

        // echo "hola mundo";

        $this->load->view('App/ieu-registro_secciones', $data);
    }

    //---------------------------fin matematica


    public function postulacion_realizada() {


        $params = $this->General->Datos_postulacion();

        //    error_log(print_r($params, true));


        echo "<p>
<blockquote>
    Estimado Estudiante <b>" . $_SESSION['usuario'] . "</b>. <br><br> Usted se ha postulado al curso intensivo en la fecha <b>" . $params['fecha'] . "</b>, en la I.E.U. <b>" . $params['nombre_ieu'] . "</b>, en la carrera <b>" . $params['nombre_carrera'] . "</b>, sección <b>" . $params['nombre_seccion'] . "</b>, en la materia <b>" . $params['nombre_materia'] . "</b>.
    <br>
</blockquote>
</p>";
    }

}

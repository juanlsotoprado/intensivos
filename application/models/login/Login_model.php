<?php

class Login_model extends CI_Model {

    //Semilla utilizada en crypt para mejorar la seguridad de las claves, es importante NO modificar el String
    public static $SEMILLA = '&$.m1&$.n1st3r&$.10d3c1&$.3nc14&$.yt3cn&$.0l0g14$$SistemaGPID./10$$2015.encrypt$$c12ve';

    function __construct() {
        parent::__construct();
    }

    public function ValidarUsuario_ldap($usuario = NULL, $password = NULL) {
        echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
        ini_set("soap.wsdl_cache_enabled", "0");
        try {
            $params = array('usuario' => $usuario, 'clave' => $password);
            $client = new SoapClient("http://webservices.mppeuct.gob.ve/ldap/ldap.wsdl", array());
            $soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.mppeuct.gob.ve/ldap/schema.xsd");
            $objeto = $client->consultarLdap(new SoapParam($soapstruct, "message"));

            if ($objeto != 0) {


                $result = $this->ValidarUsuario_existente($objeto['numcedula']);


                // error_log(print_r($objeto, true));

                if ($result) {

                    $params['ldap'] = $objeto;
                    $params['sistem'] = $result;

                    return $params;
                } else {
                    error_log("clave o usuario invalido / usuario inactivo sistema");
                    $_SESSION['error'] = true;
                    return FALSE;
                }
            } else {
                error_log("clave o usuario invalido / usuario inactivo ldap");
                $_SESSION['error'] = true;
                return FALSE;
            }
        } catch (SoapFault $exp) {
            error_log(print_r($exp->getMessage()));
        }
        return TRUE;
    }

    public function ValidarUsuario_existente($cedula) {

        $query = "select 
            p.*,
            u.id_perfil,
            pf.nombre_perfil,
            i.nombre_ieu
                from persona p
                inner join usuario u  on(u.cedula = p.cedula)
                inner join perfil pf  on(u.id_perfil = pf.id_perfil)
                LEFT JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                LEFT JOIN ieu i ON (ip.id_ieu = i.id_ieu)   
                where  
                u.cedula = " . $cedula . " AND
                u.activo = true
                ";

        // error_log(print_r($query,true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {

                return $row;

                //  error_log(print_r($row, true));
            }
        } else {

            return false;
        }
    }

    public function ValidarUsuario_sistema($usuario, $password) {


        $clave = crypt($password, $this::$SEMILLA);

        $query = "select 
            p.*,
            u.id_perfil,
            u.correo_validado,
            u.activo,
            pf.nombre_perfil,
            i.nombre_ieu
                
                
                from persona p
                inner join usuario u  on(u.cedula = p.cedula)
                inner join perfil pf  on(u.id_perfil = pf.id_perfil)
                INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)
                INNER JOIN ieu i ON (ip.id_ieu = i.id_ieu)   

                where  
                upper(u.nombre_usuario) = '" .  mb_strtoupper($usuario, "utf-8"). "' AND
                u.clave =  '" . $clave . "' 
                ";

        // error_log(print_r($query,true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {

                if ($row['id_perfil'] == 4 && $row['correo_validado'] == true && $row['activo'] != true) {


                    return false;
                }


                $param['sistem'] = $row;

                return $param;

                //  error_log(print_r($row, true));
            }
        } else {

            error_log("clave o usuario invalido / usuario inactivo en el sistema");
            $_SESSION['error'] = true;
            return FALSE;
        }
    }

    public function Validar_postulacion($data) {



        $query = "select 
                    cedula
                
                
                from datos_academicos
           
                where  
                cedula = ". $data;

        // error_log(print_r($query,true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            
               return true;
          
        } else {

            return false;
        }
    }

    public function CerrarSession() {

        $this->session->sess_destroy();
    }

}

?>
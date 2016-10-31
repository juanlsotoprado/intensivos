<?php

class General extends CI_Model {

//Semilla utilizada en crypt para mejorar la seguridad de las claves, es importante NO modificar el String
    public static $SEMILLA = '&$.m1&$.n1st3r&$.10d3c1&$.3nc14&$.yt3cn&$.0l0g14$$SistemaGPID./10$$2015.encrypt$$c12ve';
    public $global = false;

    function __construct() {
        parent::__construct();



        $this->global = $this->load->database('global', TRUE);
        $cedula = 14304979;
      //  $contra = crypt('/.SI' . $cedula . "Is", "mppeuct-intensivos-2016*./");

//
          error_log(print_r($contra, true));
    }

    public function strtoupper_intensivo($data) {

        return mb_strtoupper($data, "utf-8");
    }

    public function Actualizar_estudiante($data) {


        $this->db->trans_begin();

        $contra = crypt('/.SI' . $data['cedula'] . "Is", "mppeuct-intensivos-2016*./");

        $clave = crypt($contra, $this::$SEMILLA);

        $query = " UPDATE  persona set

          nacionalidad = '" . $this->strtoupper_intensivo($data['nacionalidad']) . "',
          nombre1 =  '" . $this->strtoupper_intensivo($data['primer_nombre']) . "',
          nombre2 = '" . $this->strtoupper_intensivo($data['segundo_nombre']) . "',
          apellido1 = '" . $this->strtoupper_intensivo($data['primer_apellido']) . "',
          apellido2 = '" . $this->strtoupper_intensivo($data['segundo_apellido']) . "',
          genero =  '" . $data['genero'] . "',
          correo_ppal =  '" . $this->strtoupper_intensivo($data['correo']) . "',
          correo_secundario =  '" . $this->strtoupper_intensivo($data['correo_alternativo']) . "',
          telefono_hab =  '" . $data['tlf_hab'] . "',
          telefono_celular = '" . $data['tlf_cel'] . "'

          where

          cedula =  " . $data['cedula'] . "

          ";


// error_log(print_r($query, true));
        $result = $this->db->query($query);


        $query = "
          SELECT

          cedula

          FROM

          usuario

          where

          cedula =  " . $data['cedula'];

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            $query = " UPDATE  usuario set

          nombre_usuario = '" . $this->strtoupper_intensivo($data['correo']) . "',
          clave = '" . $clave . "'

          where

          cedula =  " . $data['cedula'] . "

          ";

// error_log(print_r($query, true));
            $result = $this->db->query($query);
        } else {

            $query = " INSERT INTO usuario
              (
                cedula,
                id_perfil,
                activo,
                nombre_usuario,
                clave,
                autentica_ldap
                
                
              )
              VALUES
              (
              " . $data['cedula'] . ",
                  4,
                  true,
                 '" . $this->strtoupper_intensivo($data['correo']) . "',
                  '" . $clave . "',
                     false
                  )
                ";

//error_log(print_r($query, true));

            $result = $this->db->query($query);
        }



//  error_log(print_r($query, true));




        $query = "
          SELECT

          cedula

          FROM

          datos_estudiante

          where

          cedula =  " . $data['cedula'];

//  error_log(print_r($query, true));


        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            $query = " update datos_estudiante set
          
          cod_estado = " . $data['estado']['cod_estado'] . ",
          cod_municipio =  " . $data['municipio']['cod_municipio'] . ",
          cod_parroquia = " . $data['parroquia']['cod_parroquia'] . ",";

            if ($data['etnia']) {

                $query .= "id_etnia = " . $data['etnia']['id_etnia'] . ",";
            }


            $query .= "id_discapacidad =   " . $data['discapacidad']['id_discapacidad'] . "

          where 
          cedula = " . $data['cedula'];



// error_log(print_r($query, true));
            $result = $this->db->query($query);
        } else {

            $query = " INSERT INTO datos_estudiante
          (
          cedula,
          cod_estado,
          cod_municipio,
          cod_parroquia,";

            if ($data['etnia']) {

                $query .= " id_etnia,";
            }

            $query .= " id_discapacidad

          )
          VALUES
          (
          " . $data['cedula'] . ",
              " . $data['estado']['cod_estado'] . ",
                  " . $data['municipio']['cod_municipio'] . ",
                     " . $data['parroquia']['cod_parroquia'] . ",";

            if ($data['etnia']) {

                $query .= $data['etnia']['id_etnia'] . ",";
            }

            $query .= $data['discapacidad']['id_discapacidad'] . "
          )
          ";


//  error_log(print_r($query, true));


            $result = $this->db->query($query);
        }


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {



            $nom = "MPPEUCT(Intensivos)";
            $dir = $data['correo'];

// $dir = "jsoto@mppeuct.gob.ve";

            $asunto = "Creación de usuario en el Sistema de Intensivos.";
            $mensaje = '<p><span style="font-family: Arial; font-size: '
                    . '14px; line-height: 1.2;"><b>Estudiante  ' . $data['primer_nombre'] . ' ' . $data['primer_apellido'] . '</b><br><br>El Gobierno Bolivariano dando cumplimiento al Artículo 102 de la Constitución de la República Bolivariana de Venezuela donde se establece que la educación es un derecho humano y un deber social fundamental, es democrática, gratuita y obligatoria, a través del Ministerio del Poder Popular para Educación Universitaria, Ciencia y Tecnología garantiza la gratuidad de los <b> intensivos universitarios 2016</b><br><br>Con el siguiente usuario usted podrá completar su validación como cursante de los Intensivos Universitarios 2016.<br><br>'
                    . 'Para ingresar por favor vaya a la página: <a href="http://intensivos.mppeuct.gob.ve/"> http://intensivos.mppeuct.gob.ve/</a>  &nbsp;<br><br>'
                    . 'Usuario : ' . $dir . ' <br> Clave: ' . $contra . '</p>' . "<br> <br> <hr> <br> <h3><b> Nota:  Todas aquellas IEU que hicieron algún tipo de cobro a los estudiantes cursantes 
del Intensivo 2016, estan en la obligacion de hacer el reintegro total de lo cobrado a los 
estudiantes. Este ministerio garantiza la transferencia de los recursos necesarios, 
calculado según lo establecido en el instructivo que regula los Intensivos Universitarios 2016.</b><h3>";




            $result = self::Enviar_correo($nom, $dir, $asunto, $mensaje);

            $mensaje = 'MPPEUCT(Intensivos 2016): Se le informa que fue creado un usuario en el Sistema de Intensivos 2016, revise su correo: ' . $dir;

            $numero = $data['tlf_cel'];

            $result = self::Enviar_mensaje($numero, $mensaje);

            // error_log('llego');

            $this->db->trans_commit();

            return true;
        }
    }

    public function Validar_inicio_session($data) {

        $query = " UPDATE  usuario set
              
               correo_validado = true
               
              where 
              
              cedula =  " . $data . "
                  
                ";

// error_log(print_r($data, true));
        $this->db->query($query);
    }

    public function Validar_estudiante_ieu($data) {

        if ($data) {

            $query = " select 
                         * 
                   from   
                      ieu_persona 
              
              where 
              
              cedula =  " . $data . " 
           and estatus = true
                  
                ";

// error_log(print_r($data, true));
            $result = $this->db->query($query);

            if ($result->num_rows() > 0) {

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function Get_estados() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    estado
                ORDER BY descripcion";

        $result = $this->global->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_carrera_persona() {

        $data_session = $this->session->all_userdata();

        $query = "
               select c.nombre_carrera from carrera_persona cp 
inner join carrera c on (cp.id_carrera = c.id_carrera)
where cp.cedula = " . $data_session['cedula'];

        // error_log(print_r($query, true));


        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                return $row;
            }

            return $params;
        } else {

            return false;
        }
    }

    public function Get_carrera_existente() {

        $data_session = $this->session->all_userdata();

        $query = "
            
                select cp.id_carrera from carrera_persona cp 
                inner join carrera c on (cp.id_carrera = c.id_carrera)
                inner join materia m on (m.id_carrera = c.id_carrera)
                join seccion_materia_profesor smp on (m.id_materia = smp.id_materia)
                where cp.cedula = " . $data_session['cedula'] . "  
                 group by  cp.id_carrera";



        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function Get_etnias() {

//$this->global->

        $query = "
        SELECT
        *
        FROM
        etnia
        ORDER BY descripcion";


        $result = $this->global->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

// error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_discapacidades() {

//$this->global->

        $query = "
        SELECT
        *
        FROM
        discapacidad
        ORDER BY descripcion";


        $result = $this->global->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_municipios($data) {

//$this->global->
        $query = "
        SELECT
        *
        FROM
        municipio
        WHERE
        cod_estado = '" . $data['cod_estado'] . "'
        ORDER BY descripcion";

// error_log(print_r($query, true));


        $result = $this->global->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_parroquias($data) {

//$this->global->
        $query = "
        SELECT
        *
        FROM
        parroquia
        WHERE
        cod_municipio = '" . $data['cod_municipio'] . "'
        ORDER BY descripcion";

        $result = $this->global->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

// error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_persona_saime($cedula) {

        ini_set("soap.wsdl_cache_enabled", "0");
        try {
            $params = array('cedula' => $cedula);
            $wsdl = "http://webservices.mppeuct.gob.ve/saime/saime.wsdl";
            $schema = "http://webservices.mppeuct.gob.ve/saime/schema.xsd";
            $client = new SoapClient($wsdl, array());
            $soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", $wsdl);
            $objeto = $client->consultarSaime(new SoapParam($soapstruct, "message"));


            if ($objeto != 0) {

                return $objeto;
            } else {

                return false;
            }
        } catch (SoapFault $exp) {
            print_r($exp->getMessage());
        }
    }

//select p.cedula,cp.id_carrera from persona p
//LEFT JOIN carrera_persona cp ON (p.cedula = cp.cedula)
//where cp.id_ieu is null and p.id_tipo_persona = 3 AND p.cedula in (
//
//select p.cedula from persona p
//INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)
//where  p.id_tipo_persona = 3
//
//)

    public function Get_estudiante_validado($data) {

        $query = "
                select 
                p.cedula
                from persona p
                inner join ieu_persona ip on (p.cedula = ip.cedula)
                inner join carrera_persona cp on (p.cedula = cp.cedula)
                where  
                p.cedula = " . $data['cedula'] . "
                    
                AND p.id_tipo_persona = 3
                
                ";

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {


            $query = "select 
                cedula
                from usuario p
                where  
                cedula = " . $data['cedula'] . "
                AND correo_validado = true
                
                ";

// error_log(print_r($query, true));


            $result = $this->db->query($query);



            if ($result->num_rows() > 0) {

                return '3';
            } else {

                return 'true';
            }
        } else {

            return '2';
        }
    }

    public function Get_universidades() {

        $query = "SELECT
                  *
                  FROM ieu 
                                   
                  ORDER BY nombre_ieu

                ";
        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_ieu']] = $row;
            }

// error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_universidades_estudiante() {

        $data_session = $this->session->all_userdata();

        $query = "SELECT
                  i.*
                  from ieu_persona ip
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu) 
                  
                  where 
                  ip.cedula = " . $data_session['cedula'] . " AND
                  ip.estatus <> false
                  
                  ORDER BY i.nombre_ieu

                ";
//  error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_ieu']] = $row;
            }
//  error_log(print_r($params, true));


            return $params;
        } else {

            return false;
        }
    }

    public function Get_universidades_usuario($cedula) {

        $query = "SELECT
                  i.*
                  from ieu_persona ip
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu) 
                  
                  where 
                  ip.cedula = " . $cedula . "
                  
                  ORDER BY i.nombre_ieu

                ";
        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params = $row;
            }

// error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_usuario_ieu($data) {

        $query = "SELECT
                  p.*,
                  to_char(p.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  i.nombre_ieu,
                  i.id_ieu
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  
                   WHERE    
                 p.cedula =" . $data['cedula'] . " AND
                 p.id_tipo_persona = 2 
                 
                  ORDER BY p.cedula

                ";

//  error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_usuario_existente($data) {



        $query = "SELECT
                  p.*,
                  to_char(p.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  i.nombre_ieu,
                  i.id_ieu
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  
                   WHERE    
                 p.cedula =" . $data['cedula'] . " 
                 
                  ORDER BY p.cedula

                ";

        error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function Get_usuario_existente_persona($data) {



        $query = "SELECT
                  p.cedula
                  FROM persona  p
  
                   WHERE    
                 p.cedula =" . $data['cedula'] . " 
                 
                  ORDER BY p.cedula
                ";

        //   error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function Get_usuario_existente_ieu($data) {


        $data_session = $this->session->all_userdata();

        $query = "SELECT
                  p.*,
                  to_char(p.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  i.nombre_ieu,
                  i.id_ieu
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu) 
                  
                   WHERE    
                 p.cedula =" . $data['cedula'] . " 
                 and i.id_ieu =" . $data_session['universidad']['id_ieu'] . "
                 
                  ORDER BY p.cedula

                ";

//  error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result) {
            
        }

        if ($result->num_rows() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function Get_correo_existente($data) {



        $query = "SELECT
                  p.*,
                  to_char(p.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  i.nombre_ieu,
                  i.id_ieu
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  
                   WHERE    
                  upper( p.correo_ppal) ='" . $this->strtoupper_intensivo($data['correo']) . "'
                  ORDER BY p.cedula

                ";

//  error_log(print_r($query, true));


        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function Get_correo_estudiante_existe($data) {

        $query = "SELECT
                  cedula
                  
                  from usuario
                  
                   WHERE    
                  upper(nombre_usuario) ='" . $this->strtoupper_intensivo($data['correo']) . "'


                ";

///  error_log(print_r($query, true));
//  error_log(print_r($data, true));


        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            return true;
        } else {

            return false;
        }
    }

    public function Get_usuarios_ieu() {

        $query = "SELECT
                  p.*,
                  i.nombre_ieu,
                  u.activo
                  
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  INNER JOIN usuario  u ON (u.cedula = p.cedula)   
                  
                   WHERE    
                   
                 p.id_tipo_persona = 2
                 
                  ORDER BY p.cedula

                ";

// error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }

//error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Set_estatus_ieu($data) {


        $query = " UPDATE  usuario set
              
               activo = " . $data['estatus'] . "
              where 
              
              cedula =  " . $data['cedula'] . "
                  

                ";


//  error_log(print_r($data, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function set_restablecer_clave($data) {

        $clave = crypt($data['cedula'], $this::$SEMILLA);

        $query = " UPDATE  usuario set
              
               clave = '" . $clave . "'
              where 
              
              cedula =  " . $data['cedula'] . "
                  

                ";


//  error_log(print_r($data, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function set_restablecer_clave_estudiante($data) {

        $contra = crypt('/.SI' . $data['cedula'] . "Is", "mppeuct-intensivos-2016*./");

        $clave = crypt($contra, $this::$SEMILLA);


        $query = " UPDATE  usuario set
              
               clave = '" . $clave . "'
              where 
              
              cedula =  " . $data['cedula'] . "
                  

                ";

//  error_log(print_r($query, true));
        $result = $this->db->query($query);


        if ($result) {

//error_log(print_r($data, true));



            $nom = "MPPEUCT(Intensivos)";
            $dir = $data['correo'];

// $dir = "jsoto@mppeuct.gob.ve";

            $asunto = "Restablecimiento de contraseña";
            $mensaje = '<p><span style="font-family: Arial; font-size: '
                    . '14px; line-height: 1.2;"><b>Estudiante  ' . $data['nombre1'] . ' ' . $data['apellido1'] . '</b><br><br> Su contraseña en el <b>Sistema de Intensivos 2016</b>, ha sido restablecida.<br><br>'
                    . 'Usuario : ' . $dir . ' <br> Clave: ' . $contra . '</p>';

            $result = self::Enviar_correo($nom, $dir, $asunto, $mensaje);





            return true;
        } else {

            return false;
        }
    }

    public function Modificar_usuario_ieu($data) {


        $this->db->trans_begin();

        $clave = crypt($data['cedula'], $this::$SEMILLA);


        $query = " UPDATE  persona set
              
              nacionalidad = '" . $this->strtoupper_intensivo($data['nacionalidad']) . "',
              nombre1 =  '" . $this->strtoupper_intensivo($data['nombre1']) . "',
              nombre2 = '" . $this->strtoupper_intensivo($data['nombre2']) . "',
              apellido1 = '" . $this->strtoupper_intensivo($data['apellido1']) . "',
              apellido2 = '" . $this->strtoupper_intensivo($data['apellido2']) . "',
              genero =  '" . $data['genero'] . "',
              correo_ppal =  '" . $this->strtoupper_intensivo($data['correo_ppal']) . "',
              correo_secundario =  '" . $this->strtoupper_intensivo($data['correo_secundario']) . "',
              telefono_hab =  '" . $data['telefono_hab'] . "',
              telefono_celular = '" . $data['telefono_celular'] . "'
                          
              
              where 
              
              cedula =  " . $data['cedula'] . "
                  

                ";


//  error_log(print_r($query, true));
        $result = $this->db->query($query);



        $query = " UPDATE  ieu_persona set 
              
              id_ieu =  " . $data['universidad']['id_ieu'] . "
              
              where 
              
             cedula =  " . $data['cedula'] . "
             
             ";


//  error_log(print_r($query, true));
        $result = $this->db->query($query);

        $query = " UPDATE  usuario set 
              
                nombre_usuario = '" . $this->strtoupper_intensivo($data['correo_ppal']) . "'
                
                where 
              
             cedula =  " . $data['cedula'] . "
             
                ";



//  error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {

            $this->db->trans_commit();

            $nom = "MPPEUCT(Intensivos)";
            $dir = $data['correo_ppal'];
            $asunto = "Modificación de usuario en el Sistema de Intensivos.";
            $mensaje = '<p><span style="font-family: Arial; font-size: '
                    . '14px; line-height: 1.2;"><b>Profesor(a) ' . $data['nombre1'] . ' ' . $data['apellido1'] . '</b><br><br> Se le informa que fue modificado su  usuario en el <b>Sistema de Intensivos 2016</b>,'
                    . '&nbsp; para ingresar por favor vaya a la página: <a href="http://intensivos.mppeuct.gob.ve/"> http://intensivos.mppeuct.gob.ve/</a>  &nbsp;<br><br> Nuevo usuario : ' . $data['correo_ppal'] . ' <br> Clave: Su número de cédula en caso que no la haya cambiado.</p>';

            $result = self::Enviar_correo($nom, $dir, $asunto, $mensaje);

            $mensaje = 'MPPEUCT(Intensivos 2016): Se le informa que fue modificado su usuario en el Sistema de Intensivos 2016, revise su correo: ' . $data['correo_ppal'];

            $numero = $data['telefono_celular'];

            $result = self::Enviar_mensaje($numero, $mensaje);

            return true;
        }
    }

    public function Registrar_usuario_ieu($data) {

        $this->db->trans_begin();


        $clave = crypt($data['cedula'], $this::$SEMILLA);


        $query = " INSERT INTO persona
              (
               cedula,
              nacionalidad,
              nombre1,
              nombre2,
              apellido1,
              apellido2 ,
              genero,
              correo_ppal,
              correo_secundario,
              telefono_hab,
              telefono_celular,
              id_tipo_persona,
              estatus,
              fecha
              
              )
              VALUES
              (
              " . $data['cedula'] . ",
            '" . $this->strtoupper_intensivo($data['nacionalidad']) . "',
              '" . $this->strtoupper_intensivo($data['primer_nombre']) . "',
                  '" . $this->strtoupper_intensivo($data['segundo_nombre']) . "',
                      '" . $this->strtoupper_intensivo($data['primer_apellido']) . "',
                          '" . $this->strtoupper_intensivo($data['segundo_apellido']) . "',
                              '" . $data['genero'] . "',
                                  '" . $this->strtoupper_intensivo($data['correo']) . "',
                                      '" . $this->strtoupper_intensivo($data['correo_alternativo']) . "',
                                          '" . $data['tlf_hab'] . "',
                                              '" . $data['tlf_cel'] . "',
                                                  2,
                                                  TRUE,
                                                  now()
                )
                ";


// error_log(print_r($query, true));
        $result = $this->db->query($query);


        if ($result) {

            $query = " INSERT INTO ieu_persona
              (
              id_ieu,
              cedula
              )
              VALUES
              (
               " . $data['universidad']['id_ieu'] . ",
              " . $data['cedula'] . "
              
                )
                ";


//  error_log(print_r($query, true));
            $result = $this->db->query($query);


            $query = " INSERT INTO usuario
              (
                cedula,
                id_perfil,
                activo,
                nombre_usuario,
                clave,
                autentica_ldap
                
                
              )
              VALUES
              (
              " . $data['cedula'] . ",
                  3,
                  true,
                 '" . $this->strtoupper_intensivo($data['correo']) . "',
                  '" . $clave . "',
                     false

                  )
                ";

// error_log(print_r($query, true));

            $result = $this->db->query($query);



            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return false;
            } else {


                $this->db->trans_commit();

                $nom = "MPPEUCT(Intensivos)";
                $dir = $data['correo'];
                $asunto = "Creación de usuario en el Sistema de Intensivos.";
                $mensaje = '<p><span style="font-family: Arial; font-size: '
                        . '14px; line-height: 1.2;"><b>Profesor(a)  ' . $data['primer_nombre'] . ' ' . $data['primer_apellido'] . '</b><br><br> Usted ha sido registrado como responsable institucional de la <b>' . $data['universidad']['nombre_ieu'] . '</b> ante el <b>Sistema de Intensivos 2016</b>, desde este usuario podrá gestionar y enviar la información necesaria para los respectivos actos administrativos.<br><br>'
                        . '&nbsp;Para ingresar por favor vaya a la página: <a href="http://intensivos.mppeuct.gob.ve/">http://intensivos.mppeuct.gob.ve/</a>  &nbsp;<br><br> Usuario : ' . $data['correo'] . ' <br> Clave: Su número de cédula</p>';

                $result = self::Enviar_correo($nom, $dir, $asunto, $mensaje);


                $mensaje = 'MPPEUCT(Intensivos 2016): Se le informa que fue creado un usuario en el Sistema de Intensivos 2016, revise su correo: ' . $data['correo'];

                $numero = $data['tlf_cel'];

                $result = self::Enviar_mensaje($numero, $mensaje);

                return true;
                
            }
        }
    }

    public static function Enviar_correo($nom, $dir, $asunto, $mensaje) {
        $mensaje = "<div style=\"top:0px:left:0px\"><img src=\"http://apis.mppeuct.gob.ve/img/comun/normativa.png\"></div>" . $mensaje;
        $params = array(
            'nombre' => $nom,
            'correo_remitente' => "no-responder@mppeuct.gob.ve",
            'correo_destinatario' => $dir,
            'asunto' => $asunto,
            'mensaje' => $mensaje,
            'HTML' => $mensaje
        );

        $client = new SoapClient("http://webservices.mppeuct.gob.ve/correo/correo.wsdl", array());
        $soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.mppeuct.gob.ve/correo/schema.xsd");
        $objeto = $client->enviarCorreo(new SoapParam($soapstruct, "message"));

        return $objeto;
    }

    public static function Enviar_mensaje($numero, $mensaje) {

        try {

            $options = array();
#(numero,mensaje,origen)
            $params = array('numero' => $numero, 'mensaje' => $mensaje, 'origen' => '', 'uid' => '');
            $client = new SoapClient("http://webservices.mppeuct.gob.ve/sms/sms.wsdl", $options);
            $soapstruct = new SoapVar($params, SOAP_ENC_OBJECT, "params", "http://webservices.mppeuct.gob.ve/sms/schema.xsd");
            $result = $client->enviarSms(new SoapParam($soapstruct, "message"));


            return $result;
        } catch (SoapFault $e) {
            error_log($e->getMessage());
            return 0;
        }
    }

//--------------------------- profesor

    public function Registrar_profesor($data) {

        $this->db->trans_begin();

        try {


            if (!$this->Get_usuario_existente_persona($data)) {

//  error_log(print_r('entro', true));



                $query = " INSERT INTO persona
              (
             cedula,
              nacionalidad,
              nombre1,
              nombre2,
              apellido1,
              apellido2 ,
              genero,
              correo_ppal,
              correo_secundario,
              telefono_hab,
              telefono_celular,
              id_tipo_persona,
              estatus,
              fecha
              
              )
              VALUES
              (
              " . $data['cedula'] . ",
            '" . $this->strtoupper_intensivo($data['nacionalidad']) . "',
              '" . $this->strtoupper_intensivo($data['primer_nombre']) . "',
                  '" . $this->strtoupper_intensivo($data['segundo_nombre']) . "',
                      '" . $this->strtoupper_intensivo($data['primer_apellido']) . "',
                          '" . $this->strtoupper_intensivo($data['segundo_apellido']) . "',
                              '" . $data['genero'] . "',
                                  '" . $this->strtoupper_intensivo($data['correo']) . "',
                                      '" . $this->strtoupper_intensivo($data['correo_alternativo']) . "',
                                          '" . $data['tlf_hab'] . "',
                                              '" . $data['tlf_cel'] . "',
                                                  4,
                                                  TRUE,
                                                  now()
                )
                ";


                //   error_log(print_r($query, true));




                $result = $this->db->simple_query($query);

                if (!$result)
                    throw new Exception("Error al insertar persona. query : " . $query);
            }

            $data_session = $this->session->all_userdata();


            $query = " INSERT INTO ieu_persona
              (
              id_ieu,
              cedula
              )
              VALUES
              (
              " . $data_session['universidad']['id_ieu'] . ",
              " . $data['cedula'] . "
              
                )
                ";

            $result2 = $this->db->simple_query($query);

            if (!$result2)
                throw new Exception("Error al insertar ieu_persona. query : " . $query);

            $this->db->trans_commit();
            return true;
        } catch (Exception $exc) {
            error_log($exc, 0);
            error_log(print_r($this->db->error(), true));
            $this->db->trans_rollback();

            return false;
        }
    }

    public function Get_profesor($data) {

        $query = "SELECT
                  p.*,
                  ip.estatus as activo,
                  to_char(p.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  i.nombre_ieu,
                  i.id_ieu
                  
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  
                   WHERE    
                 p.cedula =" . $data['cedula'] . " AND
                 p.id_tipo_persona = 4
                 
                  ORDER BY p.cedula

                ";

//   error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_profesores() {


        $data_session = $this->session->all_userdata();
// error_log(print_r($data_session, true));

        $query = "SELECT
                  p.*,
                  i.nombre_ieu,
                  ip.estatus as activo
                  
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  
                   WHERE    
                   
                  p.id_tipo_persona = 4 and 
                  i.id_ieu =" . $data_session['universidad']['id_ieu'] . "
                  ORDER BY p.cedula

                ";

//   error_log(print_r($query, true));

        $result = $this->db->query($query);



        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }

//   error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Set_estatus_profesor($data) {

        $data_session = $this->session->all_userdata();

        $query = " UPDATE  ieu_persona set
              
              estatus = " . $data['estatus'] . "
              where 
              
              cedula =  " . $data['cedula'] . " and
                  
              id_ieu =" . $data_session['universidad']['id_ieu'] . "
                  
                ";


// error_log(print_r($data, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function Modificar_profesor($data) {


        $clave = crypt($data['cedula'], $this::$SEMILLA);


        $query = " UPDATE  persona set
              
              nacionalidad = '" . $this->strtoupper_intensivo($data['nacionalidad']) . "',
              nombre1 =  '" . $this->strtoupper_intensivo($data['nombre1']) . "',
              nombre2 = '" . $this->strtoupper_intensivo($data['nombre2']) . "',
              apellido1 = '" . $this->strtoupper_intensivo($data['apellido1']) . "',
              apellido2 = '" . $this->strtoupper_intensivo($data['apellido2']) . "',
              genero =  '" . $data['genero'] . "',
              correo_ppal =  '" . $this->strtoupper_intensivo($data['correo_ppal']) . "',
              correo_secundario =  '" . $this->strtoupper_intensivo($data['correo_secundario']) . "',
              telefono_hab =  '" . $data['telefono_hab'] . "',
              telefono_celular = '" . $data['telefono_celular'] . "'
                          
              
              where 
              
              cedula =  " . $data['cedula'] . "
                  

                ";


//  error_log(print_r($query, true));
        $result = $this->db->query($query);
    }

//---------------------------fin profesor
//--------------------------- estudiante

    public function Registrar_estudiante($data) {

        $this->db->trans_begin();

        $clave = crypt(crypt('/.SI' . $data['cedula'] . "Is", "mppeuct-intensivos-2016*./"), $this::$SEMILLA);

        $data_session = $this->session->all_userdata();


        if (!$this->Get_usuario_existente_persona($data)) {


            $query = " INSERT INTO persona
              (
               cedula,
              nacionalidad,
              nombre1,
              nombre2,
              apellido1,
              apellido2 ,
              genero,
              id_tipo_persona,
              estatus,
              fecha
              
              )
              VALUES
              (
              " . $data['cedula'] . ",
            '" . $this->strtoupper_intensivo($data['nacionalidad']) . "',
              '" . $this->strtoupper_intensivo($data['primer_nombre']) . "',
                  '" . $this->strtoupper_intensivo($data['segundo_nombre']) . "',
                      '" . $this->strtoupper_intensivo($data['primer_apellido']) . "',
                          '" . $this->strtoupper_intensivo($data['segundo_apellido']) . "',
                              '" . $data['genero'] . "',
                                                  3,
                                                  TRUE,
                                                  now()
                )
                ";


//  error_log(print_r($query, true));


            $result = $this->db->query($query);
        }



        $query = " INSERT INTO ieu_persona
              (
              id_ieu,
              cedula
              )
              VALUES
              (
              " . $data_session['universidad']['id_ieu'] . ",
              " . $data['cedula'] . "
              
                )
                ";

// error_log(print_r($query, true));

        $result = $this->db->query($query);

        $query = "select 
            cedula
                from usuario 
                
           where

                cedula = " . $data['cedula'];

// error_log(print_r($query, true));


        $result = $this->db->query($query);

        if (!$result->num_rows() > 0) {


            $query = " INSERT INTO usuario
              (
                cedula,
                id_perfil,
                activo,
                nombre_usuario,
                clave,
                autentica_ldap
                
                
              )
              VALUES
              (
              " . $data['cedula'] . ",
                  4,
                  true,
                 '" . $this->strtoupper_intensivo("no-validado") . "',
                  '" . $clave . "',
                     false
                  )
                ";

//error_log(print_r($query, true));

            $result = $this->db->query($query);
        }


        $query = " INSERT INTO carrera_persona
              (
              id_ieu,
              cedula,
              id_carrera
              )
              VALUES
              (
              " . $data_session['universidad']['id_ieu'] . ",
              " . $data['cedula'] . ",
              " . $data['carrera']['id_carrera'] . "
                  
                )
                ";

//  error_log(print_r($data, true));
//   error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {

            $this->db->trans_commit();

            return TRUE;
        }
    }

    public function Get_estudiante($data) {

// error_log(print_r($data, true));

        $query = "SELECT
                  p.*,
                  ip.estatus as activo,
                  to_char(p.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  i.nombre_ieu,
                  i.id_ieu
                  
                  FROM persona  p
                  LEFT JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  LEFT JOIN ieu i ON (i.id_ieu = ip.id_ieu)
                  LEFT JOIN usuario  u ON (u.cedula = p.cedula)   

                  
                   WHERE    
                 p.cedula =" . $data['cedula'] . " AND
                 p.id_tipo_persona = 3
                 
                  ORDER BY p.cedula

                ";


        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_estudiantes() {


        $data_session = $this->session->all_userdata();

        $query = "SELECT
                  p.*,
                  i.nombre_ieu,
                  ip.estatus as activo,
                  u.nombre_usuario as correo_validado,
                   (CASE WHEN c.id_carrera > 1 THEN c.nombre_carrera
                   ELSE  'SIN CARRERA ASOCIADA' 
                    END) as nombre_carrera,
                   (CASE WHEN c.id_carrera > 1 THEN c.id_carrera
                   ELSE  0 
                    END) as id_carrera
                  
                  FROM persona  p
                  LEFT JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  LEFT JOIN ieu i ON (i.id_ieu = ip.id_ieu)   
                  LEFT JOIN carrera_persona cp ON (cp.cedula = p.cedula) 
                  LEFT JOIN carrera c ON (c.id_carrera = cp.id_carrera) 

                  LEFT JOIN usuario  u ON (u.cedula = p.cedula)   

                   WHERE    
                   
                  p.id_tipo_persona = 3 and 
                  i.id_ieu =" . $data_session['universidad']['id_ieu'] . "
                  ORDER BY p.cedula
                   ";


        //error_log(print_r($query, true));

        $result = $this->db->query($query);



        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }

//   error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_postulaciones_realizadas() {


        $data_session = $this->session->all_userdata();

        $query = "SELECT
                  p.cedula,
                  p.apellido1 || ' ' || p.nombre1 as nombre_apellido,
                  p2.apellido1 || ' ' || p2.nombre1 as nombre_apellido_profesor,
                  i.nombre_ieu,
                  c.id_carrera,
                  c.nombre_carrera,
                  m.id_materia,
                  m.nombre_materia,
                  s.id_seccion,
                  s.nombre as nombre_seccion,
                  to_char(dc.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                  dc.estatus,
                  dc.id_datos_academico
                  
                  FROM persona  p
                  INNER JOIN ieu_persona ip ON (p.cedula = ip.cedula)   
                  INNER JOIN datos_academicos dc ON (p.cedula = dc.cedula)
                  INNER JOIN carrera c ON (c.id_carrera = dc.id_carrera)                  
                  INNER JOIN carrera_persona cp ON (cp.cedula = p.cedula) 

                  INNER JOIN ieu i ON (i.id_ieu = c.id_ieu)   
                 
                  INNER JOIN materia m ON (m.id_materia = dc.id_materia)
                  INNER JOIN seccion s ON (s.id_seccion = dc.id_seccion) 
                  INNER JOIN seccion_materia_profesor smp ON (s.id_seccion = smp.id_seccion)
                  INNER JOIN persona  p2 ON (p2.cedula = smp.cedula)
                  

                  LEFT JOIN usuario  u ON (u.cedula = p.cedula)   

                   WHERE    

                  p.id_tipo_persona = 3 and 
                  i.id_ieu =" . $data_session['universidad']['id_ieu'] . " and
                  ip.estatus = true

                  GROUP BY 
                  
                  p.cedula,
                  p2.apellido1,
                  p2.nombre1,
                  i.nombre_ieu,
                  c.id_carrera,
                   c.nombre_carrera,
                  m.id_materia,
                  m.nombre_materia,
                  s.id_seccion,
                  s.nombre,
                  dc.fecha,
                  dc.estatus,
                  dc.id_datos_academico
                                     ";


        //   error_log(print_r($query, true));

        $result = $this->db->query($query);



        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_datos_academico']] = $row;
            }

//   error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Set_estatus_estudiante($data) {


        $data_session = $this->session->all_userdata();

        $query = " UPDATE  ieu_persona set
              
              estatus = " . $data['estatus'] . "
              where 
              
              cedula =  " . $data['cedula'] . " and
                  
              id_ieu =" . $data_session['universidad']['id_ieu'] . "
                  
                ";


// error_log(print_r($data, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function Set_restablecer_estudiante($data) {


        $this->db->trans_begin();


        $this->db->trans_commit();
        $query = " UPDATE  usuario set
              
               correo_validado =  false,
               nombre_usuario =  '" . $this->strtoupper_intensivo("no-validado") . "'
         
              where 
              
              cedula =  " . $data['cedula'] . "
                  
                ";

// error_log(print_r($query, true));

        $result = $this->db->query($query);


        $query = " delete  from datos_estudiante 
              
              where 
              
              cedula =  " . $data['cedula'] . "
                  
                ";

//  error_log(print_r($query, true));

        $result = $this->db->query($query);


        $query = " delete  from datos_academicos 
              
              where 
              
              cedula =  " . $data['cedula'] . "
                  
                ";

//error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {

            $this->db->trans_commit();

            return true;
        }
    }

    public function Modificar_estudiante($data) {


        $query = " UPDATE  persona set
              
              nombre1 =  '" . $this->strtoupper_intensivo($data['nombre1']) . "',
              nombre2 = '" . $this->strtoupper_intensivo($data['nombre2']) . "',
              apellido1 = '" . $this->strtoupper_intensivo($data['apellido1']) . "',
              apellido2 = '" . $this->strtoupper_intensivo($data['apellido2']) . "',
              genero =  '" . $this->strtoupper_intensivo($data['genero']) . "'

              where 
              
              cedula =  " . $data['cedula'] . "
                  

                ";


// error_log(print_r($query, true));
        $result = $this->db->query($query);
    }

//---------------------------fin estudiante

    public function Get_carreras_ieu($data = false) {


        $data_session = $this->session->all_userdata();

        $ieu = $data == false ? $data_session['universidad']['id_ieu'] : $data['universidad']['id_ieu'];

        $query = "SELECT
                  c.*
                  FROM carrera c
                 where 
                   c.id_ieu =" . $ieu . "
                                   
                  ORDER BY c.nombre_carrera
                  
                ";

//error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Get_carreras_vinculadas($data = false) {


        $data_session = $this->session->all_userdata();

        $ieu = $data == false ? $data_session['universidad']['id_ieu'] : $data['universidad']['id_ieu'];

        $query = "
             SELECT
                  c.*
                  FROM carrera c

                  INNER JOIN materia m ON (c.id_carrera = m.id_carrera)
                  INNER JOIN seccion_materia_profesor smp ON (m.id_materia = smp.id_materia)
                  INNER JOIN carrera_persona cp ON (c.id_carrera = cp.id_carrera)
                  where
                      c.id_ieu =" . $ieu . "
                      and cp.cedula = " . $data_session['cedula'] . "
                      
                  GROUP BY  c.id_carrera,c.nombre_carrera,c.id_ieu
                  ORDER BY c.nombre_carrera
                  
               
                ";

        // error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_carrera']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function Registrar_postulacion($data) {


        $data_session = $this->session->all_userdata();

        $query = " INSERT INTO datos_academicos
              (
               cedula,
               id_materia,
               id_carrera,
               id_seccion,
               fecha
               
              )
              VALUES
              (" . $data_session['cedula'] . ","
                . $data['materia']['id_materia'] . ","
                . $data['carrera']['id_carrera'] . ","
                . $data['seccion']['id_seccion'] . ",now())";

//  error_log(print_r($query, true));


        $result = $this->db->query($query);

        if ($result) {

            $this->session->set_userdata('postulado', true);
        }

        return $result;
    }

    public function Registrar_seccion($data) {


        $data_session = $this->session->all_userdata();

        $query = " INSERT INTO seccion
              (
               nombre,
               id_materia,
               fecha,
               estatus
               
              )
              VALUES
              ('" . $this->strtoupper_intensivo($data['nombre_seccion']) . "',"
                . "" . $data['materia']['id_materia'] . ",now(),true)";

//error_log(print_r($query, true));

        $result = $this->db->query($query);

        return $result;
    }

    public function Registrar_materia($data) {


        $data_session = $this->session->all_userdata();

        $query = " INSERT INTO materia
              (
               nombre_materia,
               id_carrera,
               unidad_credito,
               tipo,
               horas_academicas,
               id_ieu,
               fecha,
               estatus
               
              )
              VALUES
              ('" . $this->strtoupper_intensivo($data['nombre_materia']) . "',"
                . $data['carrera']['id_carrera'] . ","
                . $data['unidades'] . ",'"
                . $data['tipo'] . "',"
                . $data['horas_academicas'] . ","
                . $data_session['universidad']['id_ieu'] . "
                   ,now(),true)";

// error_log(print_r($query, true));

        $result = $this->db->query($query);

        return $result;
    }

    public function Registrar_carrera($data) {


        $data_session = $this->session->all_userdata();

        $query = " SELECT  max(id_carrera) + 1 as max FROM carrera ";

        // error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $maximo = $row['max'];
            }
        }

        if ($maximo) {

            $query = " INSERT INTO carrera
              (
               nombre_carrera,
               id_ieu,
               id_carrera
                
              )
              VALUES
              ('" . $this->strtoupper_intensivo($data['nombre_carrera']) . "',"
                    . $data_session['universidad']['id_ieu'] . ","
                    . $maximo . ")";

            //error_log(print_r($query, true));

            $result = $this->db->query($query);

            return $result;
        }

        return false;
    }

    public function Modificar_carrera($data) {




        $query = " update  carrera set 
              
               nombre_carrera = '" . $this->strtoupper_intensivo($data['nombre_carrera']) . "'
                
                  where id_carrera =" . $data['id_carrera'];

        //error_log(print_r($query, true));

        $result = $this->db->query($query);

        return $result;
    }

    public function Modificar_materia($data) {


        $data_session = $this->session->all_userdata();



        $query = " update materia set
              
               nombre_materia = '" . $this->strtoupper_intensivo($data['nombre_materia']) . "',
               id_carrera = " . $data['carrera']['id_carrera'] . ",
               unidad_credito = " . $data['unidades'] . ",
               tipo = '" . $data['tipo'] . "',
               horas_academicas = " . $data['horas_academicas'] . ",
               id_ieu = " . $data_session['universidad']['id_ieu'] . ",
               fecha = now(),
               estatus = true 
               
               where 
                id_materia = " . $data['id_materia'];

//    error_log(print_r($query, true));

        $result = $this->db->query($query);

        return $result;
    }

    public function Modificar_carrera_estudiante($data) {


        $data_session = $this->session->all_userdata();



        $query = "SELECT
                  cedula
                  FROM carrera_persona 
                 where 
                   cedula =" . $data['cedula'] . "
                                                     
                ";

        //error_log(print_r($query, true));
//error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            $query = " update carrera_persona set
              
               id_carrera = " . $data['carrera']['id_carrera'] . ",
               id_ieu = " . $data_session['universidad']['id_ieu'] . "
               where 
               cedula = " . $data['cedula'];

            // error_log(print_r($query, true));

            $result = $this->db->query($query);
        } else {


            $query = " INSERT INTO carrera_persona
              (
               cedula,
               id_carrera,
               id_ieu
             
              )
              VALUES
              (" . $data['cedula'] . ","
                    . $data['carrera']['id_carrera'] . ","
                    . $data_session['universidad']['id_ieu'] . ")";

            //error_log(print_r($query, true));

            $result = $this->db->query($query);
        }

        return $result;
    }

    public function Get_secciones() {

        $data_session = $this->session->all_userdata();

        $query = " 
            
 SELECT s.*,
                    s.estatus as activo,
                    m.nombre_materia,
                    to_char(s.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                    m.nombre_materia,
                    c.nombre_carrera


                    FROM seccion s
                    INNER JOIN materia m ON (s.id_materia = m.id_materia)  
                    INNER JOIN carrera c ON (c.id_carrera = m.id_carrera)  

                  where 
                   m.id_ieu =" . $data_session['universidad']['id_ieu'] . " 
              
                 ORDER BY s.nombre ASC

               ";

//error_log(print_r($query, true));


        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_seccion']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_secciones_profesor() {

        $data_session = $this->session->all_userdata();

        $query = " 
            
                SELECT s.*,
                    s.nombre || ' - ' || p.apellido1 || ' ' || p.nombre1 as seccion_profesor,
                    p.apellido1 || ' ' || p.nombre1 as nombre_profesor,
                    s.estatus as activo,
                    m.nombre_materia,
                    to_char(s.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                    m.nombre_materia


                  FROM seccion s
                  
                  INNER JOIN seccion_materia_profesor smp ON (s.id_seccion = smp.id_seccion)
                  INNER JOIN persona p ON (p.cedula = smp.cedula)

                    INNER JOIN materia m ON (s.id_materia = m.id_materia)   

                  where 
                   m.id_ieu =" . $data_session['universidad']['id_ieu'] . " 
              
                 ORDER BY s.nombre ASC

               ";

        //  error_log(print_r($query, true));


        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_seccion']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_materias() {

        $data_session = $this->session->all_userdata();


        $query = " SELECT m.*,
                    m.estatus as activo,
                    to_char(m.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                    c.nombre_carrera

                    FROM materia m
                    INNER JOIN carrera c ON (m.id_carrera = c.id_carrera)   

          
                 where 
                        m.id_ieu =" . $data_session['universidad']['id_ieu'] . " 
              
                 ORDER BY m.nombre_materia ASC
               ";

// error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_materia_id($data) {

        $data_session = $this->session->all_userdata();


        $query = " SELECT m.*,
                    m.estatus as activo,
                    to_char(m.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha,
                    c.nombre_carrera

                    FROM materia m
                    INNER JOIN carrera c ON (m.id_carrera = c.id_carrera)   

          
                 where 
                        m.id_ieu =" . $data_session['universidad']['id_ieu'] . "
                        AND m.id_materia = " . $data['id_materia'] . "
              
                 ORDER BY m.nombre_materia ASC
               ";

        // error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_materias_vinculadas_disponibles($data) {

        $data_session = $this->session->all_userdata();


        $query = "
            
 SELECT              
                    m.*,
                    m.estatus as activo,
                    to_char(m.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha

                  FROM carrera c
                  
                  INNER JOIN materia m ON (c.id_carrera = m.id_carrera)
                  INNER JOIN seccion_materia_profesor smp ON (m.id_materia = smp.id_materia)


                  where
                       c.id_ieu = " . $data['universidad']['id_ieu'] . "
                     and c.id_carrera = " . $data['carrera']['id_carrera'] . " 
                         
                    GROUP BY  
                   m.id_materia,
                   m.nombre_materia,
                   m.unidad_credito,
                   m.tipo,
                   m.horas_academicas,
                   m.estatus,
                   m.estatus,
                   m.fecha,
                   m.id_ieu,m.duracion
                      
                  ORDER BY m.nombre_materia ASC
                  
               ";

        //  error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_materia']] = $row;
            }
// error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_secciones_vinculadas_disponibles($data) {




        $data_session = $this->session->all_userdata();


        $query = "
            


                  
                   SELECT 
                    smp.cedula,
                    p.nombre1 || ' ' ||  p.apellido1 as nombre_persona,
                    s.*,
                    s.estatus as activo,
                    c.nombre_carrera,
                    to_char(s.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha

                  FROM carrera c
                  
                   
                  INNER JOIN materia m ON (c.id_carrera = m.id_carrera)
                  INNER JOIN seccion_materia_profesor smp ON (m.id_materia = smp.id_materia)
                  INNER JOIN seccion s ON (s.id_seccion = smp.id_seccion)

                  INNER JOIN persona p ON (p.cedula = smp.cedula)


                  where
                     c.id_ieu = " . $data['universidad']['id_ieu'] . "
                     and c.id_carrera = " . $data['carrera']['id_carrera'] . " 
                      and m.id_materia = " . $data['materia']['id_materia'] . "
                  ORDER BY s.nombre ASC
                  
               ";


        //   error_log(print_r($query, true));
        // error_log(print_r($data, true));


        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_seccion']] = $row;
            }

            //   error_log(print_r($params, true));
// error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Set_estatus_seccion($data) {


        $query = " UPDATE  seccion set
              
              estatus = " . $data['estatus'] . "
              where 
              
              id_seccion =  " . $data['id_seccion'] . "
                  

                ";




//  error_log(print_r($query, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function Set_estatus_materia($data) {


        $query = " UPDATE  materia set
              
              estatus = " . $data['estatus'] . "
              where 
              
              id_materia =  " . $data['id_materia'] . "
                  

                ";


//   error_log(print_r($query, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function Set_estatus_postulacion($data) {


        $query = " UPDATE  datos_academicos set
              
              estatus = " . $data['estatus'] . "
              where 
              
              id_datos_academico =  " . $data['id'] . "
                  

                ";


        // error_log(print_r($data, true));
        $result = $this->db->query($query);


        if ($result) {

            return true;
        } else {

            return false;
        }
    }

    public function Get_profesores_sin_vinculacion() {

        $data_session = $this->session->all_userdata();


        $query = "select 
                        p.*  
                    from 
                        persona p
                        inner join ieu_persona ip on (p.cedula = ip.cedula)

                    where
                        p.id_tipo_persona = 4 and
                        ip.id_ieu =" . $data_session['universidad']['id_ieu'] . "  and 
                        ip.estatus <> false
                        
    
              
                 ORDER BY cedula ASC
               ";

//error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['cedula']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_secciones_disponibles($data) {

        $data_session = $this->session->all_userdata();

        $query = "
                   SELECT s.*,
                    s.estatus as activo,
                    m.nombre_materia,
                    to_char(s.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha

                    FROM seccion s
                    INNER JOIN materia  m ON (s.id_materia = m.id_materia)   

                    where 
                        m.id_ieu =" . $data_session['universidad']['id_ieu'] . "
                       and s.id_materia = " . $data['materia']['id_materia'] . "
                       and s.estatus = true
                          and s.id_seccion not in (
                        select smp.id_seccion
                        from seccion_materia_profesor smp
                        
                          where
                         smp.id_materia = " . $data['materia']['id_materia'] . "
                        group by smp.id_seccion
                     
                           )
                  
                            
                 ORDER BY s.nombre ASC
                 
               ";
        // error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_seccion']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_materias_disponibles_vinculadas($data) {

        $data_session = $this->session->all_userdata();

        $query = "
            
            SELECT m.*,
                    m.estatus as activo,
                    to_char(m.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha

                    FROM materia m
                    INNER JOIN seccion s ON (s.id_materia = m.id_materia) 

                  
                 where 
                       
                        m.id_ieu =" . $data_session['universidad']['id_ieu'] . " 
                        and m.id_carrera = " . $data['carrera']['id_carrera'] . "
                        and  m.estatus = true
                        
                    
                 ORDER BY m.nombre_materia ASC
     
                 
               ";

//error_log(print_r($query, true));
//error_log(print_r($data, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_materia']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_materias_disponibles($data) {

        $data_session = $this->session->all_userdata();

        $query = "
            
            SELECT m.*,
                    m.estatus as activo,
                    to_char(m.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha

                    FROM materia m
                    left join  seccion s ON (s.id_materia = m.id_materia) 

                  
                 where 
                       
                        m.id_ieu =" . $data_session['universidad']['id_ieu'] . " 
                        and m.id_carrera = " . $data['carrera']['id_carrera'] . "
                        and  m.estatus = true

                        
                        
                    
                      
                 ORDER BY m.nombre_materia ASC
     
                 
               ";

//error_log(print_r($query, true));
//error_log(print_r($data, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_materia']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Registrar_profesor_vincular($data) {

        $this->db->trans_begin();


        $query = " INSERT INTO seccion_materia_profesor
              (
               id_materia,
               id_seccion,
               cedula,
               fecha
               
              )
              VALUES
              (" . $data['materia']['id_materia'] . ","
                . $data['seccion']['id_seccion'] . ","
                . $data['profesor']['cedula'] . ",now())";

//  error_log(print_r($query, true));

        $result = $this->db->query($query);

        $query = " UPDATE  materia set
              
              duracion = '" . $data['duracion'] . "'
              where 
              
              id_materia =  " . $data['materia']['id_materia'] . "
                  

                ";

// error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return false;
        } else {

            $this->db->trans_commit();

            return true;
        }
    }

    public function Get_vincular_profesor($data) {

        $data_session = $this->session->all_userdata();

        $query = "
          SELECT 
                    smp.id_seccion_materia,
                    p.cedula,
                    p.nombre1,
                    p.apellido1,
                    s.nombre as nombre_seccion,
                    m.nombre_materia,
                    m.id_materia,
                    c.nombre_carrera,
                    c.id_carrera,
                    m.duracion,
                    s.id_seccion, 
                    (CASE
                                       WHEN
                                              ( SELECT da.id_seccion
                                               FROM datos_academicos da
                                               WHERE m.id_materia = da.id_materia
                                                 AND s.id_seccion = da.id_seccion
                                               GROUP BY da.id_seccion ) > 1 THEN FALSE
                                       ELSE TRUE
                                   END) as desvincular,
                    
                    to_char(smp.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha
                    
              
                   FROM seccion_materia_profesor smp
                  INNER JOIN persona p ON (p.cedula = smp.cedula) 
                  INNER JOIN seccion s ON (s.id_seccion = smp.id_seccion) 
                  INNER JOIN materia m ON (m.id_materia = smp.id_materia) 
                  INNER JOIN carrera c ON (c.id_carrera = m.id_carrera) 
                  
                  where 
                  
                        m.id_ieu =" . $data_session['universidad']['id_ieu'] . "


                                 
                 ORDER BY smp.cedula ASC
     
                 
               ";


        //  error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_seccion_materia']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Get_vincular_profesor_id($data) {

        $data_session = $this->session->all_userdata();

        $query = "
            
           SELECT 
                    smp.id_seccion_materia,
                    p.cedula,
                    p.nombre1,
                    p.apellido1,
                    s.nombre as nombre_seccion,
                    m.nombre_materia,
                    c.nombre_carrera,
                     m.duracion,
                    
                    to_char(smp.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha
                    
              
                    FROM seccion_materia_profesor smp
                  INNER JOIN persona p ON (p.cedula = smp.cedula) 
                  INNER JOIN seccion s ON (s.id_seccion = smp.id_seccion) 
                  INNER JOIN materia m ON (m.id_materia = smp.id_materia) 
                  INNER JOIN carrera c ON (c.id_carrera = m.id_carrera) 

                                 
                 ORDER BY smp.cedula ASC
     
                 
               ";


//  error_log(print_r($query, true));

        $result = $this->db->query($query);


        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[$row['id_seccion_materia']] = $row;
            }
//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }

// error_log(print_r($query, true));
    }

    public function Modificar_vinculacion($data) {


        $query = " UPDATE  seccion_materia_profesor set
              
              cedula =  " . $data['profesor']['cedula'] . "
         
              where 
              
              id_seccion_materia =  " . $data['id_seccion_materia'] . "
                  

                ";


//  error_log(print_r($data, true));
        return $result = $this->db->query($query);
    }

    public function Desvincular_profesor($data) {


        $query = " DELETE FROM   seccion_materia_profesor 
                        
       
              where 
              
              id_seccion_materia =  " . $data['id_seccion_materia'] . "
                  

                ";


// error_log(print_r($data, true));
        return $result = $this->db->query($query);
    }

    public function Eliminar_postulacion($data) {


        $query = " DELETE FROM   datos_academicos 
                        
       
              where 
              
              id_datos_academico =  " . $data['id_datos_academico'] . "
                  

                ";


// error_log(print_r($data, true));
        return $result = $this->db->query($query);
    }

    public function Cambiar_clave($data) {

        $data_session = $this->session->all_userdata();

        $clave = crypt($data['clave_actual'], $this::$SEMILLA);
        $usuario = $data_session['correo'];


        $query = "select 
            p.*,
            u.id_perfil,
            pf.nombre_perfil
                from persona p
                inner join usuario u  on(u.cedula = p.cedula)
                inner join perfil pf  on(u.id_perfil = pf.id_perfil)
                where  
                upper(u.nombre_usuario) = '" . $this->strtoupper_intensivo($usuario) . "' AND
                u.clave =  '" . $clave . "'  AND
                u.activo = true

                ";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {
            foreach ($result->result_array() as $row) {

                $param['sistem'] = $row;
                $clave = crypt($data['clave_nueva'], $this::$SEMILLA);


                $query = " UPDATE  usuario set
              
              clave =  '" . $clave . "'
         
              where 
              
              cedula =  " . $data_session['cedula'] . "
                  
                ";


                $result = $this->db->query($query);



                if (!$result) {

                    return false;
                }


                $data = $param['sistem'];

// error_log(print_r($data, true));


                $nom = "MPPEUCT(Intensivos)";
                $dir = $data['correo_ppal'];
                $asunto = "Modificación de Comntraseña en el Sistema de Intensivos.";
                $mensaje = '<p><span style="font-family: Arial; font-size: '
                        . '14px; line-height: 1.2;"><b>Profesor(a) ' . $data['nombre1'] . ' ' . $data['apellido1'] . '</b><br><br> Se le informa que fue modificada su  contraseña en el <b>Sistema de Intensivos 2016</b>,'
                        . '&nbsp; para ingresar por favor vaya a la página: <a href="http://intensivos.mppeuct.gob.ve/"> http://intensivos.mppeuct.gob.ve/</a>  &nbsp;<br><br> Usuario : ' . $data['correo_ppal'] . ' <br> <br>  <b>Si usted no ha modificado la contraseña, por favor contactar al Responsable I.E.U.</b></p>';

                $result = self::Enviar_correo($nom, $dir, $asunto, $mensaje);
            }
        } else {

            return false;
        }
    }

    public function Datos_postulacion() {

        $data_session = $this->session->all_userdata();

        $query = "select 
                  p.cedula,
                  p.nombre1 || ' ' ||p.apellido1 as nombre_completo,
                  p.correo_ppal,
                  s.nombre as nombre_seccion,
                  m.nombre_materia,
                  c.nombre_carrera,
                  i.nombre_ieu,
                  to_char(da.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha
                  
                  
                  
                from datos_academicos da
                  INNER JOIN persona p ON (p.cedula = da.cedula) 
                  INNER JOIN seccion s ON (s.id_seccion = da.id_seccion) 
                  INNER JOIN carrera c ON (c.id_carrera = da.id_carrera) 
                  INNER JOIN ieu i ON (c.id_ieu = i.id_ieu) 
                  
                  INNER JOIN materia m ON (m.id_materia = da.id_materia) 
                                 
           
                where  
                p.cedula = " . $data_session['cedula'];

//  error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            foreach ($result->result_array() as $row) {

                return $row;
            }
        } else {

            return false;
        }
    }

    public function Get_postulaciones() {

        $data_session = $this->session->all_userdata();

        $query = "select 
                  da.id_datos_academico,
                  da.estatus,
                  p.cedula,
                  p.nombre1 || ' ' ||p.apellido1 as nombre_completo,
                  p.correo_ppal,
                  s.nombre as nombre_seccion,
                  m.nombre_materia,
                  c.nombre_carrera,
                  i.nombre_ieu,
                  to_char(da.fecha, 'DD-MM-YYYY HH24:mm:ss') AS fecha
                  
                  
                  
                from datos_academicos da
                  INNER JOIN persona p ON (p.cedula = da.cedula) 
                  INNER JOIN seccion s ON (s.id_seccion = da.id_seccion) 
                  INNER JOIN carrera c ON (c.id_carrera = da.id_carrera) 
                  INNER JOIN ieu i ON (c.id_ieu = i.id_ieu) 
                  
                  INNER JOIN materia m ON (m.id_materia = da.id_materia) 
                                 
           
                where  
                p.cedula = " . $data_session['cedula']
                . "    and i.id_ieu in (
				select 
				   id_ieu 
				   
				from 
				   ieu_persona 
				   
				where  
				   cedula =  " . $data_session['cedula'] . "
				   and estatus = true
				   )
                                   
               and  da.cedula =  " . $data_session['cedula'] . "";

//error_log(print_r($query, true));

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {


            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            return $params;
        } else {

            return false;
        }
    }

    // ------------------------------------------------ nuevo reportes ------------------->


    public function reporte_cantidad_estudiante_ieu() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_estudiantes_registrados_validado_postulado_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_docente_ieu() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_docentes_registrados_vinculados";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_estudiante_carrera_ieu() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_estudiante_carrera_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

//  error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidades_personas_tipo() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidades_personas_tipo";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_estudiantes_sin_ieu() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_estudiantes_sin_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_estudiantes_sin_carrera() {

//$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_estudiantes_sin_carrera";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_docentes_sin_ieu() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_docentes_sin_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_en_ieupersona_y_no_en_persona() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_en_ieupersona_y_no_en_persona";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_en_carrerapersona_y_no_en_persona() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_en_carrerapersona_y_no_en_persona";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_estudiantes_validado_ieu() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_estudiantes_validado_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_estudiantes_validado_postulado_ieu() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_estudiantes_validado_postulado_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_cantidad_carreras_materias_secciones_por_ieu() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_cantidad_carreras_materias_secciones_por_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte_todas_carreras_materias_secciones_por_ieu() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_todas_carreras_materias_secciones_por_ieu";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte1_para_el_calculo() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte1_para_el_calculo";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    public function reporte2_para_el_calculo() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte2_para_el_calculo";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }
    
      public function reporte3_para_el_calculo() {

        //$this->global->

        $query = "
                SELECT
                    *
                FROM
                    reporte_para_pago";

        $result = $this->db->query($query);

        if ($result->num_rows() > 0) {

            foreach ($result->result_array() as $row) {

                $params[] = $row;
            }

            //error_log(print_r($params, true));

            return $params;
        } else {

            return false;
        }
    }

    // ------------------------------------------------ nuevo reportes fin------------------->
}

//04120888487
?>

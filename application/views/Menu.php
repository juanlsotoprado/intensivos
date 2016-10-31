
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top barra-top " style="margin-bottom: 0;">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Sistema de Itensivos 2016</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php if ($user_sesion['id_perfil'] == 1 || $user_sesion['id_perfil'] == 2 || $user_sesion['id_perfil'] == 4) { ?>
            <em class="navbar-brand" > <b style="color: #a3303d;" class=" fa fa-institution"></b>&nbsp; Ministerio del Poder Popular para Educación Universitaria, Ciencia y Tecnología &nbsp;

            <?php } else { ?>

                <em class="navbar-brand" > <b style="color: #a3303d;" class=" fa fa-institution"></b>&nbsp; <?php echo $user_sesion['ieu']; ?> &nbsp;

                <?php } ?>
            </em><br>
            </div>
            <!-- /.navbar-header -->

            <ul  class="nav navbar-top-links navbar-right">


                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"  >
                        <i class="fa fa-user fa-fw top-barra"></i><i class="fa fa-caret-down"></i> &nbsp; <?php echo $user_sesion['usuario']; ?><em>&nbsp;<b>( <?php echo $user_sesion['nombre_perfil']; ?> )</em> </b>
                    </a>


                    <ul  style="width: 100%" class="dropdown-menu dropdown-user">
                        <?php if ($user_sesion['id_perfil'] == 3 || $user_sesion['id_perfil'] == 4) { ?>
                            <li>
                                <a href="#/Cambiar_clave" class='{{ liActive == "/Cambiar_clave"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Cambiar Contraseña </a>
                            </li>
                            <li class="divider"></li>

                        <?php } ?>
                        <li><a href="<?php echo base_url('index.php/Login/Cerrar'); ?>" style="text-decoration:underline;"><b><i class="fa fa-sign-out fa-fw" ></i>Cerrar sesión</b></a>
                        </li>
                    </ul>




                    <!-- /.dropdown-user -->
                </li>

                <!-- /.dropdown -->
            </ul>

            <!-- /.navbar-top-links -->
            <br>

            <div  style="background-color: white" class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav " id="side-menu">

                        <?php if ($user_sesion['id_perfil'] == 1) { ?>

                            <!--                    <li style="border-top:  #8c8182  1px solid;">
                                                    <a href="#/Funcionario_mppeuct" class='{{ liActive == "/Funcionario_mppeuct"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;Funcionarios MPPEUCT</a>
                             </li>-->

                        <?php } ?>

                        <?php if ($user_sesion['id_perfil'] == 1 || $user_sesion['id_perfil'] == 2) { ?>

                            <li >
                                <a href="#/Registar_responsable" class='{{ liActive == "/Registar_responsable"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Registar Responsable IEU</a>

                            </li>

                            
                            
                            <li >
                                <a href="#/Gestionar_responsable" class='{{ liActive == "/Gestionar_responsable"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Gestionar Responsables IEU</a>

                            </li>
                            
                            <li>
                                <a href="#/Reportes" class='{{ liActive == "/Reportes"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Reportes</a>
                            </li>

                        <?php } ?>

                        <?php if ($user_sesion['id_perfil'] == 3) { ?>

                            <li>
                                <a href="javascript:void(0)"  class='{{ 
                                            
                                                                    liActive == "/Descarga_de_archivo" ||
                                                                    liActive == "/Instructivo" ||
                                                                    liActive == "/Oficio" 
                                                                    
            
                                                                    ? "active":"" }}'><i class="fa fa-caret-right"></i>&nbsp;Ayudas<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" >

                                    <!--                                    <li>
                                                                            <a href="#/Descarga_de_archivo" class='{{ liActive == "/Descarga_de_archivo"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Información y descarga de archivos</a>
                                                                        </li>-->
                                    <li>
                                        <a href="#/Instructivo" class='{{ liActive == "/Instructivo"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Instructivo</a>
                                    </li>
                                    <li>
                                        <a href="#/Oficio" class='{{ liActive == "/Oficio"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Oficio primer avance a las IEU</a>
                                    </li>
                                </ul>

                            </li>

                            <li>
                                <a href="#/Administrar_postulaciones" class='{{ liActive == "/Administrar_postulaciones"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Administrar 
                                    postulaciones</a>

                            </li>
                            <li>
                                <a href="javascript:void(0)"  class='{{ liActive == "/Administrar_seccion" ||  liActive == "/Vincular_profesor"? "active":"" }}'><i class="fa fa-caret-right"></i>&nbsp;Sección<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" >
                                    <li>
                                        <a href="#/Administrar_seccion" class='{{ liActive == "/Administrar_seccion"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Gestionar Sección </a>

                                    </li>
                                    <li>
                                        <a href="#/Vincular_profesor" class='{{ liActive == "/Vincular_profesor"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Vincular Profesor</a>

                                    </li>

                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="javascript:void(0)"  class='{{ liActive == "/Agregar_profesor" ||
                                                                                                                        liActive == "/Administrar_profesores" ||
                                                                                                                        liActive == "/Agregar_estudiante" ||
                                                                                                                        liActive == "/Administrar_estudiantes" ||
                                                                                                                        liActive == "/Administrar_materias" ||
                                                                                                                         liActive ==  "Administrar_carreras"
                                                                                                                   ? "active":"" }}'><i class="fa fa-caret-right"></i>&nbsp;Administración<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse" >

                                    <li>
                                        <a href="javascript:void(0)"  class='{{ liActive == "/Agregar_profesor" ||  liActive == "/Administrar_profesores" || liActive == "/materia_profesor"? "active":"" }}' ><i class="fa fa-caret-right"></i> Gestionar Profesores<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level collapse" >
                                            <li>
                                                <a href="#/Agregar_profesor" class='{{ liActive == "/Agregar_profesor"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Agregar</a>

                                            </li>
                                            <li>
                                                <a href="#/Administrar_profesores" class='{{ liActive == "/Administrar_profesores"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Administrar</a>

                                            </li>

                                        </ul>
                                        <!-- /.nav-second-level -->
                                    </li>

                                    <li>
                                        <a href="javascript:void(0)"  class='{{ liActive == "/Agregar_estudiante" ||
                                                                                                                                liActive == "/Administrar_estudiantes"  ? "active":"" }}'><i class="fa fa-caret-right"></i> Gestionar Estudiantes<span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level collapse" >
                                            <li>
                                                <a href="#/Agregar_estudiante" class='{{ liActive == "/Agregar_estudiante"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Agregar</a>

                                            </li>
                                            <li>
                                                <a href="#/Administrar_estudiantes" class='{{ liActive == "/Administrar_estudiantes"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Administrar </a>

                                            </li>


                                        </ul>
                                        <!-- /.nav-second-level -->
                                    </li>

                                    <li>
                                        <a href="#/Administrar_materias" class='{{ liActive == "/Administrar_materias"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Gestionar Materias </a>

                                    </li>
                                    
                                     <li>
                                        <a href="#/Administrar_carreras" class='{{ liActive == "/Administrar_carreras"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Gestionar Carreras </a>

                                    </li>


                                </ul>
                                <!-- /.nav-second-level -->
                            </li>


                        <?php } ?>

                        <?php if ($user_sesion['id_perfil'] == 4) { ?>


                            <li>
                                <a href="#/Postulacion" class='{{ liActive == "/Postulacion"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Postulación</a>

                            </li>



                            <!--                <li>
                                                <a href="#/Reportes" class='{{ liActive == "/Reportes"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Reportes</a>
                                            </li>-->
                            <!--
                                            <li>
                                                <a href="#/Cambiar_contraseña_MPPEUCT" class='{{ liActive == "/Cambiar_contraseña_MPPEUCT"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Cambiar contraseña</a>
                                            </li>-->
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            <?php } ?>
            </nav>

            <div  id="page-wrapper" >



<!-- Navigation -->


<nav class="navbar navbar-default navbar-static-top barra-top " style="margin-bottom: 0;">

    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Sistema de Itensivos universitarios</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <em class="navbar-brand"> <b style="color: #a3303d" class=" fa fa-institution"></b>&nbsp; Sistema de Itensivos universitarios &nbsp;</em>
    </div>
    <!-- /.navbar-header -->

    <ul  class="nav navbar-top-links navbar-right">


        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown"  >
                <i class="fa fa-user fa-fw top-barra"></i><i class="fa fa-caret-down"></i> &nbsp; <?php echo $user_sesion['usuario']; ?><em>&nbsp;<b>( <?php echo $user_sesion['nombre_perfil']; ?> )</em> </b>
            </a>


            <ul  style="width: 100%" class="dropdown-menu dropdown-user">

                <li><a href="<?php echo base_url('index.php/Login/Cerrar'); ?>" style="text-decoration:underline;"><b><i class="fa fa-sign-out fa-fw" ></i>Cerrar sesión</b></a>
                </li>
            </ul>


            <!-- /.dropdown-user -->
        </li>

        <!-- /.dropdown -->
    </ul>

    <!-- /.navbar-top-links -->
    <br>
    
    <?php if ($user_sesion['id_perfil'] != 3) { ?>
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
                        <a href="#/Registar_responsable" class='{{ liActive == "/Registar_responsable"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Registar responsable IEU</a>

                    </li>

                    <li >
                        <a href="#/Gestionar_responsable" class='{{ liActive == "/Gestionar_responsable"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Gestionar responsables IEU</a>

                    </li>

                <?php } ?>

                <?php if ($user_sesion['id_perfil'] == 3) { ?>

                    <li >
                        <a href="#/Descarga_de_archivo" class='{{ liActive == "/Descarga_de_archivo"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Informacion y descarga de archivos</a>

                    </li>

                    <li >
                        <a href="javascript:void(0)"  class='{{ liActive == "/Agregar_profesor" ||  liActive == "/Administrar_profesores" || liActive == "/materia_profesor"? "active":"" }}' ><i class="fa fa-caret-right"></i> Gestionar profesores<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" >
                            <li>
                                <a href="#/Agregar_profesor" class='{{ liActive == "/Agregar_profesor"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Agregar</a>

                            </li>
                            <li>
                                <a href="#/Administrar_profesores" class='{{ liActive == "/Administrar_profesores"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Administrar </a>

                            </li>
                            <li>
                                <a href="#/materia_profesor" class='{{ liActive == "/materia_profesor"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Vincular materias</a>


                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>

                    <li>
                        <a href="javascript:void(0)"  class='{{ liActive == "/Administrar_estudiantes" ||  liActive == "/Agregar_estudiante"? "active":"" }}'><i class="fa fa-caret-right"></i> Gestionar estudiantes<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" >
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
                        <a href="javascript:void(0)"  class='{{ liActive == "/Agregar_seccion" ||  liActive == "/Administrar_seccion"? "active":"" }}'><i class="fa fa-caret-right"></i> Gestionar sección<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" >
                            <li>
                                <a href="#/Agregar_seccion" class='{{ liActive == "/Agregar_seccion"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Agregar</a>

                            </li>
                            <li>
                                <a href="#/Administrar_seccion" class='{{ liActive == "/Administrar_seccion"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Administrar </a>

                            </li>


                        </ul>
                        <!-- /.nav-second-level -->
                    </li>


                    <li>
                        <a href="javascript:void(0)"  class='{{ liActive == "/Agregar_materia" ||  liActive == "/Administrar_materias"? "active":"" }}'><i class="fa fa-caret-right"></i> Gestionar materias<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" >
                            <li>
                                <a href="#/Agregar_materia" class='{{ liActive == "/Agregar_materia"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Agregar</a>

                            </li>
                            <li>
                                <a href="#/Administrar_materias" class='{{ liActive == "/Administrar_materias"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Administrar </a>

                            </li>


                        </ul>
                        <!-- /.nav-second-level -->
                    </li>



                <?php } ?>

                <?php if ($user_sesion['id_perfil'] == 4) { ?>


                    <li>
                        <a href="#/Postulacion" class='{{ liActive == "/Postulacion"? "active":"" }}'><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;Postulación</a>

                    </li>

                <?php } ?>


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


    <?php if ($user_sesion['id_perfil'] != 3) { ?>
        <div  id="page-wrapper" >

    <?php } else { ?>

        <div  id="page-wrapper" style=" position: inherit;padding: 0 30px;margin: 0;border-left:0; " >

    <?php } ?>

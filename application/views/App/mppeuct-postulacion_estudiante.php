<br>


            <blockquote>
                <h4>
                    <em >
                        <b style="text-decoration: underline;color: #555;"> Información: </b>
                        <br><br>
                        <span  style="color: #777;text-align: center"> Si no se muestran <b>carreras</b> debe informar a su <b>representante IEU</b> para que las registre en el sitema.</span>
                    </em>
                </h4>

            </blockquote>




    <form id="solicitante_form" method="post" name="Form_postulacion"
          class="form-horizontal inicio">





        <div class="panel panel-primary">

            <div class="panel-heading">
                <h4>Postularse a un Intensivo </h4>
            </div>
            <div class="panel-body">


                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">I.E.U.:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">

                        <select ng-change="carreras(formData.universidad)" ng-options="data as data.nombre_ieu for data in datos_registro.universidades track by data.id_ieu" ng-model="formData.universidad" class="form-control" id="destino_form"  name="universidad" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if="Form_postulacion.$dirty && Form_postulacion.universidad.$error.required">Campo Requerido</span>

                    </div>
                </div>

                <div class="form-group animated fadeIn" >
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">

                        <select  ng-change="buscar_materias(formData.carrera)" ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData.carrera" class="form-control" id="destino_form"  name="carrera" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if=" Form_postulacion.carrera.$error.required">Campo Requerido</span>
                    </div>
                </div>

                <div class="form-group animated fadeIn" >
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Materias:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">

                        <select  ng-change="secciones(formData.materia)"  ng-options="data as data.nombre_materia for data in datos_registro.materias track by data.id_materia" ng-model="formData.materia" class="form-control" id=""  name="materia" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if=" Form_postulacion.materia.$error.required">Campo Requerido</span>

                    </div>
                </div>

                <div  class="form-group animated fadeIn" >
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Sección:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">

                        <select   ng-options="data as data.nombre +' - '+ data.nombre_persona for data in datos_registro.secciones track by data.id_seccion" ng-model="formData.seccion" class="form-control" id=""  name="seccion" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if=" Form_postulacion.seccion.$error.required">Campo Requerido</span>

                    </div>
                </div>

            </div>
            <div class="panel-footer">


                <div class="form-group">
                    <div id="botoms" class=" col-xs-12  " style="text-align: center;">


                        <button   ng-click="formData = {}"  type="button" class="submit btn 

                                  btn-success

                                  ">
                            Limpiar   

                        </button>


                        <button  ng-click="Form_postulacion.$valid

                                    ? registrar(formData) : ''" 

                                 ng-class="Form_postulacion.$valid
                                             ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>

                    </div>

                </div>

            </div>

        </div>
    </form>

    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Postulaciones Realizadas</h4>
        </div>
        <div class="panel-body">
            <fieldset style="text-align: left;">

                <div class="table-responsive">          
                    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                        <col style="width: 2%">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th>I.E.U.</th>
                                <th>Carrera</th>
                                <th>Materia</th>
                                <th>Sección</th>
                                <th>Fecha</th>


                                <th style="min-width: 90px">Acción</th>

                            </tr>
                        </thead>

                        <tbody class="table_bandeja_apro_tbody">
                            <tr ng-repeat="(y,x) in busqueda.postulaciones" >
                                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                <td>{{x.nombre_ieu}}</td>
                                <td>{{x.nombre_carrera}}</td>
                                <td>{{x.nombre_materia}}</td>
                                <td>{{x.nombre_seccion}}</td>
                                <td>{{x.fecha}}</td>
                                <td  style="text-align: center;width: 200px;">

                                    <b ng-if="x.estatus == 't'" class="text-success"> Postulación aceptada </b>

                                    <b ng-if="x.estatus != 't' && x.estatus != 'f'" class="text-info"> En espera por aprobación
                                        <br> <hr>
                                    </b>

                                    <button ng-if="x.estatus != 't' && x.estatus != 'f'" ng-click="eliminar(x.id_datos_academico)" href="javascript:void(0)" class="btn  btn-xs btn-danger "><i class="fa fa-close fa-1x" aria-hidden="true"></i>Eliminar<div class="ripple-container"></div></button>

                                    <b ng-if="x.estatus == 'f'" class="text-danger"> Postulación Rechazada</b>


                                </td>




                            </tr>
                        </tbody>
                    </table>
                </div>

            </fieldset>

        </div>
    </div>


<br>
<!-- /.row -->
<div class="row animated fadeIn">


    <div class="panel panel-info">
        <div class="panel-body">
            <br>
            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cantidad maxima de registros:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select  ng-change="cantidad(registro_total, formData.cantidad_reg, formData.carrera)"   ng-model="formData.cantidad_reg" class="form-control" id="destino_form"  name="cantidad" >
                        <option value="" ng-selected="true">100</option>
                        <option value="1000">1000</option>
                        <option value="3000">3000</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="20000">20000</option>
                        <option value="50000">50000</option>
                        <option value="100000">Mas de 50000</option>

                    </select>

                </div>
            </div>
            <br>    
            <br>

            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carreras:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData.carrera" class="form-control" id="destino_form"  name="carrera" required>
                        <option value=""><-- Seleccione una opción --></option>

                    </select>

                </div>
            </div>

            <br>
            <br>

            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Materias:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select  ng-options="data as data.nombre_materia for data in datos_registro.materias track by data.id_materia" ng-model="formData.materia" class="form-control" id="destino_form"  name="materia" required>
                        <option value=""><-- Seleccione una opción --></option>
                    </select>
                </div>
            </div>
            <br>    
            <br>

            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Sección:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select  ng-options="data as data.seccion_profesor for data in datos_registro.secciones track by data.id_seccion" ng-model="formData.seccion" class="form-control" id=""  name="carrera" required>
                        <option value=""><-- Seleccione una opción --></option>

                    </select>

                </div>
            </div>   
            <br>    
            <br>

        </div>

    </div>


    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Administrar Postulaciones</h4>
        </div>
        <div class="panel-body" style="text-align: center">

            <h3 ng-hide="mostrar_reg">

                <em style="color: #777"> Cargando datos, por favor espere...</em> <i  class="fa fa-cog fa-spin fa-2x fa-fw"></i>

                <br>
                <br>
            </h3>
            <fieldset ng-show="mostrar_reg" style="text-align: left;" class=" animated fadeIn">

                <div class="table-responsive">          
                    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                        <col style="width: 2%">
                        <col style="width: 8%">

                        <thead>
                            <tr>
                                <th >#</th>
                                <th>Cédula de Identidad</th>
                                <th>Nombre y Apellido</th>
                                <th >Carrera</th>
                                <th >Materia</th>
                                <th >Sección</th>
                                <th >Profesor</th>

                                <th style="min-width: 90px">Acción</th>

                            </tr>
                        </thead>

                        <tbody class="table_bandeja_apro_tbody">
                            <tr ng-repeat="(y,x) in busqueda.usuarios_ieu | filter:formData.materia.nombre_materia| filter:formData.seccion.nombre| filter:formData.seccion.nombre_profesor| filter:formData.carrera.nombre_carrera" >
                                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                <td>{{x.cedula}}</td>
                                <td>{{x.nombre_apellido}}</td>
                                <td>{{x.nombre_carrera}}</td>
                                <td>{{x.nombre_materia}}</td>
                                <td>{{x.nombre_seccion}}</td>
                                <td>{{x.nombre_apellido_profesor}}</td>

                                <td style="text-align: left;width: 150px;">

                                    <button ng-if="(x.estatus == 't') || (x.estatus != 't' && x.estatus != 'f')" ng-click="cambiar_estatus(x.id_datos_academico, false)" href="javascript:void(0)"  class="btn  btn-xs btn-warning">Rechazar postulación <div class="ripple-container"></div></button>
                                    <button ng-if="(x.estatus == 'f') || (x.estatus != 't' && x.estatus != 'f')" ng-click="cambiar_estatus(x.id_datos_academico, true)" href="javascript:void(0)"   class="btn  btn-xs btn-success">Aceptar Postulación <div class="ripple-container"></div></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </fieldset>

        </div>



    </div>
    <!-- /.col-lg-12 -->


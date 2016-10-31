<br>
<!--instalar capcha-->

<!-- /.row -->
<div class="row animated fadeIn">


    <form id="solicitante_form" method="post" name="Form_vincular_profesor"
          class="form-horizontal inicio" >

        <div class="panel panel-info ">

            <div class="panel-heading">
                <h4>Vincular Profesores </h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Profesor(a):</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="setear_data()"  ng-options="data as data.cedula+' - '+data.nombre1 +' '+data.apellido1 for data in datos_registro.profesores track by data.cedula" ng-model="formData.profesor" class="form-control" id="destino_form"  name="profesor" required>
                                <option value=""><-- Seleccione una opción --></option>
                            </select>
                            <span class="label-red" ng-if=" Form_vincular_profesor.profesor.$error.required">Campo Requerido</span>

                        </div>
                    </div>
                    

                    <div class="form-group animated fadeIn" ng-if="formData.profesor">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="buscar_materias()" ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData.carrera" class="form-control" id="destino_form"  name="carrera" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if=" Form_vincular_profesor.carrera.$error.required">Campo Requerido</span>
                        </div>
                    </div>

                    
                    <div ng-if="formData.carrera" class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Materias:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="buscar_secciones()"  ng-options="data as data.nombre_materia for data in datos_registro.materias track by data.id_materia" ng-model="formData.materia" class="form-control" id=""  name="materia" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if=" Form_vincular_profesor.materia.$error.required">Campo Requerido</span>

                        </div>
                    </div>
                    
                    <div  ng-if="formData.materia" class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Sección:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select   ng-options="data as data.nombre for data in datos_registro.secciones track by data.id_seccion" ng-model="formData.seccion" class="form-control" id=""  name="seccion" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if=" Form_vincular_profesor.seccion.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group animated fadeIn" ng-if="formData.seccion">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Duración en semanas:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-model="formData.duracion" class="form-control" id=""  name="duracion" required>
                                <option value=""><-- Seleccione una opción --></option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>   
                                <option value="6">6</option>         
                                <option value="7">7</option>         
                                <option value="8">8</option>         
                                

                            </select>
                            <span class="label-red" ng-if=" Form_vincular_profesor.duracion.$error.required">Campo Requerido</span>

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


                        <button  ng-click="Form_vincular_profesor.$valid

                                    ? registrar(formData) : ''" 

                                 ng-class="Form_vincular_profesor.$valid 
                                            ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>

                    </div>

                </div>

            </div>
        </div>
    </form>

    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Administrar secciones</h4>
        </div>
        <div class="panel-body">
            <fieldset style="text-align: left;">

                <div class="table-responsive">          
                    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                        <col style="width: 2%">
                        <thead>
                            <tr>
                                <th >#</th>
                                <th>Profesor(s)</th>
                                <th>Carrera</th>
                                <th>sección</th>.
                                <th>Materia</th>
                                <th>Duración en semanas</th>
                                <th>Fecha</th>

                                <th style="min-width: 90px">Acción</th>

                            </tr>
                        </thead>

                        <tbody class="table_bandeja_apro_tbody">
                            <tr ng-repeat="(y,x) in busqueda.secciones" >
                                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                <td>{{x.nombre1 + ' ' + x.apellido1}}</td>
                                <td>{{x.nombre_carrera}}</td>
                                <td>{{x.nombre_seccion}}</td>
                                <td>{{x.nombre_materia}}</td>
                                <td>{{x.duracion}}</td>
                                <td>{{x.fecha}}</td>

                                <td style="text-align: left;width: 200px;">
                                    <button ng-click="editar(x.id_seccion_materia)" href="javascript:void(0)" class="btn  btn-xs btn-warning "><i class="fa fa-edit fa-1x" aria-hidden="true"></i> Editar<div class="ripple-container"></div></button>
                                    <button  ng-if="x.desvincular == 't'" ng-click="eliminar(x.id_seccion_materia)" href="javascript:void(0)" class="btn  btn-xs btn-danger "><i class="fa fa-close fa-1x" aria-hidden="true"></i>Desvincular<div class="ripple-container"></div></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </fieldset>

        </div>
    </div>



    <!-- /.col-lg-12 -->


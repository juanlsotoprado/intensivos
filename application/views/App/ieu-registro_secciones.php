<br>
<!--instalar capcha-->

<!-- /.row -->
<div class="row animated fadeIn col-lg-10 col-lg-offset-1">


    <form id="solicitante_form" method="post" name="Form_registrar_seccion"
          class="form-horizontal inicio" >

        <div class="panel panel-info ">

            <div class="panel-heading">

                <h4>Registrar Secciones </h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.nombre_seccion"   type="text" class="form-control"
                                   id="" name="nombre_seccion"
                                   placeholder="Nombre de la sección" required>
                            <span class="label-red" ng-if="Form_registrar_seccion.$dirty && Form_registrar_seccion.nombre_seccion.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                      <div class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="buscar_materias()" ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData.carrera" class="form-control" id="destino_form"  name="carrera" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if=" Form_registrar_seccion.carrera.$error.required">Campo Requerido</span>
                        </div>
                    </div>
                    
                   <div ng-if="formData.carrera" class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Materias:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="buscar_secciones()"  ng-options="data as data.nombre_materia for data in datos_registro.materias track by data.id_materia" ng-model="formData.materia" class="form-control" id=""  name="materia" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if=" Form_registrar_seccion.materia.$error.required">Campo Requerido</span>

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


                        <button  ng-click="Form_registrar_seccion.$valid ? registrar(formData) : ''" 

                                 ng-class="Form_registrar_seccion.$valid != false ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>

                    </div>

                </div>

            </div>
        </div>
    </form>
</div>



<div class="row animated fadeIn col-lg-12">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Administrar secciones</h4>
        </div>
        <div class="panel-body">
            
            
            <fieldset style="text-align: left;">

                <div class="table-responsive">          
                    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                        <col style="width: 2%">
                        <col style="width: 50%">
                        <col style="width: 40%">

                        <thead>
                            <tr>
                                <th >#</th>
                                <th>Nombre(s)</th>
                                 <th>Materia</th>
                                 <th>Carrera</th>
                                <th>Fecha</th>

                                <th style="min-width: 90px">Acción</th>

                            </tr>
                        </thead>

                        <tbody class="table_bandeja_apro_tbody">
                            <tr ng-repeat="(y,x) in busqueda.secciones" >
                                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                <td>{{x.nombre}}</td>
                                 <td>{{x.nombre_materia}}</td>
                                  <td>{{x.nombre_carrera}}</td>
                                <td>{{x.fecha}}</td>

                                <td style="text-align: left;width: 200px;">
                                    <button ng-click="cambiar_estatus(x.id_seccion, x.activo == 't' ? 'false' : 'true', x.activo == 't' ? 'inactivar' : 'activar')" href="javascript:void(0)"   ng-class="x.activo == 't'?'btn-danger':'btn-success'" class="btn  btn-xs ">{{x.activo == 't'?'Inactivar':'Activar'}}<div class="ripple-container"></div></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </fieldset>

        </div>
    </div>

</div>


<!-- /.col-lg-12 -->


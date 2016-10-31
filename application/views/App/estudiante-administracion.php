<br>
<!-- /.row -->
<div class="row animated fadeIn">


    <div class="panel panel-info">
        <div class="panel-body">
            <br>
            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cantidad maxima de registros:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select  ng-change="cantidad(registro_total, formData.cantidad_reg,formData.carrera)"   ng-model="formData.cantidad_reg" class="form-control" id="destino_form"  name="cantidad" >
                        <option value="">100</option>
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
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select ng-change="cantidad(registro_total, formData.cantidad_reg,formData.carrera)" ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData.carrera" class="form-control" id="destino_form"  name="carrera" required>
                        <option value=""> SIN CARRERA ASOCIADA </option>

                    </select>

                </div>
            </div>

            <br>
            <br>
        </div>

    </div>





    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Administrar Estudiantes</h4>
        </div>
        <div class="panel-body" style="text-align: center">

            <h3 ng-hide="mostrar_reg">

                <em style="color: #777"> Cargando datos de los estudiantes, por favor espere...</em> <i  class="fa fa-cog fa-spin fa-2x fa-fw"></i>

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
                                <th>Nombre(s)</th>
                                <th>Apellido(s)</th>
                                <th >Carrera</th>
                                <th >Correo</th>

                                <th style="min-width: 90px">Acción</th>

                            </tr>
                        </thead>

                        <tbody class="table_bandeja_apro_tbody">
                            <tr ng-repeat="(y,x) in busqueda.usuarios_ieu" >
                                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                <td>{{x.cedula}}</td>
                                <td>{{x.nombre1 + " " + x.nombre2}}</td>
                                <td>{{x.apellido1 + " " + x.apellido2}}</td>
                                <td>{{x.nombre_carrera}}</td>
                                <td>{{x.correo_validado}}</td>


                                <td style="text-align: left;width: 200px;">
                                    <button ng-click="ver(x.cedula)"  class="btn btn-xs btn-primary "><i class="fa fa-eye  fa-1x" aria-hidden="true"></i>Ver<div class="ripple-container"></div></button>
                                    <button ng-if="x.correo_validado != 'NO-VALIDADO'" ng-click="restablecer(x.cedula, x.nombre1, x.apellido1, x.correo_validado)" href="javascript:void(0)" class="btn  btn-xs btn-warning "><i class="fa fa-edit fa-1x" aria-hidden="true"></i>Rest. clave<div class="ripple-container"></div></button>
                                    <button ng-click="cambiar_estatus(x.cedula, x.activo == 't' ? 'false' : 'true', x.activo == 't' ? 'inactivar' : 'activar')" href="javascript:void(0)"   ng-class="x.activo == 't'?'btn-danger':'btn-success'" class="btn  btn-xs ">{{x.activo == 't'?'Inactivar':'Activar'}}<div class="ripple-container"></div></button>
                                    <button ng-click="cambiar_carrera(x.cedula)"  class="btn btn-xs btn-info"><i class="fa fa-eye  fa-1x" aria-hidden="true"></i> {{x.id_carrera > 0 ?'Editar carrera':'Asignar carrera'}}<div class="ripple-container"></div></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </fieldset>

        </div>



    </div>
    <!-- /.col-lg-12 -->


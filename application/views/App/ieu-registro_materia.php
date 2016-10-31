<br>
<!--instalar capcha-->

<!-- /.row -->
<div class="row animated fadeIn">

    <form id="solicitante_form" method="post" name="Form_registrar_materia"
          class="form-horizontal inicio">

        <div class="panel panel-info">

            <div class="panel-heading">

                <h4>Registrar Materia </h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.nombre_materia"   type="text" class="form-control"
                                   id="" name="nombre_materia"
                                   placeholder="Nombre" required>
                            <span class="label-red" ng-if="Form_registrar_materia.$dirty && Form_registrar_materia.nombre_materia.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <!--                    <div class="form-group">
                                            <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Sección:</label>
                                            <div class="control-label col-lg-9 col-md-9 col-xs-12">
                    
                                                <select  ng-options="data as data.nombre for data in datos_registro.secciones track by data.id_seccion" ng-model="formData.seccion" class="form-control" id=""  name="carrera" required>
                                                    <option value=""><-- Seleccione una opción --><!--</option>
                    
                                                </select>
                                                <span class="label-red" ng-if="Form_registrar_materia.$dirty && Form_registrar_materia.seccion.$error.required">Campo Requerido</span>
                    
                                            </div>
                                        </div>-->


                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Unidades de crédito:</label>
                        <div class="control-label col-lg-4 col-md-4 col-xs-12">

                            <select  ng-model="formData.unidades" class="form-control" id=""  name="unidades" required>
                                <option value=""><-- Seleccione una opción --></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>   
                                <option value="6">6</option>                                
                            </select>
                            <span class="label-red" ng-if="Form_registrar_materia.$dirty && Form_registrar_materia.unidades.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Tipo:</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12">

                            <select   ng-model="formData.tipo" class="form-control"  name="tipo" required>
                                <option value=""><-- Seleccione una opción --></option>
                                <option value="t">TEORICO</option>
                                <option value="p">PRACTICO</option>
                            </select>
                            <span class="label-red" ng-if="Form_registrar_materia.$dirty && Form_registrar_materia.tipo.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Horas académicas semanales:</label>
                        <div class="control-label col-lg-4 col-md-4 col-xs-12">

                            <select ng-model="formData.horas_academicas" class="form-control" id=""  name="horas_academicas" required>
                                <option value=""><-- Seleccione una opción --></option>
                                <?php for($i = 1;$i <= 28;$i++){ ?>
                                
                                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>

                            </select>
                            <span class="label-red" ng-if="Form_registrar_materia.$dirty && Form_registrar_materia.horas_academicas.$error.required">Campo Requerido</span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData.carrera" class="form-control" id="destino_form"  name="carrera" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_registrar_materia.$dirty && Form_registrar_materia.carrera.$error.required">Campo Requerido</span>

                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="panel-footer">

                <div class="form-group">
                    <div id="botoms" class=" col-xs-12  " style="text-align: center;">


                        <button   ng-click="formData = {}"  type="button" class="submit btn 

                                  btn-success

                                  ">
                            Limpiar   

                        </button>


                        <button  ng-click="Form_registrar_materia.$valid != false
                                    ? registrar(formData) : ''" 

                                 ng-class="Form_registrar_materia.$valid != false 
                                    ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>


                    </div>

                    <!--                                    <button  ng-click="Form_registrar_materia.$valid != false
                                                                    ? registrar(formData) : ''" 
                    
                                                                 ng-class="Form_registrar_materia.$valid != false 
                                                      ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>
                    -->

                </div>
            </div>
        </div>
    </form>


    <div class="row animated fadeIn col-lg-12">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h4>Administrar Materias</h4>
            </div>
            <div class="panel-body"  style="text-align: center">

                <div class="panel panel-info">


                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cantidad maxima de registros:</label>
                            <div class="control-label col-lg-9 col-md-9 col-xs-12">

                                <select  ng-change="cantidad(registro_total, formData3.cantidad_reg, formData3.carrera)"   ng-model="formData3.cantidad_reg" class="form-control" id="destino_form"  name="cantidad" >
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
                        <br><br>
                        <div class="form-group">
                            <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                            <div class="control-label col-lg-9 col-md-9 col-xs-12">

                                <select  ng-change="cantidad(registro_total, formData3.cantidad_reg, formData3.carrera)"  ng-options="data as data.nombre_carrera for data in datos_registro.carreras track by data.id_carrera" ng-model="formData3.carrera" class="form-control" id="destino_form"  name="carrera" required>
                                </select>

                            </div>
                        </div>

                    </div>
                </div>

                <h3 ng-hide="mostrar_reg"> 

                    <em style="color: #777"> Cargando datos, por favor espere...</em> <i  class="fa fa-cog fa-spin fa-2x fa-fw"></i>

                    <br>
                    <br>
                </h3>
                
                <fieldset ng-show="mostrar_reg" style="text-align: left;" class=" animated fadeIn">

                    <div class="table-responsive">          
                        <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                            <col style="width: 2%">

                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th>Nombre</th>
                                    <th>Carrera</th>
                                    <th>U.C.</th>
                                    <th>Tipo</th>
                                    <th>Horas académicas semanales</th>
                                    <th>Fecha</th>
                                    <th style="min-width: 90px">Acción</th>

                                </tr>
                            </thead>

                            <tbody class="table_bandeja_apro_tbody">
                                <tr ng-repeat="(y,x) in busqueda.materias | orderBy:'country'" >
                                    <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                    <td>{{x.nombre_materia}}</td>
                                    <td>{{x.nombre_carrera}}</td>
                                    <td>{{x.unidad_credito}}</td>
                                    <td>{{ x.tipo == 't'? 'TEORICO' : 'PRACTICO'}}</td>
                                    <td>{{x.horas_academicas}}</td>
                                    <td>{{x.fecha}}</td>

                                    <td style="text-align: left;width: 200px;">
                                        <button ng-click="cambiar_estatus(x.id_materia, x.activo == 't' ? 'false' : 'true', x.activo == 't' ? 'inactivar' : 'activar')" href="javascript:void(0)"   ng-class="x.activo == 't'?'btn-danger':'btn - success'" class="btn  btn-xs ">{{x.activo == 't'?'Inactivar':'Activar'}}<div class="ripple-container"></div></button>
                                        <button  ng-click="editar(x.id_materia)" href="javascript:void(0)" class="btn  btn-xs btn-warning "><i class="fa fa-edit fa-1x" aria-hidden="true"></i>Editar<div class="ripple-container"></div></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </fieldset>

            </div>
        </div>

    </div>

</div>

<!-- /.col-lg-12 -->


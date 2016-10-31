<br>
<!--instalar capcha-->

<!-- /.row -->
<div class="row animated fadeIn">

    <form id="solicitante_form" method="post" name="Form_registrar_carrera"
          class="form-horizontal inicio">

        <div class="panel panel-info">

            <div class="panel-heading">

                <h4>Registrar Carrera </h4>
                
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input  ng-change="formData.nombre_carrera?nombre_existente(formData.nombre_carrera):''" ng-model="formData.nombre_carrera"   type="text" class="form-control"
                                   id="" name="nombre_carrera"
                                   placeholder="Nombre" required>
                            <span class="label-red" ng-if="Form_registrar_carrera.$dirty && Form_registrar_carrera.nombre_carrera.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_registrar_carrera.$dirty && !Form_registrar_carrera.nombre_carrera.$error.required && existente == true">Nombre Existente</span>

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


                    <button  ng-click="Form_registrar_carrera.$valid != false && existente == false 
                        ? registrar(formData) : ''" 

                             ng-class="Form_registrar_carrera.$valid != false  && existente == false 
                                    ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>

                </div>


            </div>
        </div>
</div>
</form>

<div class="row animated fadeIn col-lg-12">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Administrar Carreras</h4>

        </div>
        <div class="panel-body"  style="text-align: center">

            <div class="panel panel-info">


                <div class="panel-body">


                    <fieldset style="text-align: left;" class=" animated fadeIn">

                        <div class="table-responsive">          
                            <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                                <col style="width: 2%">

                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th>Nombre</th>
                                        <th style="min-width: 90px">Acción</th>

                                    </tr>
                                </thead>

                                <tbody class="table_bandeja_apro_tbody">
                                    <tr ng-repeat="(y,x) in datos_registro.carreras " >
                                        <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                        <td>{{x.nombre_carrera}}</td>

                                        <td style="text-align: left;width: 200px;">
                                            <button  ng-click="editar(x.id_carrera,x.nombre_carrera)" href="javascript:void(0)" class="btn  btn-xs btn-warning "><i class="fa fa-edit fa-1x" aria-hidden="true"></i>Editar<div class="ripple-container"></div></button>
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


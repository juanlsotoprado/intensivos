<br>
<!-- /.row -->
<div class="row animated fadeIn">

    <form id="solicitante_form" method="post" name="Form_registrar"
          class="form-horizontal inicio">

        <div class="panel panel-primary">

            <div class="panel-heading">

                <h4>Registrar responsable IEU {{formData.nacionalidad}}</h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cédula:</label>



                        <div class="control-label col-lg-5 col-md-5 col-xs-12">

                            <div class="input-group">
                                <div ng-if="formData.nacionalidad" class="input-group-btn" >
                                    <span class="input-group-addon" ng-bind="formData.nacionalidad+'-'"></span>
                                </div>

                                <!--                               maxlength="10" ng-minlength="10" -->
                                <input  ng-model="formData.cedula" ng-change="buscar_cedula(formData.cedula);"  min="0"  maxlength="10" ng-minlength="7" ng-maxlength="10"  type="number"  class="form-control" name="cedula" placeholder="Cédula" required >
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer nombre</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.primer_nombre"   type="text" class="form-control"
                                   id="numero_personas_form" name="primer_nombre"
                                   placeholder="Primer nombre" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Segundo nombre</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.segundo_nombre" type="text" class="form-control"
                                   id="numero_personas_form" name="segundo_nombre"
                                   placeholder="Segundo nombre" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer apellido</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.primer_apellido" type="text" class="form-control"
                                   id="numero_personas_form" name="primer_apellido"
                                   placeholder="Primer apellido" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Segundo apellido</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.segundo_apellido" type="text" class="form-control"
                                   id="numero_personas_form" name="segundo_apellido"
                                   placeholder="Segundo apellido" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono móvil: </label>
                        <div class="control-label col-lg-3 col-md-3 col-xs-12">
                            <input type="text" class="form-control"
                                   name="telefono_cel_form"
                                   placeholder="N° de teléfono celular" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono móvil  de habitación: </label>
                        <div class="control-label col-lg-3 col-md-3 col-xs-12">
                            <input type="text" class="form-control"
                                   name="telefono_hab_form"
                                   placeholder="N° de teléfono de habitación" required>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Genero:</label>
                        <div class="control-label col-lg-3 col-md-3 col-xs-12" style="text-align: left">
                            <div class="btn-group" data-toggle="buttons">
                                <label ng-click="formData.genero = 'F'"  ng-class="formData.genero == 'F'? 'active':'' " class="btn btn-default  Pernocturna_form">
                                    <input ng-model="formData.genero"   name="genero" value="F"  type="radio">Femenino
                                </label>
                                <label  ng-click="formData.genero = 'M'"  ng-class="formData.genero == 'M'? 'active':'' " class="btn btn-default Pernocturna_form">
                                    <input ng-model="formData.genero"  name="genero" value="M"  type="radio">Masculino
                                </label>

                            </div> 
                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control"
                                   id="numero_personas_form" name="correo"
                                   placeholder=" Dirección de correo" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Dirección de correo (confirme)</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control"
                                   id="numero_personas_form" name="correo-confirme"
                                   placeholder="Confirme la dirección de correo" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo (alternativo)</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input type="text" class="form-control"
                                   id="numero_personas_form" name="correo"
                                   placeholder=" Dirección de correo (alternativo)" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Universidad:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select class="form-control" id="destino_form"  name="universidad">
                                <option value=""><-- Seleccione una opcion --></option>

                            </select>

                        </div>
                    </div>





                </fieldset>
            </div>
            <div class="panel-footer">

                <div class="form-group">
                    <div id="botoms" class=" col-xs-12  " style="text-align: center;">

                        <br>
                        <button   type="button" class="submit btn 

                                  btn-success

                                  ">
                            Limpiar   

                        </button>
                        <button   type="button" class="submit btn 

                                  btn-primary  

                                  ">
                            Registrar                      </button>




                    </div>
                </div>
            </div>

        </div>
        <div class="panel panel-success">

            <div class="panel-heading">

                <h4>Responsables IEU de registrados</h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="table-responsive">          
                        <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                            <col style="width: 2%">
                            <col style="width: 20%">

                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th>Cédula</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellido(s)</th>
                                    <th>Universidad</th>

                                    <th style="min-width: 90px">Acción</th>

                                </tr>
                            </thead>

                            <tbody class="table_bandeja_apro_tbody">
                                <tr ng-repeat="(y,x) in busqueda.devueltos" >
                                    <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                    <td style=" font-weight: bold">{{x.id}}</td>


                                    <td style="text-align: left;">
                                        <a ng-click="busqueda.ver(x.id)" href="javascript:void(0)" class="btn btn-raised btn-xs btn-primary "><i class="fa fa-eye  fa-1x" aria-hidden="true"></i>Ver<div class="ripple-container"></div></a>

                                        <?php if ($user_sesion['perfil_seleccionado'] == 3 || $user_sesion['perfil_seleccionado'] == 4) { ?>
                                            <a ng-click="busqueda.ver(x.id)" href="javascript:void(0)" class="btn btn-raised btn-xs btn-success "><i class="fa fa-edit fa-1x" aria-hidden="true"></i>Editar<div class="ripple-container"></div></a>
                                            <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </fieldset>

            </div>

    </form>

</div>
<!-- /.col-lg-12 -->


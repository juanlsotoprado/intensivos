<br>
<!-- /.row -->
<div class="row animated fadeIn col-lg-10 col-lg-offset-1">

    <form id="solicitante_form" method="post" name="Form_cambiar_clave"
          class="form-horizontal inicio">

        <div class="panel panel-primary">

            <div class="panel-heading">

                <h4>Cambiar Contraseña</h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Contraseña actual:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.clave_actual" type="{{ver == true?'text':'password'}}" class="form-control"
                                   id="" name="clave_actual"
                                   placeholder="Ingrese su contraseña actual"  required="">

                            <span class="label-red" ng-if="Form_cambiar_clave.$dirty && Form_cambiar_clave.clave_actual.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Nueva contraseña:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.clave_nueva" type=" {{ver == true?'text':'password'}}" class="form-control"
                                   id="" name="clave_nueva"
                                   placeholder="Ingrese la nueva contraseña"  required="">

                            <span class="label-red" ng-if="Form_cambiar_clave.$dirty && Form_cambiar_clave.clave_nueva.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Repita la nueva contraseña:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.clave_nueva_repita" type="{{ver == true?'text':'password'}}" class="form-control"
                                   id="" name="clave_nueva_repita"
                                   placeholder="Repita la nueva contraseña"  required="">
                            <span class="label-red" ng-if="Form_cambiar_clave.$dirty && Form_cambiar_clave.clave_nueva_repita.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if=" !Form_cambiar_clave.clave_nueva_repita.$error.required && (formData.clave_nueva != formData.clave_nueva_repita)">Contraseña distinta</span>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Ver contraseñas:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12" style="text-align: left">
                            <button class="btn btn-secondary" ng-click="ver = !ver" type="button"><i class="fa {{ver == true?'fa-eye-slash':'fa-eye'}}" ></i></button>

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


                        <button  ng-click="Form_cambiar_clave.$valid != false
                                    && formData.clave_nueva == formData.clave_nueva_repita
                                    ? modificar(formData) : ''" 

                                 ng-class="Form_cambiar_clave.$valid != false
                                    && ( formData.clave_nueva == formData.clave_nueva_repita)
                                   ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Actualizar </button>


                    </div>
                </div>
            </div>
        </div>

        <!-- /.col-lg-12 -->


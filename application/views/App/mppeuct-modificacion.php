
<form id="solicitante_form" method="post" name="Form_modificar_ieu"
      class="form-horizontal inicio">

    <div class="panel panel-primary">

        <div class="panel-heading">

            <h4>Modificar Responsable IEU </h4>

        </div>
        <div class="panel-body">
            <fieldset style="text-align: left;">
                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cédula de Identidad:</label>
                    <div class="control-label col-lg-5 col-md-5 col-xs-12">

                        <div class="input-group">
                            <div  class="input-group-btn" >
                                <span class="input-group-addon" >{{formData2.nacionalidad}}</span>
                            </div>

                            <input readonly  ng-model="formData.cedula" ng-value="formData.cedula" type="text"  class="form-control" name="cedula" placeholder="Cédula de Identidad"  >

                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer nombre:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-model="formData.nombre1" ng-value="formData.nombre1"   type="text" class="form-control"
                               id="" name="primer_nombre"
                               placeholder="Primer nombre" required>
                        <span class="label-red" ng-if=" Form_modificar_ieu.primer_nombre.$error.required">Campo Requerido</span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Segundo nombre:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-value="formData.nombre2"  ng-model="formData.nombre2" type="text" class="form-control"
                               id="" name="segundo_nombre"
                               placeholder="Segundo nombre" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer apellido:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-value="formData.apellido1"  ng-model="formData.apellido1" type="text" class="form-control"
                               id="" name="primer_apellido"
                               placeholder="Primer apellido" required>
                        <span class="label-red" ng-if=" Form_modificar_ieu.primer_apellido.$error.required">Campo Requerido</span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Segundo apellido:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-value="formData.apellido2"  ng-model="formData.apellido2" type="text" class="form-control"
                               id="" name="segundo_apellido"
                               placeholder="Segundo apellido">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Género:</label>
                    <div class="control-label col-lg-6 col-md-6 col-xs-12" style="text-align: left">
                        <div class="btn-group" data-toggle="buttons">
                            <label ng-click="formData.genero = 'F'"  ng-class="formData.genero == 'F'? 'active':'' " class="btn btn-default  Pernocturna_form">
                                <input  ng-model="formData.genero"   name="genero" value="F"  type="radio" required>Femenino
                            :</label>
                            <label  ng-click="formData.genero = 'M'"  ng-class="formData.genero == 'M'? 'active':'' " class="btn btn-default Pernocturna_form">
                                <input  ng-model="formData.genero"  name="genero" value="M"  type="radio" required>Masculino
                            :</label>
                        </div> 
                        <span class="label-red" ng-if=" Form_modificar_ieu.genero.$error.required">Campo Requerido</span>

                    </div>
                </div>
                
             
              <div class="form-group">
                    
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono móvil: :</label>
                    <div class="control-label col-lg-6 col-md-6 col-xs-12">
                        <input ng-value="formData.telefono_celular"   ng-model="formData.telefono_celular" type="text" class="form-control"
                               placeholder="04120000000"   name="telefono_celular"  ng-pattern="ph_numbr" required>
                        <span class="label-red" ng-if=" Form_modificar_ieu.telefono_celular.$error.required">Campo Requerido</span>
                        <span class="label-red" ng-if="Form_modificar_ieu.telefono_celular.$error.pattern">Telefono invalido (04120000000)</span>

                    </div>

                </div>

                <div class="form-group">
                    
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono de habitación: :</label>
                    <div class="control-label col-lg-6 col-md-6 col-xs-12">
                        <input ng-value="formData.telefono_hab"   ng-model="formData.telefono_hab" type="text" class="form-control"
                               placeholder="02120000000"   name="telefono_hab_form"  ng-pattern="ph_numbr">
                        <span class="label-red" ng-if="Form_modificar_ieu.telefono_hab_form.$error.pattern">Telefono invalido (02120000000)</span>

                    </div>

                </div>
                
                  <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-change="verificar_correo(formData.correo_ppal);" ng-model="formData.correo_ppal"  type="email" class="form-control"
                                   id="" name="correo_ppal"
                                   placeholder="juan@xxxx.com" required>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_modificar_ieu.correo_ppal.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_modificar_ieu.correo_ppal.$error.email">Correo invalido</span>


                        </div>
                    </div>


                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Dirección de correo (confirme):</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-value="formData.correo2"  ng-model="formData.correo2"type="email" class="form-control"
                               name="correo_confirme"
                               placeholder="juan@xxxx.com" required>
                        <span class="label-red" ng-if=" Form_modificar_ieu.correo_confirme.$error.required">Campo Requerido</span>
                        <span class="label-red" ng-if=" Form_modificar_ieu.correo_confirme.$error.email">Correo invalido</span>
                        <span class="label-red" ng-if=" (!Form_modificar_ieu.correo_confirme.$error.required && !Form_modificar_ieu.correo_confirme.$error.email) && (formData.correo2 != formData.correo_ppal)">Los correos no coinciden</span>

                    </div>
                </div>

                <div class="form-group">
                    <label  class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo (alternativo):</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-value="formData.correo_secundario"  ng-model="formData.correo_secundario" type="email" class="form-control"
                               id="" name="correo_alternativo"
                               placeholder="juan@xxxx.com" >
                        <span class="label-red" ng-if=" Form_modificar_ieu.correo_alternativo.$error.email">Correo invalido</span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">I.E.U.:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">



                        <select ng-value="formData.universidad"  ng-options="data as data.nombre_ieu for data in datos_registro.universidades track by data.id_ieu" ng-model="formData.universidad" class="form-control" id="destino_form"  name="universidad" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if=" Form_modificar_ieu.universidad.$error.required">Campo Requerido</span>

                    </div>
                </div>

            </fieldset>
        </div>
        <div class="panel-footer">

            <div class="form-group">
                <div id="botoms" class=" col-xs-12  " style="text-align: center;">

                    <br>
                    <button   ng-click="cedula = formData.cedula;
                            nacionalidad = formData.nacionalidad;
                            formData = {cedula: cedula, nacionalidad: nacionalidad}"  type="button" class="submit btn 

                              btn-success

                              ">
                        Limpiar   

                    </button>
                    <button  ng-click="Form_modificar_ieu.$valid != false
                                    && (formData.correo2 == formData.correo_ppal)
                                    && !formData.campo_existente ? modificar(formData) : ''" 

                             ng-class="Form_modificar_ieu.$valid != false 
                                       && formData.correo2 == formData.correo_ppal 
                                       && !formData.campo_existente? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Modificar </button>




                </div>
            </div>
        </div>

    </div>
</form>

<!-- /.col-lg-12 -->


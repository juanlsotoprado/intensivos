<br>
<!-- /.row -->
<div class="row animated fadeIn">

    <form id="solicitante_form" method="post" name="Form_registrar"
          class="form-horizontal inicio">

        <div class="panel panel-primary">

            <div class="panel-heading">

                <h4>Registrar Responsable IEU  </h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">
                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cédula de Identidad:</label>
                        <div class="control-label col-lg-5 col-md-5 col-xs-12">

                            <div class="input-group">
                                <div ng-if="formData.nacionalidad" class="input-group-btn" >
                                    <span class="input-group-addon" ng-bind="formData.nacionalidad + '-'"></span>
                                </div>

                                <input  ng-model="formData.cedula" ng-click="cambio_cedula();"  min="0"  maxlength="10" ng-minlength="5" ng-maxlength="10"  type="number"  class="form-control" name="cedula" placeholder="Cédula de Identidad" required >

                                <div ng-if="cedula_busqueda" class="input-group-addon" >
                                    Validando... <i  class="fa fa-cog fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <span ng-click="!Form_registrar.cedula.$error.number
                                            && !Form_registrar.cedula.$error.minlength
                                            && !Form_registrar.cedula.$error.maxlength
                                            && !Form_registrar.cedula.$error.required ? buscar_cedula(formData.cedula) : '';"

                                      ng-if="!cedula_busqueda" class="input-group-btn">

                                  <button ng-show ="(!Form_registrar.cedula.$error.required
                                                        && !Form_registrar.cedula.$error.number
                                                        && !Form_registrar.cedula.$error.minlength
                                                        && !Form_registrar.cedula.$error.maxlength
                                                        && formData.nacionalidad
                                                        && cedula_validada
                                                        && !formData.campo_existente)?true:false"
                                                                
                                                       class="btn btn-secondary btn-success" type="button"> Validado <i class="fa fa-check" aria-hidden="true"></i></button>
    

                                  

                                    <button ng-hide ="(!Form_registrar.cedula.$error.required
                                                        && !Form_registrar.cedula.$error.number
                                                        && !Form_registrar.cedula.$error.minlength
                                                        && !Form_registrar.cedula.$error.maxlength
                                                        && formData.nacionalidad
                                                        && cedula_validada
                                                        && !formData.campo_existente)?true:false"
                                                                
                                                       ng-class="!Form_registrar.cedula.$error.number
                                                                  && !Form_registrar.cedula.$error.minlength
                                                                  && !Form_registrar.cedula.$error.maxlength
                                                                  && !Form_registrar.cedula.$error.required?' btn-warning ':' disabled  btn-default ';"  class="btn btn-secondary " type="button"> Validar  !</i></button>
                       </span>

                            </div>

                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.cedula.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && (Form_registrar.cedula.$error.minlength || Form_registrar.cedula.$error.maxlength)">Ingrese una Cédula de Identidad valida</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.cedula.$error.number">El campo debe ser numerico</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && cedula_validada && !Form_registrar.cedula.$error.number && !Form_registrar.cedula.$error.minlength && !Form_registrar.cedula.$error.maxlength && !Form_registrar.cedula.$error.required && !formData.nacionalidad && !formData.campo_existente">Cédula de Identidad no encontrada</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && cedula_validada && !Form_registrar.cedula.$error.number && !Form_registrar.cedula.$error.minlength && !Form_registrar.cedula.$error.maxlength && !Form_registrar.cedula.$error.required && formData.campo_existente">Cédula de Identidad ya exitente en el sistema</span>

                            
                            <span class="label-red"
                                  ng-if="Form_registrar.$dirty
                                                  && !Form_registrar.cedula.$error.number
                                                  && !Form_registrar.cedula.$error.minlength
                                                  && !Form_registrar.cedula.$error.maxlength
                                                  && !Form_registrar.cedula.$error.required
                                                  && !cedula_validada
                            ">Validar la cedula</span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.primer_nombre"   type="text" class="form-control"
                                   id="" name="primer_nombre"
                                   placeholder="Primer nombre" required>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.primer_nombre.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Segundo nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.segundo_nombre" type="text" class="form-control"
                                   id="" name="segundo_nombre"
                                   placeholder="Segundo nombre" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer apellido:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.primer_apellido" type="text" class="form-control"
                                   id="" name="primer_apellido"
                                   placeholder="Primer apellido" required>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.primer_apellido.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Segundo apellido:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.segundo_apellido" type="text" class="form-control"
                                   id="" name="segundo_apellido"
                                   placeholder="Segundo apellido" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Género:</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12" style="text-align: left">
                            <div class="btn-group" data-toggle="buttons">
                                <label ng-click="formData.genero = 'F'"  ng-class="formData.genero == 'F'? 'active':'' " class="btn btn-default  Pernocturna_form">
                                    <input ng-model="formData.genero"   name="genero" value="F"  type="radio" required>Femenino
                                :</label>
                                <label  ng-click="formData.genero = 'M'"  ng-class="formData.genero == 'M'? 'active':'' " class="btn btn-default Pernocturna_form">
                                    <input ng-model="formData.genero"  name="genero" value="M"  type="radio" required>Masculino
                                :</label>
                            </div> 
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.genero.$error.required">Campo Requerido</span>

                        </div>
                    </div>


                    <div class="form-group">

                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono móvil: :</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12">
                            <input ng-value="formData.telefono_cel_form"   ng-model="formData.tlf_cel" type="text" class="form-control"
                                   placeholder="04120000000"   name="tlf_cel"  ng-pattern="ph_numbr" required>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.tlf_cel.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_registrar.tlf_cel.$error.pattern">Telefono invalido (04120000000)</span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono de habitación: :</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12">
                            <input ng-value="formData.tlf_hab"   ng-model="formData.tlf_hab" type="text" class="form-control"
                                   placeholder="02120000000"   name="tlf_hab"  ng-pattern="ph_numbr">
                            <span class="label-red" ng-if="Form_registrar.tlf_hab.$error.pattern">Telefono invalido (02120000000)</span>

                        </div>

                    </div>


                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-change="verificar_correo(formData.correo);" ng-model="formData.correo"  type="email" class="form-control"
                                   id="" name="correo"
                                   placeholder="juan@xxxx.com" required>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.correo.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.correo.$error.email">Correo invalido</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && formData.correo_validado">Correo ya existe en el sistema</span>


                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Dirección de correo (confirme):</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.correo2"type="email" class="form-control"
                                   name="correo_confirme"
                                   placeholder="juan@xxxx.com" required>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.correo_confirme.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.correo_confirme.$error.email">Correo invalido</span>
                            <span class="label-red" ng-if="Form_registrar.$dirty && (!Form_registrar.correo_confirme.$error.required && !Form_registrar.correo_confirme.$error.email) && (formData.correo2 != formData.correo)">Los correos no coinciden</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo (alternativo):</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.correo_alternativo" type="email" class="form-control"
                                   id="" name="correo_alternativo"
                                   placeholder="juan@xxxx.com" >
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.correo_alternativo.$error.email">Correo invalido</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">I.E.U.:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-options="data as data.nombre_ieu for data in datos_registro.universidades track by data.id_ieu" ng-model="formData.universidad" class="form-control" id="destino_form"  name="universidad" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_registrar.$dirty && Form_registrar.universidad.$error.required">Campo Requerido</span>

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


                        <button  ng-click="Form_registrar.$valid != false
                                    && (formData.correo2 == formData.correo)
                                    && formData.nacionalidad
                                    && cedula_validada
                                    && !formData.campo_existente ? registrar(formData) : ''" 

                                 ng-class="Form_registrar.$valid != false 
                                   && formData.correo2 == formData.correo 
                                    && formData.nacionalidad 
                                     && !formData.campo_existente
                                     && cedula_validada
                                     && !formData.correo_validado                           
                                     ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>


                    </div>

                    <!--                                    <button  ng-click="Form_registrar.$valid != false
                                                                    ? registrar(formData) : ''" 
                    
                                                                 ng-class="Form_registrar.$valid != false 
                                                      ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>
                    -->

                </div>
            </div>
        </div>

</div>
</form>

<!-- /.col-lg-12 -->


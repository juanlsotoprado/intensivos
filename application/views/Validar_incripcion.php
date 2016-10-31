<br>  
<div  class="row animated fadeIn">
    <form id="solicitante_form" method="post" name="Form_validar_estudiante"
          class="form-horizontal inicio">

        <div class="panel panel-primary">

            <div class="panel-heading">

                <h4>Validar Inscripción</h4>
            </div>
            <div class="panel-body">

                <fieldset style="text-align: left;">
                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cédula de Identidad:</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12">

                            <div class="col-xs-12 input-group">


                                <div ng-if="formData.nacionalidad" class="input-group-btn" >
                                    <span class="input-group-addon" ng-bind="formData.nacionalidad + '-'"></span>
                                </div>

                                <input  ng-click="cambio_cedula();" ng-model="formData.cedula"   min="0"  maxlength="10" ng-minlength="5" ng-maxlength="10"  type="number"  class="form-control" name="cedula" placeholder="Cédula de Identidad" required >
                                <div ng-if="cedula_busqueda" class="input-group-addon" >
                                    Validando... <i  class="fa fa-cog fa-spin fa-1x fa-fw"></i>
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <span ng-click="!Form_validar_estudiante.cedula.$error.number
                                            && !Form_validar_estudiante.cedula.$error.minlength
                                            && !Form_validar_estudiante.cedula.$error.maxlength
                                            && !Form_validar_estudiante.cedula.$error.required ? buscar_cedula(formData.cedula) : '';"

                                      ng-if="!cedula_busqueda" class="input-group-btn">
                                    
                                    
                                    <button ng-show ="(!Form_validar_estudiante.cedula.$error.required
                                                        && !Form_validar_estudiante.cedula.$error.number
                                                        && !Form_validar_estudiante.cedula.$error.minlength
                                                        && !Form_validar_estudiante.cedula.$error.maxlength
                                                        && formData.nacionalidad
                                                        && cedula_validada
                                                        && !formData.estudiante_no_existente_saime
                                                        && !formData.estudiante_no_existente_sistema
                                                        && !formData.estudiante_existente_validado)?true:false"
                                                                
                                                       class="btn btn-secondary btn-success" type="button"> Validado <i class="fa fa-check" aria-hidden="true"></i></button>
    

                                  

                                    <button ng-hide ="(!Form_validar_estudiante.cedula.$error.required
                                                        && !Form_validar_estudiante.cedula.$error.number
                                                        && !Form_validar_estudiante.cedula.$error.minlength
                                                        && !Form_validar_estudiante.cedula.$error.maxlength
                                                        && formData.nacionalidad
                                                        && cedula_validada
                                                        && !formData.estudiante_no_existente_saime
                                                        && !formData.estudiante_no_existente_sistema
                                                        && !formData.estudiante_existente_validado)?true:false"
                                                                
                                                        ng-class="!Form_validar_estudiante.cedula.$error.number
                                                                  && !Form_validar_estudiante.cedula.$error.minlength
                                                                  && !Form_validar_estudiante.cedula.$error.maxlength
                                                                  && !Form_validar_estudiante.cedula.$error.required?' btn-warning ':' disabled  btn-default ';"  class="btn btn-secondary " type="button"> Validar  !</i></button>
                                </span>
                            </div>
                            <div  class="col-xs-12">


                                <span class="label-red" 
                                      ng-if="  Form_validar_estudiante.$dirty
                                                              && Form_validar_estudiante.cedula.$error.required"
                                      >Campo Requerido</span>

                                <span class="label-red" 
                                      ng-if="Form_validar_estudiante.$dirty
                                                      && (Form_validar_estudiante.cedula.$error.minlength || Form_validar_estudiante.cedula.$error.maxlength)"
                                      >Ingrese una Cédula de Identidad valida</span>

                                <span class="label-red" 
                                      ng-if="Form_validar_estudiante.$dirty
                                                      && Form_validar_estudiante.cedula.$error.number"
                                      >El campo debe ser numerico</span>

                                <span class="label-red"
                                      ng-if="Form_validar_estudiante.$dirty
                                                      && !Form_validar_estudiante.cedula.$error.number
                                                      && !Form_validar_estudiante.cedula.$error.minlength
                                                      && !Form_validar_estudiante.cedula.$error.maxlength
                                                      && !Form_validar_estudiante.cedula.$error.required
                                                      && !cedula_validada
                                      ">Validar la cedula</span>


                                <span class="label-red"
                                      ng-if="Form_validar_estudiante.$dirty
                                                      && !Form_validar_estudiante.cedula.$error.number
                                                      && !Form_validar_estudiante.cedula.$error.minlength
                                                      && !Form_validar_estudiante.cedula.$error.maxlength
                                                      && !Form_validar_estudiante.cedula.$error.required
                                                      && !formData.nacionalidad
                                                      && cedula_validada
                                                      && formData.estudiante_no_existente_saime">Cédula de Identidad no encontrada</span>

                                <span class="label-red"
                                      ng-if="Form_validar_estudiante.$dirty
                                                      && !Form_validar_estudiante.cedula.$error.number
                                                      && !Form_validar_estudiante.cedula.$error.minlength
                                                      && !Form_validar_estudiante.cedula.$error.maxlength
                                                      && !Form_validar_estudiante.cedula.$error.required
                                                      && !formData.nacionalidad
                                                      && cedula_validada
                                                      && !formData.estudiante_no_existente_saime
                                                      && formData.estudiante_no_existente_sistema
                                      ">Usted no ha sido registrado en ninguna I.E.U.<br> Favor contácte al Responsable corespondiente</span>




                                <span class="label-red"
                                      ng-if="Form_validar_estudiante.$dirty
                                                      && !Form_validar_estudiante.cedula.$error.number
                                                      && !Form_validar_estudiante.cedula.$error.minlength
                                                      && !Form_validar_estudiante.cedula.$error.maxlength
                                                      && !Form_validar_estudiante.cedula.$error.required
                                                      && !formData.nacionalidad
                                                      && cedula_validada
                                                      && !formData.estudiante_no_existente_saime
                                                      && !formData.estudiante_no_existente_sistema
                                                      && formData.estudiante_existente_validado
                                      ">Cédula de Identidad ya registrada y validada</span>



                            </div>

                        </div>



                    </div>




                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Primer nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.primer_nombre"   type="text" class="form-control"
                                   id="" name="primer_nombre"
                                   placeholder="Primer nombre" required>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.primer_nombre.$error.required">Campo Requerido</span>

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
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.primer_apellido.$error.required">Campo Requerido</span>

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
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.genero.$error.required">Campo Requerido</span>

                        </div>
                    </div>


                    <div class="form-group">

                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono móvil: :</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12">
                            <input ng-value="formData.telefono_cel_form"   ng-model="formData.tlf_cel" type="text" class="form-control"
                                   placeholder="04120000000"   name="tlf_cel"  ng-pattern="ph_numbr" required>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.tlf_cel.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_validar_estudiante.tlf_cel.$error.pattern">Telefono invalido (04120000000)</span>

                        </div>

                    </div>

                    <div class="form-group">

                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">N° de teléfono de habitación: :</label>
                        <div class="control-label col-lg-6 col-md-6 col-xs-12">
                            <input ng-value="formData.tlf_hab"   ng-model="formData.tlf_hab" type="text" class="form-control"
                                   placeholder="02120000000"   name="tlf_hab"  ng-pattern="ph_numbr">
                            <span class="label-red" ng-if="Form_validar_estudiante.tlf_hab.$error.pattern">Telefono invalido (02120000000)</span>

                        </div>

                    </div>


                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-change="verificar_correo(formData.correo);" ng-model="formData.correo"  type="email" class="form-control"
                                   id="" name="correo"
                                   placeholder="juan@xxxx.com" required>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.correo.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.correo.$error.email">Correo invalido</span>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && formData.correo_validado">Correo ya existe en el sistema</span>


                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Dirección de correo (confirme):</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.correo2"type="email" class="form-control"
                                   name="correo_confirme"
                                   placeholder="juan@xxxx.com" required>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.correo_confirme.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.correo_confirme.$error.email">Correo invalido</span>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && (!Form_validar_estudiante.correo_confirme.$error.required && !Form_validar_estudiante.correo_confirme.$error.email) && (formData.correo2 != formData.correo)">Los correos no coinciden</span>

                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="control-label control-label col-lg-3 col-md-3 col-xs-12"> Dirección de correo (alternativo):</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input ng-model="formData.correo_alternativo" type="email" class="form-control"
                                   id="" name="correo_alternativo"
                                   placeholder="juan@xxxx.com" >
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.correo_alternativo.$error.email">Correo invalido</span>

                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------->
                
                     <div  class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Estado:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="municipio(formData.estado)"   ng-options="data as data.descripcion for data in datos_registro.estado track by data.cod_estado" ng-model="formData.estado" class="form-control"   name="estado" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.estado.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div ng-show="formData.estado"  class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Municipio:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="parroquia(formData.municipio)"   ng-options="data as data.descripcion for data in datos_registro.municipio track by data.cod_municipio" ng-model="formData.municipio" class="form-control" id="municipio"  name="municipio" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.municipio.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div ng-show="formData.municipio"  class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Parroquia:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-options="data as data.descripcion for data in datos_registro.parroquia track by data.cod_parroquia" ng-model="formData.parroquia" class="form-control" id="parroquia"  name="parroquia" required>
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.parroquia.$error.required">Campo Requerido</span>

                        </div>
                    </div>
                    <!------------------------------------------------------------------------------------------->
                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Etnia:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-options="data as data.descripcion for data in datos_registro.etnias track by data.id_etnia" ng-model="formData.etnia" class="form-control" id="etnia"  name="etnia" >
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.etnia.$error.required">Campo Requerido</span>


                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Discapacidad:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-options="data as data.descripcion for data in datos_registro.discapacidades track by data.id_discapacidad" ng-model="formData.discapacidad" class="form-control" id="discapacidad"  name="discapacidad" required="">
                                <option value=""><-- Seleccione una opción --></option>

                            </select>
                            <span class="label-red" ng-if="Form_validar_estudiante.$dirty && Form_validar_estudiante.discapacidad.$error.required">Campo Requerido</span>



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

   <button  ng-click="Form_validar_estudiante.$valid != false
                                    && (formData.correo2 == formData.correo)
                                    && formData.nacionalidad
                                    && cedula_validada
                                    && !formData.campo_existente ? registrar(formData) : ''" 

                                 ng-class="Form_validar_estudiante.$valid != false 
                                   && formData.correo2 == formData.correo 
                                    && formData.nacionalidad 
                                     && !formData.campo_existente
                                     && cedula_validada
                                     && !formData.correo_validado                           
                                     ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>
                          


                    </div>

                    <!--                                    <button  ng-click="Form_validar_estudiante.$valid != false
                                                                    ? registrar(formData) : ''" 
                    
                                                                 ng-class="Form_validar_estudiante.$valid != false 
                                                      ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Registrar </button>
                    -->

                </div>
            </div>

    </form>
</div>
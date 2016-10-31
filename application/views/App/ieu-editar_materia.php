<br>

<form id="solicitante_form" method="post" name="Form_modificar_materia"
      class="form-horizontal inicio">

    <div class="panel panel-primary">

        <div class="panel-heading">

            <h4>Editar Materia </h4>
        </div>
        <div class="panel-body">
            <fieldset style="text-align: left;">

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Nombre:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">
                        <input ng-model="formData2.nombre_materia"   type="text" class="form-control"
                               id="" name="nombre_materia"
                               placeholder="Nombre" required>
                        <span class="label-red" ng-if="Form_modificar_materia.$dirty && Form_modificar_materia.nombre_materia.$error.required">Campo Requerido</span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Unidades de crédito:</label>
                    <div class="control-label col-lg-4 col-md-4 col-xs-12">

                        <select  ng-model="formData2.unidades" class="form-control" id=""  name="unidades" required>
                            <option value=""><-- Seleccione una opción --></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>   
                            <option value="6">6</option>                                
                        </select>
                        <span class="label-red" ng-if="Form_modificar_materia.$dirty && Form_modificar_materia.unidades.$error.required">Campo Requerido</span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Tipo:</label>
                    <div class="control-label col-lg-6 col-md-6 col-xs-12">

                        <select   ng-model="formData2.tipo" class="form-control"  name="tipo" required>
                            <option value=""><-- Seleccione una opción --></option>
                            <option value="T">TEORICO</option>
                            <option value="P">PRACTICO</option>
                        </select>
                        <span class="label-red" ng-if="Form_modificar_materia.$dirty && Form_modificar_materia.tipo.$error.required">Campo Requerido</span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Horas académicas semanales:</label>
                    <div class="control-label col-lg-4 col-md-4 col-xs-12">

                        <select ng-model="formData2.horas_academicas" class="form-control" id=""  name="horas_academicas" required>
                            <option value=""><-- Seleccione una opción --></option>
                             <?php for($i = 1;$i <= 28;$i++){ ?>
                                
                                 <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                 
                                <?php } ?>

                        </select>
                        <span class="label-red" ng-if="Form_modificar_materia.$dirty && Form_modificar_materia.horas_academicas.$error.required">Campo Requerido</span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">

                        <select  ng-options="data as data.nombre_carrera for data in datos_registro2.carreras track by data.id_carrera" ng-model="formData2.carrera" class="form-control" id="destino_form"  name="carrera" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if="Form_modificar_materia.$dirty && Form_modificar_materia.carrera.$error.required">Campo Requerido</span>

                    </div>
                </div>
            </fieldset>
        </div>
        <div class="panel-footer">

            <div class="form-group">
                <div id="botoms" class=" col-xs-12  " style="text-align: center;">


                    <button   ng-click="formData2 = {}"  type="button" class="submit btn 

                              btn-success

                              ">
                        Limpiar   

                    </button>


                    <button  ng-click="Form_modificar_materia.$valid != false
                                ? modificar_materia(formData2) : ''" 

                             ng-class="Form_modificar_materia.$valid != false 
                                    ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Modificar </button>


                </div>

            </div>
        </div>
    </div>
</form>



<!-- /.col-lg-12 -->


<br>

<form id="solicitante_form" method="post" name="Form_modificar_carrera"
      class="form-horizontal inicio">

    <div class="panel panel-primary">

        <div class="panel-heading">

            <h4>Asignar/Editar Carrera </h4>
        </div>
        <div class="panel-body">
            <fieldset style="text-align: left;">

                <div class="form-group">
                    <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                    <div class="control-label col-lg-9 col-md-9 col-xs-12">

                        <select  ng-options="data as data.nombre_carrera for data in datos_registro2.carreras track by data.id_carrera" ng-model="formData2.carrera" class="form-control" id="destino_form"  name="carrera" required>
                            <option value=""><-- Seleccione una opción --></option>

                        </select>
                        <span class="label-red" ng-if="Form_modificar_carrera.$dirty && Form_modificar_carrera.carrera.$error.required">Campo Requerido</span>

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


                    <button  ng-click="Form_modificar_carrera.$valid != false
                                ? modificar_carrera_estudiante(formData2) : ''" 

                             ng-class="Form_modificar_carrera.$valid != false 
                                    ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Modificar </button>


                </div>

            </div>
        </div>
    </div>
</form>



<!-- /.col-lg-12 -->



    <form id="solicitante_form" method="post" name="Form_editar_carrera"
          class="form-horizontal inicio">

        <div class="panel panel-info">

            <div class="panel-heading">

                <h4>Editar carrera </h4>
                
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Nombre:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">
                            <input  ng-change="formData2.nombre_carrera?nombre_existente2(formData2.nombre_carrera):''" ng-model="formData2.nombre_carrera"   type="text" class="form-control"
                                   id="" name="nombre_carrera"
                                   placeholder="Nombre" required>
                            <span class="label-red" ng-if="Form_editar_carrera.$dirty && Form_editar_carrera.nombre_carrera.$error.required">Campo Requerido</span>
                            <span class="label-red" ng-if="Form_editar_carrera.$dirty && !Form_editar_carrera.nombre_carrera.$error.required && existente2 == true">Nombre Existente</span>

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


                    <button  ng-click="Form_editar_carrera.$valid != false && existente2 == false 
                        ? modificar_carrera(formData) : ''" 

                             ng-class="Form_editar_carrera.$valid != false  && existente2 == false 
                                    ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Modificar </button>

                </div>


            </div>
        </div>
</div>
</form>

<br>
<!--instalar capcha-->

<!-- /.row -->
<div class="row animated fadeIn">


    <form id="solicitante_form" method="post" name="Form_vincular_profesor_modificar"
          class="form-horizontal inicio" >

        <div class="panel panel-info " style="margin-left: 15px;margin-right: 15px;">

            <div class="panel-heading">

                <h4>Vincular Profesores </h4>
            </div>
            <div class="panel-body">
                <fieldset style="text-align: left;">

                    <div class="form-group">
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Profesor(a):</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12">

                            <select  ng-change="setear_data()"  ng-options="data as data.cedula+' - '+data.nombre1 +' '+data.apellido1 for data in datos_registro2.profesores track by data.cedula" ng-model="formData2.profesor" class="form-control" id="destino_form"  name="profesor" required>
                                <option value=""><-- Seleccione una opción --></option>
                            </select>
                            <span class="label-red" ng-if=" Form_vincular_profesor_modificar.profesor.$error.required">Campo Requerido</span>

                        </div>
                    </div>

                    <div class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12" style="text-align: left;color: #777;">

                            {{formData2.nombre_carrera}}
                        </div>
                    </div>

                    <div  class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Sección:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12" style="text-align: left;color: #777;">

                            {{formData2.nombre_seccion}}
                        </div>
                    </div>


                    <div class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Materia:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12" style="text-align: left;color: #777;">

                            {{formData2.nombre_materia}}
                        </div>
                    </div>

                    <div class="form-group animated fadeIn" >
                        <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Duración en semanas:</label>
                        <div class="control-label col-lg-9 col-md-9 col-xs-12" style="text-align: left;color: #777;">

                            {{formData2.duracion}}
                        </div>
                    </div>

            </div>
            <div class="panel-footer">


                <div class="form-group">
                    <div id="botoms" class=" col-xs-12  " style="text-align: center;">


                        <button   ng-click="formData = {}"  type="button" class="submit btn 

                                  btn-success

                                  ">
                            Limpiar   

                        </button>


                        <button  ng-click="Form_vincular_profesor_modificar.$valid

                                    ? modificar_vinclacion(formData2) : ''" 

                                 ng-class="Form_vincular_profesor_modificar.$valid 
                                            ? '' : 'disabled'" type="button" class="submit btn  btn-primary  "> Modificar </button>

                    </div>

                </div>

            </div>
        </div>
    </form>

</div>



<!-- /.col-lg-12 -->


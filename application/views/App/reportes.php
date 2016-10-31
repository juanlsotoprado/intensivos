<br>
<!-- /.row -->
<div class="row animated fadeIn">

    <div class="panel panel-info">
        <div class="panel-body">
            <br>
            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Cantidad maxima de registros:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select  ng-change="cantidad(registro_total, formData.cantidad_reg,universidades_reporte)"   ng-model="formData.cantidad_reg" class="form-control" id="destino_form"  name="cantidad" >
                        <option value="">100</option>
                        <option value="1000">1000</option>
                        <option value="3000">3000</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="20000">20000</option>
                        <option value="50000">50000</option>
                        <option value="100000">Mas de 50000</option>

                    </select>

                </div>
            </div>
            <br>
            <br>
            <div class="form-group">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Tipo reporte:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">

                    <select  ng-change="get_reporte()"   ng-model="formData.tipo_reporte" class="form-control" id="destino_form"  name="cantidad" >
                        <option value="">Seleccione una opción...</option>

                        <optgroup label="Reportes de data consistente">
                            <option value="reporte_cantidades_personas_tipo">Cantidad de personas por tipo de usuario</option>
                            <option value="reporte_cantidad_estudiante_ieu">Cantidad de estudiantes registardos, validados y postulados  por I.E.U</option>
                            <option value="reporte_cantidad_docente_ieu">Cantidad de docentes registrados y vinculados por I.E.U</option>
                            <option value="reporte_cantidad_estudiante_carrera_ieu">Cantidad de estudiantes por carrera e I.E.U</option>                           
                            <option value="reporte_cantidad_carreras_materias_secciones_por_ieu">Cantidad de carreras, materias y secciones por y I.E.U</option>
                            <option value="reporte_todas_carreras_materias_secciones_por_ieu">Carreras, materias y secciones por y I.E.U</option>
                            <option value="reporte1_para_el_calculo">Primer reporte para el calculo</option>
                            <option value="reporte2_para_el_calculo">Segundo reporte para el calculo</option>
                            <option value="reporte3_para_el_calculo">Tercer reporte para el calculo</option>


                        </optgroup>

                    </select>

                </div>
            </div>

            <br><br>
            <div class="form-group" ng-if="formData.tipo_reporte == 'reporte3_para_el_calculo'">
                <label class="control-label control-label col-lg-3 col-md-3 col-xs-12">Carrera:</label>
                <div class="control-label col-lg-9 col-md-9 col-xs-12">
                    
                    <select multiple  ng-change="cantidad(registro_total, formData.cantidad_reg,universidades_reporte)" ng-options="data as data.nombre_ieu for data in datos_registro.universidades track by data.id_ieu" ng-model="universidades_reporte" class="form-control" id="destino_form"  name="carrera" required>
                        <option value=""><-- Seleccione una opcion --></option>

                    </select>

                </div>
            </div>

        </div>

    </div>


    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Reportes </h4>
        </div>
        <div class="panel-body" style="text-align:center">


            <h3 ng-hide="data_visible"  >

                <em style="color: #777"> Selecione un tipo de solicitud... </em>    
            </h3>

            <h3 ng-hide="mostrar_reg && data_visible" >

                <em ng-show="data_visible" style="color: #777"  > Cargando datos , por favor espere...</em> <i ng-show="data_visible" class="fa fa-cog fa-spin fa-2x fa-fw"></i>


                <br>
                <br>
            </h3>
            <fieldset ng-show="mostrar_reg && data_visible" style="text-align: left;" class=" animated fadeIn">

                <div ng-include="vista_reporte" ></div>
            </fieldset>

        </div>



    </div>
    <!-- /.col-lg-12 -->


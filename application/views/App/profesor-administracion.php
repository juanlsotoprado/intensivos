<br>
<!-- /.row -->
<div class="row animated fadeIn">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h4>Administrar Profesores</h4>
        </div>
        <div class="panel-body">
            <fieldset style="text-align: left;">

                <div class="table-responsive">          
                    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
                        <col style="width: 2%">
                        <col style="width: 10%">

                        <thead>
                            <tr>
                                <th >#</th>
                                <th>Cédula de Identidad</th>
                                <th>Nombre(s)</th>
                                <th>Apellido(s)</th>
                                <th>I.E.U.</th>

                                <th style="min-width: 90px">Acción</th>

                            </tr>
                        </thead>

                        <tbody class="table_bandeja_apro_tbody">
                            <tr ng-repeat="(y,x) in busqueda.usuarios_ieu" >
                                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>
                                <td>{{x.cedula}}</td>
                                <td>{{x.nombre1 + " " + x.nombre2}}</td>
                                <td>{{x.apellido1 + " " + x.apellido2}}</td>
                                <td>{{x.nombre_ieu}}</td>


                                <td style="text-align: left;width: 200px;">
                                    <button ng-click="ver(x.cedula)"  class="btn btn-xs btn-primary "><i class="fa fa-eye  fa-1x" aria-hidden="true"></i>Ver<div class="ripple-container"></div></button>
                                    <button ng-click="editar(x.cedula)" href="javascript:void(0)" class="btn  btn-xs btn-warning "><i class="fa fa-edit fa-1x" aria-hidden="true"></i>Editar<div class="ripple-container"></div></button>
                                    <button ng-click="cambiar_estatus(x.cedula,x.activo == 't'?'false':'true',x.activo == 't'?'inactivar':'activar')" href="javascript:void(0)"   ng-class="x.activo == 't'?'btn-danger':'btn-success'" class="btn  btn-xs ">{{x.activo == 't'?'Inactivar':'Activar'}}<div class="ripple-container"></div></button>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </fieldset>

        </div>



    </div>
    <!-- /.col-lg-12 -->


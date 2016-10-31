<div class="table-responsive animated fadeIn">          
    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
        <col style="width: 2%">
        <col style="width: 40%">
        <col style="width: 30%">
         <col style="width: 18%">

        <thead>
            <tr>
                <th >#</th>
                <th>I.E.U.</th>
                <th>Carrera</th>
                <th>Cantidad</th>
            </tr>
        </thead>

        <tbody class="table_bandeja_apro_tbody">
            <tr ng-repeat="(y,x) in busqueda_reporte.datos" >
                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>

                <td>{{x.nombre_ieu}}</td>
                <td>{{x.nombre_carrera}}</td>
                <td>{{x.cantidad}}</td>
            </tr>
        </tbody>
    </table>
</div>
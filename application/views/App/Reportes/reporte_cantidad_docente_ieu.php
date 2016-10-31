<div class="table-responsive animated fadeIn">          
    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
        <col style="width: 2%">
        <col style="width: 70%">
         <col style="width: 28%">

        <thead>
            <tr>
                <th >#</th>
                <th>I.E.U.</th>
                <th>Reguistrados</th>
                <th>Vinculados</th>
                <th>Horas académicas</th>

            </tr>
        </thead>

        <tbody class="table_bandeja_apro_tbody">
            <tr ng-repeat="(y,x) in busqueda_reporte.datos" >
                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>

                <td>{{x.nombre_ieu}}</td>
                <td>{{x.registrados < 1? '0': x.registrados}}</td>
                <td>{{x.vinculados < 1? '0': x.vinculados}}</td>
                <td>{{x.horas < 1? '0': x.horas}}</td>
            </tr>
        </tbody>
    </table>
</div>
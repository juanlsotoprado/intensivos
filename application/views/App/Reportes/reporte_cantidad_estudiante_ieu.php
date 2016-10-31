<div class="table-responsive animated fadeIn">          
    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
        <col style="width: 2%">
        <col style="width: 70%">
         <col style="width: 28%">

        <thead>
            <tr>
                <th >#</th>
                <th>I.E.U.</th>
                <th>Registrados</th>
                <th>Validados</th>
                <th>Postulados</th>

            </tr>
        </thead>

        <tbody class="table_bandeja_apro_tbody">
            <tr ng-repeat="(y,x) in busqueda_reporte.datos" >
                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>

                <td>{{x.nombre_ieu}}</td>
                 <td>{{x.registrados < 1? '0': x.registrados}}</td>
                <td>{{x.validados < 1? '0': x.validados}}</td>
                <td>{{x.postulados < 1? '0': x.postulados}}</td>
            </tr>
        </tbody>
    </table>
</div>
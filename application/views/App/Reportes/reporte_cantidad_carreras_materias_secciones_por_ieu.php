<div class="table-responsive animated fadeIn">          
    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
        <col style="width: 2%">
        <col style="width: 70%">
         <col style="width: 28%">

        <thead>
            <tr>
                <th >#</th>
                <th>I.E.U.</th>
                <th>Carreras</th>
                <th>Materias</th>
                <th>Secciones</th>

            </tr>
        </thead>

        <tbody class="table_bandeja_apro_tbody">
            <tr ng-repeat="(y,x) in busqueda_reporte.datos" >
                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>

                
                
                <td>{{x.nombre_ieu }}</td>
                <td>{{x.carreras < 1? '0': x.carreras}}</td>
                <td>{{x.materias < 1? '0': x.materias}}</td>
                <td>{{x.secciones < 1? '0': x.secciones}}</td>
            </tr>
        </tbody>
    </table>
</div>
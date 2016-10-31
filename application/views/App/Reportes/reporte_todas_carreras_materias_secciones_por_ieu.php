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
                 <td>{{x.nombre_carrera }}</td>
                  <td>{{x.nombre_materia }}</td>
                   <td>{{x.nombre_seccion }}</td>
            
            </tr>
        </tbody>
    </table>
</div>
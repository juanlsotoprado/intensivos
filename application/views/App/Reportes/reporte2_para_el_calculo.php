<div class="table-responsive animated fadeIn">          
    <table datatable="ng" dt-options="dtOptions"table class="display  cell-border hover order-column stripe tabla_consulta"  cellspacing="0" width="100%">
        <col style="width: 2%">
        <col style="width: 70%">
         <col style="width: 28%">

        <thead>
            <tr>
                <th >#</th>
                <th>I.E.U.</th>
                <th>Secciónes</th>
                <th>Practicas</th>
                <th>Teoricas</th>
                <th>Profesores</th>
                <th>Horas académicas</th>
                <th>Estudiantes</th>

            </tr>
        </thead>

        <tbody class="table_bandeja_apro_tbody">
            <tr ng-repeat="(y,x) in busqueda_reporte.datos" >
                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>

                <td>{{x.nombre_ieu }}</td>
                 <td>{{x.cantidad_secciones < 1? '0': x.cantidad_secciones}}</td>
                  <td>{{x.cantidad_practica < 1? '0': x.cantidad_practica}}</td>
                   <td>{{x.cantidad_teorica < 1? '0': x.cantidad_teorica}}</td>
                    <td>{{x.profesores < 1? '0': x.profesores}}</td>
                     <td>{{x.horas < 1? '0': x.horas}}</td>
                      <td>{{x.estudiantes < 1? '0': x.estudiantes}}</td>
                
                
                 
            </tr>
        </tbody>
    </table>
</div>
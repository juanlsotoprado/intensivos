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
                
                 <th>Tipo sección</th>
                <th>Cédula profesor</th>
                <th>Nombre profesor</th>
                <th>Horas académicas</th>
                <th>Duración</th>
                <th>Cantidad estudiantes</th>


            </tr>
        </thead>

        <tbody class="table_bandeja_apro_tbody">
            <tr ng-repeat="(y,x) in busqueda_reporte.datos " >
                <td style="color:#337ab7; font-weight: bold">{{$index + 1}}</td>

                <td>{{x.nombre_ieu}}</td>
                <td>{{x.nombre_carrera}}</td>
                <td>{{x.nombre_materia}}</td>
                <td>{{x.seccion}}</td>
                
                <td>{{x.tipo_seccion}}</td>
                <td>{{x.cedula}}</td>
                <td>{{x.profesor}}</td>
                <td>{{x.horas_academicas}}</td>
                <td>{{x.duracion}}</td>
                <td>{{x.cantidad_est}}</td>

            </tr>
        </tbody>
    </table>
</div>
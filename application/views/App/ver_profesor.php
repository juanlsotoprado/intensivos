
<form enctype="multipart/form-data" method="post" class="form-horizontal inicio" name="Form_registrar">
    <div class="panel panel-default">
        <div class="panel-body" >
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="th-principal" style="width: 30%">Nacionalidad: </th>
                        <td class="letra_ver">  {{formData.nacionalidad == 'V'?'Venezolano':'Extranjero'}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Cédula de Identidad: </th>
                        <td class="letra_ver">  {{formData.cedula}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Primer nombre: </th>
                        <td class="letra_ver">  {{formData.nombre1}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Segundo nombre: </th>
                        <td class="letra_ver">  {{formData.nombre2}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Primer apellido: </th>
                        <td class="letra_ver">  {{formData.apellido1}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Segundo apellido: </th>
                        <td class="letra_ver">  {{formData.apellido2}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Genero: </th>
                        <td class="letra_ver">  {{formData.genero == 'F'?'Femenino':'Masculino'}} </td>
                    </tr>


                    <tr>
                        <th class="th-principal" style="width: 30%">N° de teléfono móvil: </th>
                        <td class="letra_ver">  {{formData.telefono_celular}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">N° de teléfono de habitación: </th>
                        <td class="letra_ver">  {{formData.telefono_hab}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Dirección de correo : </th>
                        <td class="letra_ver">  {{formData.correo_ppal}} </td>
                    </tr>
                    <tr>
                        <th class="th-principal" style="width: 30%">Dirección de correo (alternativo): </th>
                        <td class="letra_ver">  {{formData.correo_secundario}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">I.E.U.: </th>
                        <td class="letra_ver">  {{formData.nombre_ieu}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Estatus: </th>
                        <td class="letra_ver">  {{ formData.estatus == 't'?'Activo':'Inactivo'}} </td>
                    </tr>

                    <tr>
                        <th class="th-principal" style="width: 30%">Fecha de Ingreso: </th>
                        <td class="letra_ver">  {{formData.fecha}} </td>
                    </tr>


                </tbody>
            </table>
        </div>

    </div>

</form>
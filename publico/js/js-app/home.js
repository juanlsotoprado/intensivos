// Creación del módulo
var msn_exito = 'Se ha procesado  exitosamente';
var msn_error = 'Ha ocurrido un error al procesar';
var mppeuct = angular.module('mppeuct', ['ngRoute', 'ngSanitize', 'ngProgressLite', 'datatables']);

// Configuración de las rutas
mppeuct.config(['$routeProvider', 'ngProgressLiteProvider', function ($routeProvider, ngProgressLiteProvider) {

        // alert(base_url+'index.php/app/Inicio');

        // alert(id_perfil);

        if (id_perfil == 1 || id_perfil == 2) {

            if (id_perfil == 1) {

                $routeProvider
                        .when('/Funcionario_mppeuct', {
                            templateUrl: base_url + 'index.php/app/Registrar_usuario_mppeuct',
                            controller: 'Funcionario_mppeuct'
                        });
            }

            $routeProvider.when('/Registar_responsable', {
                templateUrl: base_url + 'index.php/app/Inicio',
                controller: 'Registar_responsable'

            });

            $routeProvider.when('/Gestionar_responsable', {
                templateUrl: base_url + 'index.php/app/Gestionar_ieu',
                controller: 'Gestionar_responsable'
            });

            $routeProvider.when('/Reportes', {
                templateUrl: base_url + 'index.php/app/Reportes',
                controller: 'Reportes'

            });


            $routeProvider.otherwise({
                redirectTo: '/Gestionar_responsable'
            });

        } else if (id_perfil == 3) {

            $routeProvider
                    .when('/Cambiar_clave', {
                        templateUrl: base_url + 'index.php/app/cambiar_clave',
                        controller: 'Cambiar_clave'
                    });

//            $routeProvider
//                    .when('/Descarga_de_archivo', {
//                        templateUrl: base_url + 'index.php/app/En_construccion',
//                        controller: 'Descarga_de_archivo'
//                    });

            $routeProvider
                    .when('/Instructivo', {
                        templateUrl: base_url + 'index.php/app/instructivo',
                        controller: 'Instructivo'
                    });

            $routeProvider
                    .when('/Oficio', {
                        templateUrl: base_url + 'index.php/app/oficio',
                        controller: 'Oficio'
                    });

            $routeProvider
                    .when('/Agregar_profesor', {
                        templateUrl: base_url + 'index.php/app/Agregar_profesor',
                        controller: 'Agregar_profesor'
                    });


            $routeProvider
                    .when('/Administrar_profesores', {
                        templateUrl: base_url + 'index.php/app/Gestionar_profesor',
                        controller: 'Administrar_profesores'
                    });


            $routeProvider
                    .when('/Administrar_postulaciones', {
                        templateUrl: base_url + 'index.php/app/Administrar_postulaciones',
                        controller: 'Administrar_postulaciones'
                    });


            $routeProvider
                    .when('/materia_profesor', {
                        templateUrl: base_url + 'index.php/app/En_construccion',
                        controller: 'materia_profesor'
                    });

            $routeProvider
                    .when('/Agregar_estudiante', {
                        templateUrl: base_url + 'index.php/app/Agregar_estudiante',
                        controller: 'Agregar_estudiante'
                    });


            $routeProvider
                    .when('/Administrar_estudiantes', {
                        templateUrl: base_url + 'index.php/app/Gestionar_estudiante',
                        controller: 'Administrar_estudiantes'
                    });



            $routeProvider
                    .when('/Administrar_seccion', {
                        templateUrl: base_url + 'index.php/app/Agregar_seccion',
                        controller: 'Agregar_seccion'
                    });



            $routeProvider
                    .when('/Administrar_materias', {
                        templateUrl: base_url + 'index.php/app/Agregar_materia',
                        controller: 'Administrar_materias'

                    });

            $routeProvider
                    .when('/Administrar_carreras', {
                        templateUrl: base_url + 'index.php/app/Administrar_carreras',
                        controller: 'Administrar_carreras'

                    });

            $routeProvider
                    .when('/Vincular_profesor', {
                        templateUrl: base_url + 'index.php/app/Vincular_profesor',
                        controller: 'Vincular_profesor'

                    });



            $routeProvider.otherwise({
                redirectTo: '/Instructivo'
            });

        } else if (id_perfil == 4) {

            $routeProvider
                    .when('/Postulacion', {
                        templateUrl: base_url + 'index.php/app/Postulacion',
                        controller: 'Postulacion'
                    });

            $routeProvider
                    .when('/Cambiar_clave', {
                        templateUrl: base_url + 'index.php/app/cambiar_clave',
                        controller: 'Cambiar_clave'
                    });


            $routeProvider.otherwise({
                redirectTo: '/Postulacion'
            });

        }
    }]);


mppeuct.controller('Reportes', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.busqueda = {};
        $scope.formData = {};
        $rootScope.universidades_reporte = false;


        $scope.cambiar_estatus = function (cedula, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + estatus_clave + ' a este(a) profesor(a)?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/set_estatus_profesor/", {cedula: cedula, estatus: estatus})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_profesores();
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };

        $http.post(base_url + "index.php/App_servicios/get_universidades/")
                .success(function (respuesta) {

                    //console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $rootScope.datos_registro = {universidades: respuesta.casos};

                    }

                    $timeout(function () {

                        ngProgressLite.done();
                        $rootScope.show = 1;
                        $rootScope.show2 = 1;
                    }, 0);

                }).error(function () {

            $timeout(function () {

                ngProgressLite.done();
                $rootScope.show = 1;
                $rootScope.show2 = 1;

            }, 0);

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });


        $scope.cantidad = function (reg_total, cantidad, ieu) {

            $rootScope.mostrar_reg = false;
            $scope.busqueda = {};

            cantidad = cantidad || 100;

            ieu = ieu || false;


            $timeout(function () {
                i = 1;
                var log = [];
                $scope.temp = [];


                // console.log($scope.formData.tipo_reporte);


                angular.forEach($scope.registro_total, function (value, key) {
                    if (i < cantidad) {


                        if (ieu != false) {

                            angular.forEach(ieu, function (value2, key2) {

                                if (value.id_ieu == value2.id_ieu) {

                                    $scope.temp.push(value);
                                    i++;

                                }
                            });

                        } else {

                            $scope.temp.push(value);

                            i++;
                        }




                    }

                }, log);



                $rootScope.busqueda_reporte = {datos: $scope.temp};

                // console.log($rootScope.busqueda_reporte);

                $timeout(function () {
                    $rootScope.mostrar_reg = true;

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;

                }, 100);


            }, 100);

        }


        $scope.get_reporte = function () {

            if ($scope.formData.tipo_reporte) {

                $scope.data_visible = true;

                $rootScope.mostrar_reg = false;


                $http.post(base_url + "index.php/App_servicios/" + $scope.formData.tipo_reporte + "/")
                        .success(function (respuesta) {

                            console.log(respuesta.casos);

                            if (String(respuesta.casos).trim() != 'false') {

                                $scope.vista_reporte = base_url + "index.php/App/Reportes_vistas/" + $scope.formData.tipo_reporte;

                                $scope.registro_total = respuesta.casos;


                                $scope.cantidad($scope.registro_total, 100);

                            }

                        }).error(function () {

                    console.log('error: index.php/App_servicios/get_profesores/');
                });

            } else {

                $scope.data_visible = false;

            }


        };

        $scope.get_reporte();

        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);


mppeuct.controller('Cambiar_clave', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        $scope.ver = false;
        ngProgressLite.start();
        $rootScope.liActive = $location.path();
        $scope.formData = {};

        $rootScope.modificar = function () {


            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea modificar la contraseña?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/cambiar_clave/", $scope.formData)
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': 'Contraseña invalida, por favor verifique sus datos.',
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': 'Contraseña invalida, por favor verifique sus datos.',
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });

        };



        $timeout(function () {

            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;

        }, 200);

    }]);

mppeuct.controller('app', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', function ($scope, $window, $rootScope, ngProgressLite, $timeout) {
        $rootScope.base_url = base_url;
        $rootScope.base_url_doc = base_url + 'privado/docs/';
        $rootScope.mostrar_reg = false;


    }]);

mppeuct.controller('Registar_responsable', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $rootScope.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
        $scope.formData.campo_existente = false;


        $scope.$watch('formData.campo_existente', function () {

            if ($scope.formData.campo_existente) {

                $scope.formData.primer_nombre = '';
                $scope.formData.segundo_nombre = '';
                $scope.formData.primer_apellido = '';
                $scope.formData.segundo_apellido = '';
                $scope.formData.genero = '';
                $scope.formData.nacionalidad = '';
            }

        });


        $scope.verificar_correo = function (correo) {
            $scope.formData.correo_validado = false;
            $http.post(base_url + "index.php/App_servicios/verificar_correo/", {correo: correo})
                    .success(function (respuesta) {


 
                       if (String(respuesta.casos).trim() != 'false') {

                            if (String(respuesta.casos).trim() != 'undefined') {

                                $scope.formData.correo_validado = true;
                            }

                        }

                        console.log('respuesta :' + $scope.formData.correo_validado);
                    }

                    ).error(function () {

                console.log('error');
            });
        };


        $http.post(base_url + "index.php/App_servicios/get_universidades/")
                .success(function (respuesta) {

                    //   console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.universidades = respuesta.casos;
                    }

                }).error(function () {

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });
        $scope.get_usuarios_ieu = function () {




            $http.post(base_url + "index.php/App_servicios/get_usuarios_ieu/")
                    .success(function (respuesta) {

                        //  console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.busqueda = {usuarios_ieu: respuesta.casos};
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/get_usuarios_ieu/');
            });
        };
        $scope.get_usuarios_ieu();

        $scope.cedula_busqueda = false;

        $scope.cedula_validada = true;

        $scope.cambio_cedula = function () {

            $scope.cedula_validada = false;
        };

        $scope.borrar_datos_estudiante = function () {

            $scope.formData.primer_nombre = '';
            $scope.formData.segundo_nombre = '';
            $scope.formData.primer_apellido = '';
            $scope.formData.segundo_apellido = '';
            $scope.formData.genero = '';
            $scope.formData.nacionalidad = '';

        };



        $scope.buscar_cedula = function (cedula) {

            $scope.cedula_busqueda = true;
            $scope.cedula_validada = true;


            $http.post(base_url + "index.php/App_servicios/get_datos_saime/", {cedula: cedula})
                    .success(function (respuesta) {



                        console.log(respuesta.casos);

                        $scope.formData.campo_existente = false;

                        if (String(respuesta.casos).trim() == 'undefined') {

                            $scope.borrar_datos_estudiante();

                        } else if (String(respuesta.casos.usuario_exitente).trim() == 'true') {

                            $scope.formData.campo_existente = true;
                            $scope.borrar_datos_estudiante();

                        } else if (String(respuesta.casos).trim() != 'false') {

                            $scope.formData.primer_nombre = respuesta.casos.primernombre;
                            $scope.formData.segundo_nombre = respuesta.casos.segundonombre;
                            $scope.formData.primer_apellido = respuesta.casos.primerapellido;
                            $scope.formData.segundo_apellido = respuesta.casos.segundoapellido;
                            $scope.formData.genero = respuesta.casos.sexo;
                            $scope.formData.nacionalidad = respuesta.casos.nacionalidad;

                        } else {

                            $scope.borrar_datos_estudiante();
                        }


                        $scope.cedula_busqueda = false;


                    }


                    ).error(function () {


                $scope.cedula_busqueda = false;
                console.log('error');
                $scope.funcionario_encontrado = false;
            });


        };


        $scope.registrar = function () {


            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar al Responsable IEU?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_usuario_ieu/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_usuarios_ieu();
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    $window.location = "#Registar_responsable/";
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': 'Error al registrar los datos.',
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $timeout(function () {

            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);

mppeuct.controller('Gestionar_responsable', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.busqueda = {};
        $rootScope.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
        $rootScope.modificar = function () {


            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea modificar al Responsable IEU?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/modificar_usuario_ieu/", $scope.formData)
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_usuarios_ieu();
                                    $("#mymodal").modal('hide');
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };

        $scope.restablecer = function (cedula, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea restablecer la contraseña a este Responsable IEU?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/set_restablecer_clave/", {cedula: cedula})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_usuarios_ieu();
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };

        $scope.cambiar_estatus = function (cedula, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + estatus_clave + ' a este Responsable IEU?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/set_estatus_ieu/", {cedula: cedula, estatus: estatus})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_usuarios_ieu();
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $scope.ver = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $http.post(base_url + "index.php/App_servicios/get_ver_usuario_ieu/", {cedula: data})
                    .success(function (respuesta) {
                        $rootScope.formData = {};
                        if (String(respuesta.casos).trim() != "false") {

                            // console.log(respuesta.casos[data]);

                            $rootScope.formData = respuesta.casos[data];
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Responsable IEU',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Ver_caso'
                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }
                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };
        $scope.editar = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData = {};
            $http.post(base_url + "index.php/App_servicios/get_ver_usuario_ieu/", {cedula: data})
                    .success(function (respuesta) {

                        if (String(respuesta.casos).trim() != "false") {

                            // console.log(respuesta.casos[data]);

                            $rootScope.formData2 = respuesta.casos[data];
                            if ($rootScope.formData2.telefono_celular < 1) {

                                $rootScope.formData2.telefono_celular = "";
                            }


                            if ($rootScope.formData2.telefono_hab < 1) {

                                $rootScope.formData2.telefono_hab = "";
                            }


                            $rootScope.formData = $rootScope.formData2;
                            $rootScope.formData.correo2 = $rootScope.formData.correo_ppal;
                            $rootScope.formData.universidad = {id_ieu: $rootScope.formData.id_ieu, nombre_ieu: $rootScope.formData.nombre_ieu};
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Responsable IEU',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Edtar_ieu'
                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }
                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };


        $http.post(base_url + "index.php/App_servicios/get_universidades/")
                .success(function (respuesta) {

                    //console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $rootScope.datos_registro = {universidades: respuesta.casos};


                    }

                    $timeout(function () {

                        ngProgressLite.done();
                        $rootScope.show = 1;
                        $rootScope.show2 = 1;
                    }, 0);

                }).error(function () {
            $timeout(function () {

                ngProgressLite.done();
                $rootScope.show = 1;
                $rootScope.show2 = 1;
            }, 0);

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });



        $scope.get_usuarios_ieu = function () {

            $http.post(base_url + "index.php/App_servicios/get_usuarios_ieu/")
                    .success(function (respuesta) {

                        //  console.log(respuesta.casos);
                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.busqueda = {usuarios_ieu: respuesta.casos};
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/get_usuarios_ieu/');
            });
        };
        $scope.get_usuarios_ieu();
        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);

mppeuct.controller('Descarga_de_archivo', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $timeout(function () {
            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);


mppeuct.controller('Instructivo', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $timeout(function () {
            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);

mppeuct.controller('Oficio', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $timeout(function () {
            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);



mppeuct.controller('Agregar_profesor', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $rootScope.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
        $scope.formData.campo_existente = false;
        $scope.verificar_correo = function (correo) {
            $scope.formData.correo_validado = false;


            $http.post(base_url + "index.php/App_servicios/verificar_correo/", {correo: correo})


                    .success(function (respuesta) {
                        $scope.formData.correo_validado = false;

                        if (String(respuesta.casos).trim() != 'false') {

                            if (String(respuesta.casos).trim() != 'undefined') {

                                $scope.formData.correo_validado = true;
                            }

                        }

                        console.log('respuesta :' + $scope.formData.correo_validado);
                    }

                    ).error(function () {

                console.log('error');
            });
        };
        $scope.$watch('formData.campo_existente', function () {

            if ($scope.formData.campo_existente) {

                $scope.formData.primer_nombre = '';
                $scope.formData.segundo_nombre = '';
                $scope.formData.primer_apellido = '';
                $scope.formData.segundo_apellido = '';
                $scope.formData.genero = '';
                $scope.formData.nacionalidad = '';
            }



        });


        $scope.cedula_busqueda = false;

        $scope.cedula_validada = true;

        $scope.cambio_cedula = function () {

            $scope.cedula_validada = false;
        };

        $scope.borrar_datos_estudiante = function () {

            $scope.formData.primer_nombre = '';
            $scope.formData.segundo_nombre = '';
            $scope.formData.primer_apellido = '';
            $scope.formData.segundo_apellido = '';
            $scope.formData.genero = '';
            $scope.formData.nacionalidad = '';

        };



        $scope.buscar_cedula = function (cedula) {

            $scope.cedula_busqueda = true;
            $scope.cedula_validada = true;


            $http.post(base_url + "index.php/App_servicios/get_datos_saime_profesor_estudiante/", {cedula: cedula})
                    .success(function (respuesta) {



                        //  console.log(respuesta.casos);

                        $scope.formData.campo_existente = false;

                        if (String(respuesta.casos).trim() == 'undefined') {

                            $scope.borrar_datos_estudiante();

                        } else if (String(respuesta.casos.usuario_exitente).trim() == 'true') {

                            $scope.formData.campo_existente = true;
                            $scope.borrar_datos_estudiante();

                        } else if (String(respuesta.casos).trim() != 'false') {

                            $scope.formData.primer_nombre = respuesta.casos.primernombre;
                            $scope.formData.segundo_nombre = respuesta.casos.segundonombre;
                            $scope.formData.primer_apellido = respuesta.casos.primerapellido;
                            $scope.formData.segundo_apellido = respuesta.casos.segundoapellido;
                            $scope.formData.genero = respuesta.casos.sexo;
                            $scope.formData.nacionalidad = respuesta.casos.nacionalidad;

                        } else {

                            $scope.borrar_datos_estudiante();
                        }


                        $scope.cedula_busqueda = false;


                    }


                    ).error(function () {


                $scope.cedula_busqueda = false;
                console.log('error');
                $scope.funcionario_encontrado = false;
            });


        };

        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar a este(a) profesor(a)?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_profesor/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    $window.location = "#Agregar_profesor/";
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $timeout(function () {

            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);

mppeuct.controller('Administrar_profesores', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.busqueda = {};
        $rootScope.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
        $rootScope.modificar = function () {


            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea modificar a este(a) profesor(a)',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/modificar_profesor/", $scope.formData)
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_profesores();
                                    $("#mymodal").modal('hide');
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $scope.cambiar_estatus = function (cedula, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + estatus_clave + ' a este(a) profesor(a)?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/set_estatus_profesor/", {cedula: cedula, estatus: estatus})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $scope.get_profesores();
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $scope.ver = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $http.post(base_url + "index.php/App_servicios/get_ver_profesor/", {cedula: data})
                    .success(function (respuesta) {
                        $rootScope.formData = {};
                        if (String(respuesta.casos).trim() != "false") {

                            // console.log(respuesta.casos[data]);

                            $rootScope.formData = respuesta.casos[data];
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Profesor(a)',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Ver_profesor'
                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }
                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };
        $scope.editar = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData = {};
            $http.post(base_url + "index.php/App_servicios/get_ver_profesor/", {cedula: data})
                    .success(function (respuesta) {
                        //  console.log(respuesta);
                        if (String(respuesta.casos).trim() != "false") {

                            //  console.log(respuesta.casos[data]);
                            $rootScope.formData2 = respuesta.casos[data];
                            if ($rootScope.formData2.telefono_celular < 1) {

                                $rootScope.formData2.telefono_celular = "";
                            }


                            if ($rootScope.formData2.telefono_hab < 1) {

                                $rootScope.formData2.telefono_hab = "";
                            }

                            $rootScope.formData = $rootScope.formData2;
                            $rootScope.formData.correo2 = $rootScope.formData.correo_ppal;
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Responsable IEU',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Edtar_profesor'
                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }
                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };
        $http.post(base_url + "index.php/App_servicios/get_universidades/")
                .success(function (respuesta) {

                    //console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $rootScope.datos_registro = {universidades: respuesta.casos};


                    }

                    $timeout(function () {

                        ngProgressLite.done();
                        $rootScope.show = 1;
                        $rootScope.show2 = 1;
                    }, 0);

                }).error(function () {

            $timeout(function () {

                ngProgressLite.done();
                $rootScope.show = 1;
                $rootScope.show2 = 1;
            }, 0);

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });
        $scope.get_profesores = function () {

            $http.post(base_url + "index.php/App_servicios/get_profesores/")
                    .success(function (respuesta) {

                        //    console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.busqueda = {usuarios_ieu: respuesta.casos};
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/get_profesores/');
            });
        };
        $scope.get_profesores();
        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);

mppeuct.controller('Agregar_estudiante', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $rootScope.ph_numbr = '^\+?\d\d\d\d\d\d\d\d\d\d\d\d\d$/';
        $scope.formData.campo_existente = false;

        $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                .success(function (respuesta) {

                    // console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.carreras = respuesta.casos;
                    }

                }).error(function () {


            console.log('error: index.php/App_servicios/get_carreras_ieu/');
        });



        $scope.$watch('formData.campo_existente', function () {


            if ($scope.formData.campo_existente == true) {

                $scope.formData.primer_nombre = '';
                $scope.formData.segundo_nombre = '';
                $scope.formData.primer_apellido = '';
                $scope.formData.segundo_apellido = '';
                $scope.formData.genero = '';
                $scope.formData.nacionalidad = '';
            }

        });



        $scope.verificar_correo = function (correo) {
            $scope.formData.correo_validado = false;





            $http.post(base_url + "index.php/App_servicios/verificar_correo/", {correo: correo})
                    .success(function (respuesta) {



                        if (String(respuesta.casos).trim() != 'false') {

                            if (String(respuesta.casos).trim() != 'undefined') {

                                $scope.formData.correo_validado = true;
                            }

                        }

                        console.log('respuesta :' + $scope.formData.correo_validado);
                    }

                    ).error(function () {

                console.log('error');
            });
        };


        $scope.cedula_busqueda = false;

        $scope.cedula_validada = true;

        $scope.cambio_cedula = function () {

            $scope.cedula_validada = false;
        };

        $scope.borrar_datos_estudiante = function () {

            $scope.formData.primer_nombre = '';
            $scope.formData.segundo_nombre = '';
            $scope.formData.primer_apellido = '';
            $scope.formData.segundo_apellido = '';
            $scope.formData.genero = '';
            $scope.formData.nacionalidad = '';

        };



        $scope.buscar_cedula = function (cedula) {

            $scope.cedula_busqueda = true;
            $scope.cedula_validada = true;


            $http.post(base_url + "index.php/App_servicios/get_datos_saime_profesor_estudiante/", {cedula: cedula})
                    .success(function (respuesta) {



                        //  console.log(respuesta.casos);

                        $scope.formData.campo_existente = false;

                        if (String(respuesta.casos).trim() == 'undefined') {

                            $scope.borrar_datos_estudiante();

                        } else if (String(respuesta.casos.usuario_exitente).trim() == 'true') {

                            $scope.formData.campo_existente = true;
                            $scope.borrar_datos_estudiante();

                        } else if (String(respuesta.casos).trim() != 'false') {

                            $scope.formData.primer_nombre = respuesta.casos.primernombre;
                            $scope.formData.segundo_nombre = respuesta.casos.segundonombre;
                            $scope.formData.primer_apellido = respuesta.casos.primerapellido;
                            $scope.formData.segundo_apellido = respuesta.casos.segundoapellido;
                            $scope.formData.genero = respuesta.casos.sexo;
                            $scope.formData.nacionalidad = respuesta.casos.nacionalidad;

                        } else {

                            $scope.borrar_datos_estudiante();
                        }


                        $scope.cedula_busqueda = false;


                    }


                    ).error(function () {


                $scope.cedula_busqueda = false;
                console.log('error');
                $scope.funcionario_encontrado = false;
            });


        };
        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar al estudiante?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_estudiante/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    $window.location = "#Agregar_estudiante/";
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $timeout(function () {

            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);

mppeuct.controller('Descarga_de_archivo', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $timeout(function () {
            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);


mppeuct.controller('Administrar_postulaciones', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.busqueda = {};
        $scope.formData = {};
        $scope.datos_registro = {};

        $scope.cambiar_estatus = function (id, estatus) {

            postulacion = estatus == true ? 'aceptar' : 'rechazar';
            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + postulacion + ' la postulación del estudiante?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/set_estatus_postulacion/", {id: id, estatus: estatus == true ? 'true' : 'false'})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $window.location = "#Administrar_postulaciones/";
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });

                }, 'onDeny': function () {
                }

            });

        };


        $scope.cantidad = function (reg_total, cantidad) {

            cantidad = cantidad || 100;

            $rootScope.mostrar_reg = false;


            $timeout(function () {
                i = 1;
                x = 1;
                var log = [];

                $scope.temp = []

                angular.forEach($scope.registro_total, function (value, key) {


                    if (i < cantidad) {

                        $scope.temp.push(value);

                        i++;
                    }


                }, log);


                $scope.busqueda = {usuarios_ieu: $scope.temp};

                $timeout(function () {
                    $rootScope.mostrar_reg = true;

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;

                }, 100);


            }, 100);



        }

        $scope.get_estudiantes = function () {

            $http.post(base_url + "index.php/App_servicios/get_postulaciones_realizadas/")
                    .success(function (respuesta) {

                        //   console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.registro_total = respuesta.casos;

                            $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                                    .success(function (respuesta) {

                                        // console.log(respuesta.casos);

                                        if (String(respuesta.casos).trim() != 'false') {

                                            $scope.datos_registro.carreras = respuesta.casos;

                                        }

                                    }).error(function () {


                                console.log('error: index.php/App_servicios/get_carreras_ieu/');
                            });


                            $http.post(base_url + "index.php/App_servicios/Get_materias/")
                                    .success(function (respuesta) {

                                        // console.log(respuesta.casos);

                                        if (String(respuesta.casos).trim() != 'false') {

                                            $scope.datos_registro.materias = respuesta.casos;
                                        }

                                    }).error(function () {

                                console.log('error: index.php/App_servicios/get_carreras_ieu/');
                            });


                            $http.post(base_url + "index.php/App_servicios/get_secciones_profesor/")
                                    .success(function (respuesta) {

                                        //  console.log(respuesta.casos);

                                        if (String(respuesta.casos).trim() != 'false') {

                                            $scope.datos_registro.secciones = respuesta.casos;
                                        }

                                    }).error(function () {

                                console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
                            });

                        }


                        $scope.cantidad($scope.registro_total, 100);


                    }).error(function () {

                console.log('error: index.php/App_servicios/get_estudiantes/');
            });
        };

        $scope.get_estudiantes();
        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);


mppeuct.controller('Administrar_estudiantes', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.busqueda = {};
        $scope.formData = {};
        $scope.datos_registro = {};
        $rootScope.ph_numbr = '/^\+?\d\d\d\d\d\d\d\d\d\d\d$/';



        $rootScope.modificar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea modificar el estudiante',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/modificar_estudiante/", $scope.formData)
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $("#mymodal").modal('hide');
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.get_estudiantes();
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };


        $scope.restablecer = function (cedula, n1, a1, cv) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea restablecer la contraseña a este estudiante?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/set_restablecer_clave_estudiante/", {cedula: cedula, nombre1: n1, apellido1: a1, correo: cv})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.get_estudiantes();
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };


        $scope.cambiar_estatus = function (cedula, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + estatus_clave + ' el estudiante?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/set_estatus_estudiante/", {cedula: cedula, estatus: estatus})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.get_estudiantes();
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': 'No se ha ' + estatus_clave + ' al estudiante.',
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };


        $scope.ver = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $http.post(base_url + "index.php/App_servicios/get_ver_estudiante/", {cedula: data})
                    .success(function (respuesta) {
                        $rootScope.formData = {};
                        if (String(respuesta.casos).trim() != "false") {

                            // console.log(respuesta.casos[data]);

                            $rootScope.formData = respuesta.casos[data];
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Estudiante',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Ver_estudiante'
                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }
                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };
        $scope.editar = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData = {};
            $http.post(base_url + "index.php/App_servicios/get_ver_estudiante/", {cedula: data})
                    .success(function (respuesta) {
                        // console.log(respuesta);
                        if (String(respuesta.casos).trim() != "false") {

                            //  console.log(respuesta.casos[data]);
                            $rootScope.formData2 = respuesta.casos[data];
                            $rootScope.formData2.telefono_celular = parseInt($rootScope.formData2.telefono_celular);
                            $rootScope.formData2.telefono_hab = parseInt($rootScope.formData2.telefono_hab);
                            $rootScope.formData = $rootScope.formData2;
                            $rootScope.formData.correo2 = $rootScope.formData.correo_ppal;
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Responsable IEU',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Edtar_estudiante'
                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }
                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };


        $scope.cambiar_carrera = function (cedula) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData2 = {};
            $rootScope.datos_registro2 = {};

            $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                    .success(function (respuesta) {

                        // console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.datos_registro2.carreras = respuesta.casos;
                        }



                    }).error(function () {


                console.log('error: index.php/App_servicios/get_carreras_ieu/');
            });


            $rootScope.modificar_carrera_estudiante = function () {

                $.jAlert({'type': 'confirm',
                    'title': '¡Responder!',
                    'size': 'md',
                    'theme': 'black',
                    'backgroundColor': 'white',
                    'confirmQuestion': '¿Esta seguro que desea Editar/Asignar una carrera a este estudiante.',
                    'confirmBtnText': 'Si', 'denyBtnText': 'No',
                    'showAnimation': 'flipInX',
                    'hideAnimation': 'flipOutX',
                    'onConfirm': function () {
                        $scope.formData2.cedula = cedula;

                        $http.post(base_url + "index.php/App_servicios/modificar_carrera_estudiante/", $scope.formData2)
                                .success(function (respuesta) {

                                    // console.log(respuesta.casos);
                                    if (String(respuesta.casos).trim() != 'false') {

                                        $("#mymodal").modal('hide');
                                        $.jAlert({
                                            'title': '¡Éxito!',
                                            'content': msn_exito,
                                            'theme': 'green',
                                            'size': 'md',
                                            'showAnimation': 'bounceInDown',
                                            'hideAnimation': 'bounceOutDown',
                                            'btns': {'text': 'Aceptar', 'theme': 'green'}
                                        });
                                        $window.location = "#Administrar_estudiantes/";
                                        // $rootScope.get_secciones2();
                                    } else {
                                        $.jAlert({
                                            'title': '¡Error!.',
                                            'content': msn_error,
                                            'theme': 'red',
                                            'size': 'md',
                                            'showAnimation': 'bounceInDown',
                                            'hideAnimation': 'bounceOutDown',
                                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                                        });
                                    }
                                }).error(function () {
                            $.jAlert({
                                'title': '¡Error!.',
                                'content': msn_error,
                                'theme': 'red',
                                'size': 'md',
                                'showAnimation': 'bounceInDown',
                                'hideAnimation': 'bounceOutDown',
                                'btns': {'text': 'Aceptar', 'theme': 'red'}
                            });
                            console.log('error');
                        });
                    }, 'onDeny': function () {
                    }
                });
            }


            $rootScope.modal = {header_menu: true};
            $rootScope.modal = {
                caso: cedula,
                header: 'Asignar/Editar',
                body: 'body',
                footer: "",
                data: 'data',
                id: 'id',
                tipo: 'tipo',
                tiempo: true,
                template: base_url + 'index.php/app/Editar_carrera'

            };
            $("#mymodal").modal();
            ngProgressLite.done();

        };

        $http.post(base_url + "index.php/App_servicios/get_universidades/")
                .success(function (respuesta) {

                    //console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $rootScope.datos_registro = {universidades: respuesta.casos};
                    }

                }).error(function () {

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });



        $scope.cantidad = function (reg_total, cantidad, carrera) {

            cantidad = cantidad || 100;

            carrera = carrera || false;

            $rootScope.mostrar_reg = false;


            $timeout(function () {
                i = 1;
                x = 1;
                var log = [];

                $scope.temp = []

                angular.forEach($scope.registro_total, function (value, key) {

                    if (!carrera) {


                        if (i < cantidad && value.id_carrera < 1) {

                            $scope.temp.push(value);

                            i++;
                        }


                    } else {

                        if (i < cantidad && carrera.id_carrera == value.id_carrera) {

                            $scope.temp.push(value);

                            i++;
                        }
                    }


                }, log);


                $scope.busqueda = {usuarios_ieu: $scope.temp};

                $timeout(function () {
                    $rootScope.mostrar_reg = true;

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;

                }, 100);


            }, 100);



        }

        $scope.get_estudiantes = function () {

            $http.post(base_url + "index.php/App_servicios/get_estudiantes/")
                    .success(function (respuesta) {

                        //  console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.registro_total = respuesta.casos;

                            //  $scope.busqueda = {usuarios_ieu: respuesta.casos};

                            $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                                    .success(function (respuesta) {

                                        // console.log(respuesta.casos);

                                        if (String(respuesta.casos).trim() != 'false') {

                                            $scope.datos_registro.carreras = respuesta.casos;

                                            var i = 1;
                                            angular.forEach($scope.datos_registro.carreras, function (value, key) {

                                                if (i == 1) {

                                                    $scope.formData.carrera = value;

                                                    $scope.cantidad($scope.registro_total, 100, $scope.formData.carrera);

                                                }

                                                i++;
                                            });



                                        }


                                    }).error(function () {


                                console.log('error: index.php/App_servicios/get_carreras_ieu/');
                            });


                        } else {

                            $scope.cantidad($scope.registro_total, 100, 0);

                        }


                    }).error(function () {

                console.log('error: index.php/App_servicios/get_estudiantes/');
            });
        };

        $scope.get_estudiantes();
        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);



mppeuct.controller('Administrar_carreras', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.formData3 = {};
        $rootScope.datos_registro = {};

        $rootScope.nombre_existente = function (data) {
            $scope.existente = false;
            if (data.trim() != '') {

                angular.forEach($rootScope.datos_registro.carreras, function (value, key) {

                    if (value.nombre_carrera.toUpperCase() == data.trim().toUpperCase()) {

                        $scope.existente = true;
                    }

                });

            }
        };

        $scope.get_carreras = function () {


            $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                    .success(function (respuesta) {

                        // console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $rootScope.datos_registro.carreras = respuesta.casos;

                        }

                        $timeout(function () {

                            ngProgressLite.done();
                            $rootScope.show = 1;
                            $rootScope.show2 = 1;
                        }, 0);

                    }).error(function () {


                $timeout(function () {

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;
                }, 0);

                console.log('error: index.php/App_servicios/get_carreras_ieu/');
            });
        };

        $scope.get_carreras();



        $scope.editar = function (data, nombre_carrera) {
            $rootScope.existente2 = false;
            $rootScope.nombre_existente2 = function (data) {

                $rootScope.existente2 = false;
                if (data.trim() != '') {

                    angular.forEach($rootScope.datos_registro.carreras, function (value, key) {

                        if (value.nombre_carrera.toUpperCase() == data.trim().toUpperCase()) {

                            $rootScope.existente2 = true;
                        }

                    });

                }
            };

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData2 = {};
            $rootScope.datos_registro2 = {};

            $rootScope.modificar_carrera = function () {

                $.jAlert({'type': 'confirm',
                    'title': '¡Responder!',
                    'size': 'md',
                    'theme': 'black',
                    'backgroundColor': 'white',
                    'confirmQuestion': '¿Esta seguro que desea modificar la carrera.',
                    'confirmBtnText': 'Si', 'denyBtnText': 'No',
                    'showAnimation': 'flipInX',
                    'hideAnimation': 'flipOutX',
                    'onConfirm': function () {

                        $http.post(base_url + "index.php/App_servicios/modificar_carrera/", {nombre_carrera: $scope.formData2.nombre_carrera, id_carrera: data})
                                .success(function (respuesta) {

                                    // console.log(respuesta.casos);
                                    if (String(respuesta.casos).trim() != 'false') {

                                        $("#mymodal").modal('hide');
                                        $.jAlert({
                                            'title': '¡Éxito!',
                                            'content': msn_exito,
                                            'theme': 'green',
                                            'size': 'md',
                                            'showAnimation': 'bounceInDown',
                                            'hideAnimation': 'bounceOutDown',
                                            'btns': {'text': 'Aceptar', 'theme': 'green'}
                                        });
                                        $window.location = "#Administrar_carreras/";
                                        // $rootScope.get_secciones2();
                                    } else {
                                        $.jAlert({
                                            'title': '¡Error!.',
                                            'content': msn_error,
                                            'theme': 'red',
                                            'size': 'md',
                                            'showAnimation': 'bounceInDown',
                                            'hideAnimation': 'bounceOutDown',
                                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                                        });
                                    }
                                }).error(function () {
                            $.jAlert({
                                'title': '¡Error!.',
                                'content': msn_error,
                                'theme': 'red',
                                'size': 'md',
                                'showAnimation': 'bounceInDown',
                                'hideAnimation': 'bounceOutDown',
                                'btns': {'text': 'Aceptar', 'theme': 'red'}
                            });
                            console.log('error');
                        });
                    }, 'onDeny': function () {
                    }
                });
            };

            $rootScope.nombre_existente2(nombre_carrera);
            $rootScope.formData2.nombre_carrera = nombre_carrera;

            $rootScope.modal = {header_menu: true};
            $rootScope.modal = {
                caso: false,
                header: 'Editar carrera',
                body: 'body',
                footer: "",
                data: 'data',
                id: 'id',
                tipo: 'tipo',
                tiempo: true,
                template: base_url + 'index.php/app/Edtar_carrera'

            };
            $("#mymodal").modal();
            ngProgressLite.done();





        };

        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar la carrera ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_carrera/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    $scope.get_carreras();
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);

mppeuct.controller('Administrar_materias', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.formData3 = {};
        $scope.datos_registro = {};
        $rootScope.mostrar_reg = false;



        $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                .success(function (respuesta) {

                    // console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.carreras = respuesta.casos;

                    }

                    $timeout(function () {

                        ngProgressLite.done();
                        $rootScope.show = 1;
                        $rootScope.show2 = 1;
                    }, 0);

                }).error(function () {

            $timeout(function () {

                ngProgressLite.done();
                $rootScope.show = 1;
                $rootScope.show2 = 1;
            }, 0);

            console.log('error: index.php/App_servicios/get_carreras_ieu/');
        });



        $http.post(base_url + "index.php/App_servicios/get_secciones/")
                .success(function (respuesta) {

                    //  console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.secciones = respuesta.casos;
                    }

                }).error(function () {

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });

        $scope.cantidad = function (reg_total, cantidad, carrera) {

            cantidad = cantidad || 100;

            carrera = carrera || false;

            $rootScope.mostrar_reg = false;


            $timeout(function () {
                i = 1;
                x = 1;
                var log = [];

                $scope.temp = []

                angular.forEach($scope.registro_total, function (value, key) {

                    if (!carrera) {


                        if (i < cantidad && value.id_carrera < 1) {

                            $scope.temp.push(value);

                            i++;
                        }


                    } else {

                        if (i < cantidad && carrera.id_carrera == value.id_carrera) {

                            $scope.temp.push(value);

                            i++;
                        }
                    }


                }, log);


                $scope.busqueda = {materias: $scope.temp};

                $timeout(function () {
                    $rootScope.mostrar_reg = true;

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;

                }, 100);


            }, 100);



        }

        $scope.get_materias = function () {

            $http.post(base_url + "index.php/App_servicios/get_materias/")
                    .success(function (respuesta) {

                        //   console.log(respuesta);
                        if (String(respuesta.casos).trim() != 'false') {


                            $scope.registro_total = respuesta.casos;
                            $scope.formData3.carrera = $scope.datos_registro.carreras[0];


                            $scope.cantidad($scope.registro_total, 100, $scope.formData3.carrera);
                        }

                        $timeout(function () {

                            ngProgressLite.done();
                            $rootScope.show = 1;
                            $rootScope.show2 = 1;
                        }, 0);

                    }).error(function () {

                $timeout(function () {

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;
                }, 0);

                console.log('error: index.php/App_servicios/get_secciones/');
            });
        };

        $scope.get_materias();
        $scope.cambiar_estatus = function (id_materia, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + estatus_clave + ' la materia ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/Set_estatus_materia/", {id_materia: id_materia, estatus: estatus})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.get_materias();
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }



                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };


        $scope.editar = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData2 = {};
            $rootScope.datos_registro2 = {};

            $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                    .success(function (respuesta) {

                        // console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.datos_registro2.carreras = respuesta.casos;
                        }



                    }).error(function () {


                console.log('error: index.php/App_servicios/get_carreras_ieu/');
            });


            $rootScope.modificar_materia = function () {

                $.jAlert({'type': 'confirm',
                    'title': '¡Responder!',
                    'size': 'md',
                    'theme': 'black',
                    'backgroundColor': 'white',
                    'confirmQuestion': '¿Esta seguro que desea modificar la materia.',
                    'confirmBtnText': 'Si', 'denyBtnText': 'No',
                    'showAnimation': 'flipInX',
                    'hideAnimation': 'flipOutX',
                    'onConfirm': function () {

                        $http.post(base_url + "index.php/App_servicios/modificar_materia/", $scope.formData2)
                                .success(function (respuesta) {

                                    // console.log(respuesta.casos);
                                    if (String(respuesta.casos).trim() != 'false') {

                                        $("#mymodal").modal('hide');
                                        $.jAlert({
                                            'title': '¡Éxito!',
                                            'content': msn_exito,
                                            'theme': 'green',
                                            'size': 'md',
                                            'showAnimation': 'bounceInDown',
                                            'hideAnimation': 'bounceOutDown',
                                            'btns': {'text': 'Aceptar', 'theme': 'green'}
                                        });
                                        $window.location = "#Administrar_materias/";
                                        // $rootScope.get_secciones2();
                                    } else {
                                        $.jAlert({
                                            'title': '¡Error!.',
                                            'content': msn_error,
                                            'theme': 'red',
                                            'size': 'md',
                                            'showAnimation': 'bounceInDown',
                                            'hideAnimation': 'bounceOutDown',
                                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                                        });
                                    }
                                }).error(function () {
                            $.jAlert({
                                'title': '¡Error!.',
                                'content': msn_error,
                                'theme': 'red',
                                'size': 'md',
                                'showAnimation': 'bounceInDown',
                                'hideAnimation': 'bounceOutDown',
                                'btns': {'text': 'Aceptar', 'theme': 'red'}
                            });
                            console.log('error');
                        });
                    }, 'onDeny': function () {
                    }
                });
            }

            $http.post(base_url + "index.php/App_servicios/get_materia_id/", {id_materia: data})
                    .success(function (respuesta) {
                        if (String(respuesta.casos).trim() != "false") {

                            //  console.log(respuesta.casos);

                            $rootScope.formData2 = respuesta.casos;


                            $rootScope.formData2.unidades = $rootScope.formData2.unidad_credito;
                            $rootScope.formData2.carrera = {id_carrera: $rootScope.formData2.id_carrera, nombre_carrera: $rootScope.formData2.nombre_carrera};

                            console.log($rootScope.formData2);
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Editar materia',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Edtar_materia'

                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }


                    }

                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };

        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar la ateria ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_materia/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    $scope.get_materias();
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);

mppeuct.controller('Postulacion', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {
        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};

        $scope.datos_registro.existe_carrera = false;


//          $http.post(base_url + "index.php/App_servicios/get_carrera_existente/")
//                .success(function (respuesta) {
//
//
//                    if (String(respuesta.casos).trim() != 'false') {
//
//                        $scope.datos_registro.existe_carrera = respuesta.casos.existe;
//                    }
//                    
//
//                }).error(function () {
//
//            console.log('error: index.php/App_servicios/get_carrera_existente/');
//            
//        });


        $http.post(base_url + "index.php/App_servicios/get_universidades_estudiante/")
                .success(function (respuesta) {

                    if (String(respuesta.casos).trim() != 'false') {

                        $timeout(function () {

                            ngProgressLite.done();
                            $rootScope.show = 1;
                            $rootScope.show2 = 1;
                        }, 200);

                        $scope.datos_registro.universidades = respuesta.casos;
                    }

                }).error(function () {

            console.log('error: index.php/App_servicios/get_universidades_estudiante/');
        });


        $scope.carreras = function (data) {


            if (data == undefined) {

                $scope.datos_registro.carreras = {};
                $scope.datos_registro.secciones = {};
                $scope.datos_registro.materias = {};

            } else {

                $http.post(base_url + "index.php/App_servicios/get_carreras_vinculadas/", {universidad: data})
                        .success(function (respuesta) {

                            // console.log(respuesta.casos);

                            if (String(respuesta.casos).trim() != 'false') {

                                $scope.datos_registro.carreras = respuesta.casos;
                            } else {

                                $scope.datos_registro.carreras = {};
                                $scope.datos_registro.secciones = {};
                                $scope.datos_registro.materias = {};
                            }

                        }).error(function () {

                    console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
                });


            }





        };




        $scope.buscar_materias = function (data) {

            if (data == undefined) {

                $scope.datos_registro.secciones = {};
                $scope.datos_registro.materias = {};

            } else {

                $http.post(base_url + "index.php/App_servicios/get_materias_vinculadas_disponibles/", {carrera: data, universidad: $scope.formData.universidad})
                        .success(function (respuesta) {

                            //    console.log(respuesta.casos);

                            if (String(respuesta.casos).trim() != 'false') {

                                $scope.datos_registro.materias = respuesta.casos;
                            } else {

                                $scope.datos_registro.materias = {};
                            }

                        }).error(function () {

                    console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
                });

            }
        };




        $scope.secciones = function (data) {



            if (data == undefined) {

                $scope.datos_registro.secciones = {};

            } else {

                //  console.log(data);

                $http.post(base_url + "index.php/App_servicios/get_secciones_vinculadas_disponibles/", {carrera: $scope.formData.carrera, universidad: $scope.formData.universidad, materia: data})
                        .success(function (respuesta) {

                            //    console.log(respuesta.casos);

                            if (String(respuesta.casos).trim() != 'false') {

                                $scope.datos_registro.secciones = respuesta.casos;


                            } else {

                                $scope.datos_registro.secciones = {};
                                $scope.datos_registro.materias = {};
                            }

                        }).error(function () {

                    console.log('error: index.php/App_servicios/registrar_usuario_ieu/');

                });

            }
        };


        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar la Postulación?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_postulacion/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });


                                    $window.location = "#Postulacion/";


                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });



                }, 'onDeny': function () {
                }
            });
        };


        $scope.eliminar = function (data) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea eliminar esta postulación?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/eliminar_postulacion/", {id_datos_academico: data})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $window.location = "#Postulacion/";
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                    });
                }, 'onDeny': function () {
                }
            });
        }

        $scope.get_postulaciones = function () {

            $http.post(base_url + "index.php/App_servicios/get_postulaciones/")
                    .success(function (respuesta) {

                        // console.log(respuesta);
                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.busqueda = {postulaciones: respuesta.casos};

                        }

                        $timeout(function () {

                            ngProgressLite.done();
                            $rootScope.show = 1;
                            $rootScope.show2 = 1;
                        }, 0);

                    }).error(function () {

                $timeout(function () {

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;
                }, 0);

                console.log('error: index.php/App_servicios/get_secciones/');
            });
        };

        $scope.get_postulaciones();


        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });


        // console.log("respuesta3");

    }]);

mppeuct.controller('Agregar_seccion', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};

        $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                .success(function (respuesta) {

                    //  console.log(respuesta.casos);

                    $scope.formData.materia = '';
                    $scope.datos_registro.materia = {};

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.carreras = respuesta.casos;
                    }

                }).error(function () {

            $scope.formData.materia = '';
            $scope.datos_registro.materia = {};

            console.log('error: index.php/App_servicios/get_carreras_ieu/');
        });



        $scope.buscar_materias = function () {

            $http.post(base_url + "index.php/App_servicios/get_materias_disponibles/", $scope.formData)
                    .success(function (respuesta) {

                        $scope.formData.materia = '';
                        $scope.datos_registro.materia = {};
                        //  console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.datos_registro.materias = respuesta.casos;
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
            });

        };


        $scope.get_secciones = function () {

            $http.post(base_url + "index.php/App_servicios/get_secciones/")
                    .success(function (respuesta) {

                        // console.log(respuesta);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.busqueda = {secciones: respuesta.casos};
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/get_secciones/');
            });
        };
        $scope.get_secciones();
        $scope.cambiar_estatus = function (id_seccion, estatus, estatus_clave) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea ' + estatus_clave + ' la sección ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/Set_estatus_seccion/", {id_seccion: id_seccion, estatus: estatus})
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.get_secciones();
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };

        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea registrar la sección ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_seccion/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    $scope.get_secciones();
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };


        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });
        $timeout(function () {
            ngProgressLite.done();
            $rootScope.show = 1;
            $rootScope.show2 = 1;
        }, 200);
    }]);

mppeuct.controller('Vincular_profesor', ["$scope", "$window", "$rootScope", 'ngProgressLite', '$timeout', 'DTOptionsBuilder', '$http', '$location', function ($scope, $window, $rootScope, ngProgressLite, $timeout, DTOptionsBuilder, $http, $location) {

        ngProgressLite.start();
        $rootScope.title = $location.path();
        $rootScope.liActive = $location.path();
        $scope.formData = {};
        $scope.datos_registro = {};
        $rootScope.get_secciones2 = function () {

            $http.post(base_url + "index.php/App_servicios/get_vincular_profesor/")
                    .success(function (respuesta) {

                        console.log(respuesta);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.busqueda = {secciones: respuesta.casos};

                        }

                        $timeout(function () {

                            ngProgressLite.done();
                            $rootScope.show = 1;
                            $rootScope.show2 = 1;
                        }, 0);

                    }).error(function () {

                $timeout(function () {

                    ngProgressLite.done();
                    $rootScope.show = 1;
                    $rootScope.show2 = 1;
                }, 0);

                console.log('error: index.php/App_servicios/get_vincular_profesor/');
            });
        }

        $rootScope.get_secciones2();
        $http.post(base_url + "index.php/App_servicios/get_profesores_sin_vinculacion/")
                .success(function (respuesta) {

                    // console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.profesores = respuesta.casos;
                    }

                }).error(function () {

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });

        $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/")
                .success(function (respuesta) {

                    //  console.log(respuesta.casos);

                    if (String(respuesta.casos).trim() != 'false') {

                        $scope.datos_registro.carreras = respuesta.casos;
                    }

                }).error(function () {

            console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
        });

        $scope.buscar_materias = function () {

            //  console.log("hola");

            $http.post(base_url + "index.php/App_servicios/get_materias_disponibles_vinculadas/", $scope.formData)
                    .success(function (respuesta) {

                        console.log(respuesta.casos);

                        $scope.formData.seccion = '';
                        $scope.formData.materia = '';
                        $scope.datos_registro.secciones = {};
                        $scope.datos_registro.materia = {};
                        console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.datos_registro.materias = respuesta.casos;
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
            });
        };




        $scope.buscar_secciones = function () {


            //   $scope.buscar_materias();

            $http.post(base_url + "index.php/App_servicios/get_secciones_disponibles/", $scope.formData)
                    .success(function (respuesta) {

                        // console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $scope.datos_registro.secciones = respuesta.casos;
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
            });
        };


        $scope.setear_data = function () {

            $scope.formData.carrera = '';
            $scope.formData.seccion = '';
            $scope.formData.materia = '';
            $scope.datos_registro.secciones = {};
            $scope.datos_registro.materia = {};
        };


        $scope.registrar = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea vincular a este(a) profesor(a) ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/registrar_profesor_vincular/", $scope.formData)
                            .success(function (respuesta) {

                                //  console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $scope.formData = {};
                                    //$rootScope.get_secciones2();
                                    $window.location = "#Vincular_profesor/";
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        };
        $scope.eliminar = function (data) {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea desvincular este(a) profesor(a) ?',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {
                    $http.post(base_url + "index.php/App_servicios/desvincular_profesor/", {id_seccion_materia: data})
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {


                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $window.location = "#Vincular_profesor/";
                                    $rootScope.formData = {};
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        }

        $scope.editar = function (data) {

            ngProgressLite.start();
            ngProgressLite.set(0.2);
            $rootScope.formData2 = {};
            $rootScope.datos_registro2 = {};
            $http.post(base_url + "index.php/App_servicios/get_profesores_sin_vinculacion/")
                    .success(function (respuesta) {


                        // console.log(respuesta.casos);

                        if (String(respuesta.casos).trim() != 'false') {

                            $rootScope.datos_registro2.profesores = respuesta.casos;
                        }

                    }).error(function () {

                console.log('error: index.php/App_servicios/registrar_usuario_ieu/');
            });
            $http.post(base_url + "index.php/App_servicios/get_vincular_profesor_id/", {cedula: data})
                    .success(function (respuesta) {
                        // console.log(respuesta);

                        if (String(respuesta.casos).trim() != "false") {

                            // console.log(respuesta.casos[data]);

                            $rootScope.formData2 = respuesta.casos[data];
                            $rootScope.formData2.profesor = {cedula: $rootScope.formData2.cedula};
                            console.log($rootScope.formData2);
                            $rootScope.modal = {header_menu: true};
                            $rootScope.modal = {
                                caso: data,
                                header: 'Responsable IEU',
                                body: 'body',
                                footer: "",
                                data: 'data',
                                id: 'id',
                                tipo: 'tipo',
                                tiempo: true,
                                template: base_url + 'index.php/app/Edtar_vinacular_profesor'

                            };
                            $("#mymodal").modal();
                            ngProgressLite.done();
                        } else {

                            $rootScope.data_caso = false;
                            ngProgressLite.done();
                        }
                    }

                    ).error(function () {

                console.log('error');
                $scope.funcionario_encontrado = false;
            });
        };
        $rootScope.modificar_vinclacion = function () {

            $.jAlert({'type': 'confirm',
                'title': '¡Responder!',
                'size': 'md',
                'theme': 'black',
                'backgroundColor': 'white',
                'confirmQuestion': '¿Esta seguro que desea modificar.',
                'confirmBtnText': 'Si', 'denyBtnText': 'No',
                'showAnimation': 'flipInX',
                'hideAnimation': 'flipOutX',
                'onConfirm': function () {

                    $http.post(base_url + "index.php/App_servicios/modificar_vinculacion/", $scope.formData2)
                            .success(function (respuesta) {

                                // console.log(respuesta.casos);
                                if (String(respuesta.casos).trim() != 'false') {

                                    $("#mymodal").modal('hide');
                                    $.jAlert({
                                        'title': '¡Éxito!',
                                        'content': msn_exito,
                                        'theme': 'green',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'green'}
                                    });
                                    $window.location = "#Vincular_profesor/";
                                    // $rootScope.get_secciones2();
                                } else {
                                    $.jAlert({
                                        'title': '¡Error!.',
                                        'content': msn_error,
                                        'theme': 'red',
                                        'size': 'md',
                                        'showAnimation': 'bounceInDown',
                                        'hideAnimation': 'bounceOutDown',
                                        'btns': {'text': 'Aceptar', 'theme': 'red'}
                                    });
                                }
                            }).error(function () {
                        $.jAlert({
                            'title': '¡Error!.',
                            'content': msn_error,
                            'theme': 'red',
                            'size': 'md',
                            'showAnimation': 'bounceInDown',
                            'hideAnimation': 'bounceOutDown',
                            'btns': {'text': 'Aceptar', 'theme': 'red'}
                        });
                        console.log('error');
                    });
                }, 'onDeny': function () {
                }
            });
        }


        // DataTables configurable options
        $scope.dtOptions = DTOptionsBuilder.newOptions()
                .withLanguage({
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                });

    }]);


//14687213

//DREQUENA@MPPECT.GO.VE	
/** @type {string} */
var msn_exito = "Se ha procesado  exitosamente";
/** @type {string} */
var msn_error = "Ha ocurrido un error al procesar";
var mppeuct = angular.module("mppeuct", ["ngRoute", "ngSanitize", "ngProgressLite", "datatables"]);
mppeuct.config(["$routeProvider", "ngProgressLiteProvider", function($routeProvider, dataAndEvents) {
  if (id_perfil == 1 || id_perfil == 2) {
    if (id_perfil == 1) {
      $routeProvider.when("/Funcionario_mppeuct", {
        templateUrl : base_url + "index.php/app/Registrar_usuario_mppeuct",
        controller : "Funcionario_mppeuct"
      });
    }
    $routeProvider.when("/Registar_responsable", {
      templateUrl : base_url + "index.php/app/Inicio",
      controller : "Registar_responsable"
    });
    $routeProvider.when("/Gestionar_responsable", {
      templateUrl : base_url + "index.php/app/Gestionar_ieu",
      controller : "Gestionar_responsable"
    });
    $routeProvider.otherwise({
      redirectTo : "/Gestionar_responsable"
    });
  } else {
    if (id_perfil == 3) {
      $routeProvider.when("/Cambiar_clave", {
        templateUrl : base_url + "index.php/app/cambiar_clave",
        controller : "Cambiar_clave"
      });
      $routeProvider.when("/Descarga_de_archivo", {
        templateUrl : base_url + "index.php/app/En_construccion",
        controller : "Descarga_de_archivo"
      });
      $routeProvider.when("/Agregar_profesor", {
        templateUrl : base_url + "index.php/app/Agregar_profesor",
        controller : "Agregar_profesor"
      });
      $routeProvider.when("/Administrar_profesores", {
        templateUrl : base_url + "index.php/app/Gestionar_profesor",
        controller : "Administrar_profesores"
      });
      $routeProvider.when("/materia_profesor", {
        templateUrl : base_url + "index.php/app/En_construccion",
        controller : "materia_profesor"
      });
      $routeProvider.when("/Agregar_estudiante", {
        templateUrl : base_url + "index.php/app/Agregar_estudiante",
        controller : "Agregar_estudiante"
      });
      $routeProvider.when("/Administrar_estudiantes", {
        templateUrl : base_url + "index.php/app/Gestionar_estudiante",
        controller : "Administrar_estudiantes"
      });
      $routeProvider.when("/Administrar_seccion", {
        templateUrl : base_url + "index.php/app/Agregar_seccion",
        controller : "Agregar_seccion"
      });
      $routeProvider.when("/Administrar_materias", {
        templateUrl : base_url + "index.php/app/Agregar_materia",
        controller : "Administrar_materias"
      });
      $routeProvider.when("/Vincular_profesor", {
        templateUrl : base_url + "index.php/app/Vincular_profesor",
        controller : "Vincular_profesor"
      });
      $routeProvider.otherwise({
        redirectTo : "/Descarga_de_archivo"
      });
    } else {
      if (id_perfil == 4) {
        $routeProvider.when("/Postulacion", {
          templateUrl : base_url + "index.php/app/Postulacion",
          controller : "Postulacion"
        });
        $routeProvider.otherwise({
          redirectTo : "/Postulacion"
        });
      }
    }
  }
}]);
mppeuct.controller("Cambiar_clave", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, dataAndEvents, a, timer, $sanitize, deepDataAndEvents, $http, $location) {
  /** @type {boolean} */
  $scope.ver = false;
  timer.start();
  a.liActive = $location.path();
  $scope.formData = {};
  /**
   * @return {undefined}
   */
  a.modificar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea modificar la contrase\u00f1a?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/cambiar_clave/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $sanitize(function() {
    timer.done();
    /** @type {number} */
    a.show = 1;
    /** @type {number} */
    a.show2 = 1;
  }, 200);
}]);
mppeuct.controller("app", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", function(dataAndEvents, deepDataAndEvents, that, ignoreMethodDoesntExist, textAlt) {
  that.base_url = base_url;
  that.base_url_doc = base_url + "privado/docs/";
}]);
mppeuct.controller("Registar_responsable", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, $window, test, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  test.title = $location.path();
  test.liActive = $location.path();
  $scope.formData = {};
  $scope.datos_registro = {};
  /** @type {RegExp} */
  test.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
  /** @type {boolean} */
  $scope.formData.campo_existente = false;
  $scope.$watch("formData.campo_existente", function() {
    if ($scope.formData.campo_existente) {
      /** @type {string} */
      $scope.formData.primer_nombre = "";
      /** @type {string} */
      $scope.formData.segundo_nombre = "";
      /** @type {string} */
      $scope.formData.primer_apellido = "";
      /** @type {string} */
      $scope.formData.segundo_apellido = "";
      /** @type {string} */
      $scope.formData.genero = "";
      /** @type {string} */
      $scope.formData.nacionalidad = "";
    }
  });
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.verificar_correo = function(dataAndEvents) {
    /** @type {boolean} */
    $scope.formData.correo_validado = false;
    $http.post(base_url + "index.php/App_servicios/verificar_correo/", {
      correo : dataAndEvents
    }).success(function(max) {
      if (String(max.casos).trim() != "false") {
        if (String(max.casos).trim() != "undefined") {
          /** @type {boolean} */
          $scope.formData.correo_validado = true;
        }
      }
      console.log("respuesta :" + $scope.formData.correo_validado);
    }).error(function() {
      console.log("error");
    });
  };
  $http.post(base_url + "index.php/App_servicios/get_universidades/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      $scope.datos_registro.universidades = max.casos;
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.get_usuarios_ieu = function() {
    $http.post(base_url + "index.php/App_servicios/get_usuarios_ieu/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.busqueda = {
          usuarios_ieu : max.casos
        };
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_usuarios_ieu/");
    });
  };
  $scope.get_usuarios_ieu();
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.buscar_cedula = function(dataAndEvents) {
    $http.post(base_url + "index.php/App_servicios/get_datos_saime/", {
      cedula : dataAndEvents
    }).success(function(max) {
      /** @type {boolean} */
      $scope.formData.campo_existente = false;
      if (String(max.casos).trim() != "false") {
        if (String(max.casos).trim() != "undefined") {
          if (String(max.casos.usuario_exitente).trim() == "false") {
            $scope.formData.primer_nombre = max.casos.primernombre;
            $scope.formData.segundo_nombre = max.casos.segundonombre;
            $scope.formData.primer_apellido = max.casos.primerapellido;
            $scope.formData.segundo_apellido = max.casos.segundoapellido;
            $scope.formData.genero = max.casos.sexo;
            $scope.formData.nacionalidad = max.casos.letra;
          } else {
            /** @type {boolean} */
            $scope.formData.campo_existente = true;
          }
        } else {
          /** @type {string} */
          $scope.formData.primer_nombre = "";
          /** @type {string} */
          $scope.formData.segundo_nombre = "";
          /** @type {string} */
          $scope.formData.primer_apellido = "";
          /** @type {string} */
          $scope.formData.segundo_apellido = "";
          /** @type {string} */
          $scope.formData.genero = "";
          /** @type {string} */
          $scope.formData.nacionalidad = "";
        }
      } else {
        /** @type {string} */
        $scope.formData.primer_nombre = "";
        /** @type {string} */
        $scope.formData.segundo_nombre = "";
        /** @type {string} */
        $scope.formData.primer_apellido = "";
        /** @type {string} */
        $scope.formData.segundo_apellido = "";
        /** @type {string} */
        $scope.formData.genero = "";
        /** @type {string} */
        $scope.formData.nacionalidad = "";
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @return {undefined}
   */
  $scope.registrar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea registrar al Responsable IEU?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/registrar_usuario_ieu/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_usuarios_ieu();
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
            /** @type {string} */
            $window.location = "#Registar_responsable/";
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : "Error al registrar los datos.",
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $sanitize(function() {
    timer.done();
    /** @type {number} */
    test.show = 1;
    /** @type {number} */
    test.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Gestionar_responsable", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, deepDataAndEvents, self, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  self.title = $location.path();
  self.liActive = $location.path();
  $scope.busqueda = {};
  /** @type {RegExp} */
  self.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
  /**
   * @return {undefined}
   */
  self.modificar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea modificar al Responsable IEU?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/modificar_usuario_ieu/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_usuarios_ieu();
            $("#mymodal").modal("hide");
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} deepDataAndEvents
   * @param {?} ignoreMethodDoesntExist
   * @param {string} dataAndEvents
   * @return {undefined}
   */
  $scope.cambiar_estatus = function(deepDataAndEvents, ignoreMethodDoesntExist, dataAndEvents) {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea " + dataAndEvents + " a este Responsable IEU?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/set_estatus_ieu/", {
          cedula : deepDataAndEvents,
          estatus : ignoreMethodDoesntExist
        }).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_usuarios_ieu();
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} prop
   * @return {undefined}
   */
  $scope.ver = function(prop) {
    timer.start();
    timer.set(0.2);
    $http.post(base_url + "index.php/App_servicios/get_ver_usuario_ieu/", {
      cedula : prop
    }).success(function(event) {
      self.formData = {};
      if (String(event.casos).trim() != "false") {
        self.formData = event.casos[prop];
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : prop,
          header : "Responsable IEU",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Ver_caso"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @param {?} prop
   * @return {undefined}
   */
  $scope.editar = function(prop) {
    timer.start();
    timer.set(0.2);
    self.formData = {};
    $http.post(base_url + "index.php/App_servicios/get_ver_usuario_ieu/", {
      cedula : prop
    }).success(function(event) {
      if (String(event.casos).trim() != "false") {
        self.formData2 = event.casos[prop];
        if (self.formData2.telefono_celular < 1) {
          /** @type {string} */
          self.formData2.telefono_celular = "";
        }
        if (self.formData2.telefono_hab < 1) {
          /** @type {string} */
          self.formData2.telefono_hab = "";
        }
        self.formData = self.formData2;
        self.formData.correo2 = self.formData.correo_ppal;
        self.formData.universidad = {
          id_ieu : self.formData.id_ieu,
          nombre_ieu : self.formData.nombre_ieu
        };
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : prop,
          header : "Responsable IEU",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Edtar_ieu"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  $http.post(base_url + "index.php/App_servicios/get_universidades/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      self.datos_registro = {
        universidades : max.casos
      };
      $sanitize(function() {
        timer.done();
        /** @type {number} */
        self.show = 1;
        /** @type {number} */
        self.show2 = 1;
      }, 0);
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.get_usuarios_ieu = function() {
    $http.post(base_url + "index.php/App_servicios/get_usuarios_ieu/").success(function(response) {
      console.log(response.casos);
      if (String(response.casos).trim() != "false") {
        $scope.busqueda = {
          usuarios_ieu : response.casos
        };
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_usuarios_ieu/");
    });
  };
  $scope.get_usuarios_ieu();
  $scope.dtOptions = dataAndEvents.newOptions().withLanguage({
    "sProcessing" : "Procesando...",
    "sLengthMenu" : "Mostrar _MENU_ registros",
    "sZeroRecords" : "No se encontraron resultados",
    "sEmptyTable" : "Ning\u00fan dato disponible en esta tabla",
    "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix" : "",
    "sSearch" : "Buscar:",
    "sUrl" : "",
    "sInfoThousands" : ",",
    "sLoadingRecords" : "Cargando...",
    "oPaginate" : {
      "sFirst" : "Primero",
      "sLast" : "\u00daltimo",
      "sNext" : "Siguiente",
      "sPrevious" : "Anterior"
    },
    "oAria" : {
      "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
    }
  });
}]);
mppeuct.controller("Descarga_de_archivo", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function(item, dataAndEvents, a, todo, $sanitize, deepDataAndEvents, ignoreMethodDoesntExist, $location) {
  a.liActive = $location.path();
  item.formData = {};
  item.datos_registro = {};
  $sanitize(function() {
    todo.done();
    /** @type {number} */
    a.show = 1;
    /** @type {number} */
    a.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Agregar_profesor", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, $window, test, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  test.title = $location.path();
  test.liActive = $location.path();
  $scope.formData = {};
  $scope.datos_registro = {};
  /** @type {RegExp} */
  test.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
  /** @type {boolean} */
  $scope.formData.campo_existente = false;
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.verificar_correo = function(dataAndEvents) {
    /** @type {boolean} */
    $scope.formData.correo_validado = false;
    $http.post(base_url + "index.php/App_servicios/verificar_correo/", {
      correo : dataAndEvents
    }).success(function(max) {
      if (String(max.casos).trim() != "false") {
        if (String(max.casos).trim() != "undefined") {
          /** @type {boolean} */
          $scope.formData.correo_validado = true;
        }
      }
      console.log("respuesta :" + $scope.formData.correo_validado);
    }).error(function() {
      console.log("error");
    });
  };
  $scope.$watch("formData.campo_existente", function() {
    if ($scope.formData.campo_existente) {
      /** @type {string} */
      $scope.formData.primer_nombre = "";
      /** @type {string} */
      $scope.formData.segundo_nombre = "";
      /** @type {string} */
      $scope.formData.primer_apellido = "";
      /** @type {string} */
      $scope.formData.segundo_apellido = "";
      /** @type {string} */
      $scope.formData.genero = "";
      /** @type {string} */
      $scope.formData.nacionalidad = "";
    }
  });
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.buscar_cedula = function(dataAndEvents) {
    $http.post(base_url + "index.php/App_servicios/get_datos_saime_profesor_estudiante/", {
      cedula : dataAndEvents
    }).success(function(max) {
      /** @type {boolean} */
      $scope.formData.campo_existente = false;
      if (String(max.casos).trim() != "false") {
        if (String(max.casos).trim() != "undefined") {
          if (String(max.casos.usuario_exitente).trim() == "false") {
            $scope.formData.primer_nombre = max.casos.primernombre;
            $scope.formData.segundo_nombre = max.casos.segundonombre;
            $scope.formData.primer_apellido = max.casos.primerapellido;
            $scope.formData.segundo_apellido = max.casos.segundoapellido;
            $scope.formData.genero = max.casos.sexo;
            $scope.formData.nacionalidad = max.casos.letra;
          } else {
            /** @type {boolean} */
            $scope.formData.campo_existente = true;
          }
        } else {
          /** @type {string} */
          $scope.formData.primer_nombre = "";
          /** @type {string} */
          $scope.formData.segundo_nombre = "";
          /** @type {string} */
          $scope.formData.primer_apellido = "";
          /** @type {string} */
          $scope.formData.segundo_apellido = "";
          /** @type {string} */
          $scope.formData.genero = "";
          /** @type {string} */
          $scope.formData.nacionalidad = "";
        }
      } else {
        /** @type {string} */
        $scope.formData.primer_nombre = "";
        /** @type {string} */
        $scope.formData.segundo_nombre = "";
        /** @type {string} */
        $scope.formData.primer_apellido = "";
        /** @type {string} */
        $scope.formData.segundo_apellido = "";
        /** @type {string} */
        $scope.formData.genero = "";
        /** @type {string} */
        $scope.formData.nacionalidad = "";
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @return {undefined}
   */
  $scope.registrar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea registrar a este(a) profesor(a)?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/registrar_profesor/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
            /** @type {string} */
            $window.location = "#Agregar_profesor/";
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $sanitize(function() {
    timer.done();
    /** @type {number} */
    test.show = 1;
    /** @type {number} */
    test.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Administrar_profesores", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, deepDataAndEvents, self, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  self.title = $location.path();
  self.liActive = $location.path();
  $scope.busqueda = {};
  /** @type {RegExp} */
  self.ph_numbr = /0[1-9]{3}[0-9]{7}$/;
  /**
   * @return {undefined}
   */
  self.modificar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea modificar a este(a) profesor(a)",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/modificar_profesor/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_profesores();
            $("#mymodal").modal("hide");
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} deepDataAndEvents
   * @param {?} ignoreMethodDoesntExist
   * @param {string} dataAndEvents
   * @return {undefined}
   */
  $scope.cambiar_estatus = function(deepDataAndEvents, ignoreMethodDoesntExist, dataAndEvents) {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea " + dataAndEvents + " a este(a) profesor(a)?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/set_estatus_profesor/", {
          cedula : deepDataAndEvents,
          estatus : ignoreMethodDoesntExist
        }).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_profesores();
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} prop
   * @return {undefined}
   */
  $scope.ver = function(prop) {
    timer.start();
    timer.set(0.2);
    $http.post(base_url + "index.php/App_servicios/get_ver_profesor/", {
      cedula : prop
    }).success(function(event) {
      self.formData = {};
      if (String(event.casos).trim() != "false") {
        self.formData = event.casos[prop];
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : prop,
          header : "Profesor(a)",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Ver_profesor"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @param {?} idx
   * @return {undefined}
   */
  $scope.editar = function(idx) {
    timer.start();
    timer.set(0.2);
    self.formData = {};
    $http.post(base_url + "index.php/App_servicios/get_ver_profesor/", {
      cedula : idx
    }).success(function(body) {
      console.log(body);
      if (String(body.casos).trim() != "false") {
        console.log(body.casos[idx]);
        self.formData2 = body.casos[idx];
        if (self.formData2.telefono_celular < 1) {
          /** @type {string} */
          self.formData2.telefono_celular = "";
        }
        if (self.formData2.telefono_hab < 1) {
          /** @type {string} */
          self.formData2.telefono_hab = "";
        }
        self.formData = self.formData2;
        self.formData.correo2 = self.formData.correo_ppal;
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : idx,
          header : "Responsable IEU",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Edtar_profesor"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  $http.post(base_url + "index.php/App_servicios/get_universidades/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      self.datos_registro = {
        universidades : max.casos
      };
      $sanitize(function() {
        timer.done();
        /** @type {number} */
        self.show = 1;
        /** @type {number} */
        self.show2 = 1;
      }, 0);
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.get_profesores = function() {
    $http.post(base_url + "index.php/App_servicios/get_profesores/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.busqueda = {
          usuarios_ieu : max.casos
        };
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_profesores/");
    });
  };
  $scope.get_profesores();
  $scope.dtOptions = dataAndEvents.newOptions().withLanguage({
    "sProcessing" : "Procesando...",
    "sLengthMenu" : "Mostrar _MENU_ registros",
    "sZeroRecords" : "No se encontraron resultados",
    "sEmptyTable" : "Ning\u00fan dato disponible en esta tabla",
    "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix" : "",
    "sSearch" : "Buscar:",
    "sUrl" : "",
    "sInfoThousands" : ",",
    "sLoadingRecords" : "Cargando...",
    "oPaginate" : {
      "sFirst" : "Primero",
      "sLast" : "\u00daltimo",
      "sNext" : "Siguiente",
      "sPrevious" : "Anterior"
    },
    "oAria" : {
      "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
    }
  });
}]);
mppeuct.controller("Agregar_estudiante", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, $window, test, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  test.title = $location.path();
  test.liActive = $location.path();
  $scope.formData = {};
  $scope.datos_registro = {};
  /** @type {string} */
  test.ph_numbr = "^+?ddddddddddddd$/";
  /** @type {boolean} */
  $scope.formData.campo_existente = false;
  $scope.$watch("formData.campo_existente", function() {
    if ($scope.formData.campo_existente == true) {
      /** @type {string} */
      $scope.formData.primer_nombre = "";
      /** @type {string} */
      $scope.formData.segundo_nombre = "";
      /** @type {string} */
      $scope.formData.primer_apellido = "";
      /** @type {string} */
      $scope.formData.segundo_apellido = "";
      /** @type {string} */
      $scope.formData.genero = "";
      /** @type {string} */
      $scope.formData.nacionalidad = "";
    }
  });
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.verificar_correo = function(dataAndEvents) {
    /** @type {boolean} */
    $scope.formData.correo_validado = false;
    $http.post(base_url + "index.php/App_servicios/verificar_correo/", {
      correo : dataAndEvents
    }).success(function(max) {
      if (String(max.casos).trim() != "false") {
        if (String(max.casos).trim() != "undefined") {
          /** @type {boolean} */
          $scope.formData.correo_validado = true;
        }
      }
      console.log("respuesta :" + $scope.formData.correo_validado);
    }).error(function() {
      console.log("error");
    });
  };
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.buscar_cedula = function(dataAndEvents) {
    $http.post(base_url + "index.php/App_servicios/get_datos_saime_profesor_estudiante/", {
      cedula : dataAndEvents
    }).success(function(max) {
      /** @type {boolean} */
      $scope.formData.campo_existente = false;
      if (String(max.casos).trim() != "false") {
        if (String(max.casos).trim() != "undefined") {
          if (String(max.casos.usuario_exitente).trim() == "false") {
            $scope.formData.primer_nombre = max.casos.primernombre;
            $scope.formData.segundo_nombre = max.casos.segundonombre;
            $scope.formData.primer_apellido = max.casos.primerapellido;
            $scope.formData.segundo_apellido = max.casos.segundoapellido;
            $scope.formData.genero = max.casos.sexo;
            $scope.formData.nacionalidad = max.casos.letra;
          } else {
            /** @type {boolean} */
            $scope.formData.campo_existente = true;
          }
        } else {
          /** @type {string} */
          $scope.formData.primer_nombre = "";
          /** @type {string} */
          $scope.formData.segundo_nombre = "";
          /** @type {string} */
          $scope.formData.primer_apellido = "";
          /** @type {string} */
          $scope.formData.segundo_apellido = "";
          /** @type {string} */
          $scope.formData.genero = "";
          /** @type {string} */
          $scope.formData.nacionalidad = "";
        }
      } else {
        /** @type {string} */
        $scope.formData.primer_nombre = "";
        /** @type {string} */
        $scope.formData.segundo_nombre = "";
        /** @type {string} */
        $scope.formData.primer_apellido = "";
        /** @type {string} */
        $scope.formData.segundo_apellido = "";
        /** @type {string} */
        $scope.formData.genero = "";
        /** @type {string} */
        $scope.formData.nacionalidad = "";
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @return {undefined}
   */
  $scope.registrar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea registrar al estudiante?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/registrar_estudiante/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
            /** @type {string} */
            $window.location = "#Agregar_estudiante/";
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $sanitize(function() {
    timer.done();
    /** @type {number} */
    test.show = 1;
    /** @type {number} */
    test.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Descarga_de_archivo", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function(item, dataAndEvents, a, todo, $sanitize, deepDataAndEvents, ignoreMethodDoesntExist, $location) {
  a.liActive = $location.path();
  item.formData = {};
  item.datos_registro = {};
  $sanitize(function() {
    todo.done();
    /** @type {number} */
    a.show = 1;
    /** @type {number} */
    a.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Administrar_estudiantes", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, deepDataAndEvents, self, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  self.title = $location.path();
  self.liActive = $location.path();
  $scope.busqueda = {};
  /** @type {string} */
  self.ph_numbr = "/^+?ddddddddddd$/";
  /**
   * @return {undefined}
   */
  self.modificar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea modificar el estudiante",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/modificar_estudiante/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_estudiantes();
            $("#mymodal").modal("hide");
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} deepDataAndEvents
   * @param {?} ignoreMethodDoesntExist
   * @param {string} dataAndEvents
   * @return {undefined}
   */
  $scope.cambiar_estatus = function(deepDataAndEvents, ignoreMethodDoesntExist, dataAndEvents) {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea " + dataAndEvents + " el estudiante?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/set_estatus_estudiante/", {
          cedula : deepDataAndEvents,
          estatus : ignoreMethodDoesntExist
        }).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $scope.get_estudiantes();
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_error,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : "No se ha " + dataAndEvents + " al estudiante.",
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} prop
   * @return {undefined}
   */
  $scope.ver = function(prop) {
    timer.start();
    timer.set(0.2);
    $http.post(base_url + "index.php/App_servicios/get_ver_estudiante/", {
      cedula : prop
    }).success(function(event) {
      self.formData = {};
      if (String(event.casos).trim() != "false") {
        self.formData = event.casos[prop];
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : prop,
          header : "Estudiante",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Ver_estudiante"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @param {?} idx
   * @return {undefined}
   */
  $scope.editar = function(idx) {
    timer.start();
    timer.set(0.2);
    self.formData = {};
    $http.post(base_url + "index.php/App_servicios/get_ver_estudiante/", {
      cedula : idx
    }).success(function(body) {
      console.log(body);
      if (String(body.casos).trim() != "false") {
        console.log(body.casos[idx]);
        self.formData2 = body.casos[idx];
        /** @type {number} */
        self.formData2.telefono_celular = parseInt(self.formData2.telefono_celular);
        /** @type {number} */
        self.formData2.telefono_hab = parseInt(self.formData2.telefono_hab);
        self.formData = self.formData2;
        self.formData.correo2 = self.formData.correo_ppal;
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : idx,
          header : "Responsable IEU",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Edtar_estudiante"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  $http.post(base_url + "index.php/App_servicios/get_universidades/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      self.datos_registro = {
        universidades : max.casos
      };
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.get_estudiantes = function() {
    $http.post(base_url + "index.php/App_servicios/get_estudiantes/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.busqueda = {
          usuarios_ieu : max.casos
        };
        $sanitize(function() {
          timer.done();
          /** @type {number} */
          self.show = 1;
          /** @type {number} */
          self.show2 = 1;
        }, 0);
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_estudiantes/");
    });
  };
  $scope.get_estudiantes();
  $scope.dtOptions = dataAndEvents.newOptions().withLanguage({
    "sProcessing" : "Procesando...",
    "sLengthMenu" : "Mostrar _MENU_ registros",
    "sZeroRecords" : "No se encontraron resultados",
    "sEmptyTable" : "Ning\u00fan dato disponible en esta tabla",
    "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix" : "",
    "sSearch" : "Buscar:",
    "sUrl" : "",
    "sInfoThousands" : ",",
    "sLoadingRecords" : "Cargando...",
    "oPaginate" : {
      "sFirst" : "Primero",
      "sLast" : "\u00daltimo",
      "sNext" : "Siguiente",
      "sPrevious" : "Anterior"
    },
    "oAria" : {
      "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
    }
  });
  $sanitize(function() {
    timer.done();
    /** @type {number} */
    self.show = 1;
    /** @type {number} */
    self.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Administrar_materias", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, deepDataAndEvents, item, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  item.title = $location.path();
  item.liActive = $location.path();
  $scope.formData = {};
  $scope.datos_registro = {};
  $http.post(base_url + "index.php/App_servicios/get_secciones/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      $scope.datos_registro.secciones = max.casos;
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.get_materias = function() {
    $http.post(base_url + "index.php/App_servicios/get_materias/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.busqueda = {
          materias : max.casos
        };
        $sanitize(function() {
          timer.done();
          /** @type {number} */
          item.show = 1;
          /** @type {number} */
          item.show2 = 1;
        }, 0);
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_secciones/");
    });
  };
  $scope.get_materias();
  /**
   * @param {?} deepDataAndEvents
   * @param {?} ignoreMethodDoesntExist
   * @param {string} dataAndEvents
   * @return {undefined}
   */
  $scope.cambiar_estatus = function(deepDataAndEvents, ignoreMethodDoesntExist, dataAndEvents) {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea " + dataAndEvents + " la secci\u00f3n ?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/Set_estatus_seccion/", {
          id_seccion : deepDataAndEvents,
          estatus : ignoreMethodDoesntExist
        }).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.get_materias();
            item.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @return {undefined}
   */
  $scope.registrar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea registrar la ateria ?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/registrar_materia/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
            $scope.get_materias();
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $scope.dtOptions = dataAndEvents.newOptions().withLanguage({
    "sProcessing" : "Procesando...",
    "sLengthMenu" : "Mostrar _MENU_ registros",
    "sZeroRecords" : "No se encontraron resultados",
    "sEmptyTable" : "Ning\u00fan dato disponible en esta tabla",
    "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix" : "",
    "sSearch" : "Buscar:",
    "sUrl" : "",
    "sInfoThousands" : ",",
    "sLoadingRecords" : "Cargando...",
    "oPaginate" : {
      "sFirst" : "Primero",
      "sLast" : "\u00daltimo",
      "sNext" : "Siguiente",
      "sPrevious" : "Anterior"
    },
    "oAria" : {
      "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
    }
  });
}]);
mppeuct.controller("Postulacion", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function(item, dataAndEvents, a, todo, $sanitize, deepDataAndEvents, $http, $location) {
  a.liActive = $location.path();
  item.formData = {};
  item.datos_registro = {};
  $http.post(base_url + "index.php/App_servicios/get_universidades/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      item.datos_registro.universidades = max.casos;
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  $sanitize(function() {
    todo.done();
    /** @type {number} */
    a.show = 1;
    /** @type {number} */
    a.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Agregar_seccion", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, deepDataAndEvents, item, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  item.title = $location.path();
  item.liActive = $location.path();
  $scope.formData = {};
  $scope.datos_registro = {};
  $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      $scope.datos_registro.carreras = max.casos;
      $sanitize(function() {
        timer.done();
        /** @type {number} */
        item.show = 1;
        /** @type {number} */
        item.show2 = 1;
      }, 0);
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/get_carreras_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.get_secciones = function() {
    $http.post(base_url + "index.php/App_servicios/get_secciones/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.busqueda = {
          secciones : max.casos
        };
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_secciones/");
    });
  };
  $scope.get_secciones();
  /**
   * @param {?} deepDataAndEvents
   * @param {?} ignoreMethodDoesntExist
   * @param {string} dataAndEvents
   * @return {undefined}
   */
  $scope.cambiar_estatus = function(deepDataAndEvents, ignoreMethodDoesntExist, dataAndEvents) {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea " + dataAndEvents + " la secci\u00f3n ?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/Set_estatus_seccion/", {
          id_seccion : deepDataAndEvents,
          estatus : ignoreMethodDoesntExist
        }).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.get_secciones();
            item.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @return {undefined}
   */
  $scope.registrar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea registrar la secci\u00f3n ?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/registrar_seccion/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
            $scope.get_secciones();
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $scope.dtOptions = dataAndEvents.newOptions().withLanguage({
    "sProcessing" : "Procesando...",
    "sLengthMenu" : "Mostrar _MENU_ registros",
    "sZeroRecords" : "No se encontraron resultados",
    "sEmptyTable" : "Ning\u00fan dato disponible en esta tabla",
    "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix" : "",
    "sSearch" : "Buscar:",
    "sUrl" : "",
    "sInfoThousands" : ",",
    "sLoadingRecords" : "Cargando...",
    "oPaginate" : {
      "sFirst" : "Primero",
      "sLast" : "\u00daltimo",
      "sNext" : "Siguiente",
      "sPrevious" : "Anterior"
    },
    "oAria" : {
      "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
    }
  });
  $sanitize(function() {
    timer.done();
    /** @type {number} */
    item.show = 1;
    /** @type {number} */
    item.show2 = 1;
  }, 200);
}]);
mppeuct.controller("Vincular_profesor", ["$scope", "$window", "$rootScope", "ngProgressLite", "$timeout", "DTOptionsBuilder", "$http", "$location", function($scope, $window, self, timer, $sanitize, dataAndEvents, $http, $location) {
  timer.start();
  self.title = $location.path();
  self.liActive = $location.path();
  $scope.formData = {};
  $scope.datos_registro = {};
  /**
   * @return {undefined}
   */
  self.get_secciones2 = function() {
    $http.post(base_url + "index.php/App_servicios/get_vincular_profesor/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.busqueda = {
          secciones : max.casos
        };
        $sanitize(function() {
          timer.done();
          /** @type {number} */
          self.show = 1;
          /** @type {number} */
          self.show2 = 1;
        }, 0);
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/get_vincular_profesor/");
    });
  };
  self.get_secciones2();
  $http.post(base_url + "index.php/App_servicios/get_profesores_sin_vinculacion/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      $scope.datos_registro.profesores = max.casos;
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  $http.post(base_url + "index.php/App_servicios/get_carreras_ieu/").success(function(max) {
    if (String(max.casos).trim() != "false") {
      $scope.datos_registro.carreras = max.casos;
    }
  }).error(function() {
    console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
  });
  /**
   * @return {undefined}
   */
  $scope.setear_data = function() {
    /** @type {string} */
    $scope.formData.carrera = "";
    /** @type {string} */
    $scope.formData.seccion = "";
    /** @type {string} */
    $scope.formData.materia = "";
    $scope.datos_registro.secciones = {};
    $scope.datos_registro.materia = {};
  };
  /**
   * @return {undefined}
   */
  $scope.buscar_secciones = function() {
    /** @type {string} */
    $scope.formData.seccion = "";
    /** @type {string} */
    $scope.formData.materia = "";
    $scope.datos_registro.secciones = {};
    $scope.datos_registro.materia = {};
    $http.post(base_url + "index.php/App_servicios/get_secciones_disponibles/", $scope.formData).success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.datos_registro.secciones = max.casos;
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
    });
  };
  /**
   * @return {undefined}
   */
  $scope.buscar_materias = function() {
    $http.post(base_url + "index.php/App_servicios/get_materias_disponibles/", $scope.formData).success(function(max) {
      if (String(max.casos).trim() != "false") {
        $scope.datos_registro.materias = max.casos;
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
    });
  };
  /**
   * @return {undefined}
   */
  $scope.registrar = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea vincular a este(a) profesor(a) ?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/registrar_profesor_vincular/", $scope.formData).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            $scope.formData = {};
            /** @type {string} */
            $window.location = "#Vincular_profesor/";
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} dataAndEvents
   * @return {undefined}
   */
  $scope.eliminar = function(dataAndEvents) {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea desvincular este(a) profesor(a) ?",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/desvincular_profesor/", {
          id_seccion_materia : dataAndEvents
        }).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            /** @type {string} */
            $window.location = "#Vincular_profesor/";
            self.formData = {};
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  /**
   * @param {?} prop
   * @return {undefined}
   */
  $scope.editar = function(prop) {
    timer.start();
    timer.set(0.2);
    self.formData2 = {};
    self.datos_registro2 = {};
    $http.post(base_url + "index.php/App_servicios/get_profesores_sin_vinculacion/").success(function(max) {
      if (String(max.casos).trim() != "false") {
        self.datos_registro2.profesores = max.casos;
      }
    }).error(function() {
      console.log("error: index.php/App_servicios/registrar_usuario_ieu/");
    });
    $http.post(base_url + "index.php/App_servicios/get_vincular_profesor_id/", {
      cedula : prop
    }).success(function(event) {
      if (String(event.casos).trim() != "false") {
        self.formData2 = event.casos[prop];
        self.formData2.profesor = {
          cedula : self.formData2.cedula
        };
        console.log(self.formData2);
        self.modal = {
          header_menu : true
        };
        self.modal = {
          caso : prop,
          header : "Responsable IEU",
          body : "body",
          footer : "",
          data : "data",
          id : "id",
          tipo : "tipo",
          tiempo : true,
          template : base_url + "index.php/app/Edtar_vinacular_profesor"
        };
        $("#mymodal").modal();
        timer.done();
      } else {
        /** @type {boolean} */
        self.data_caso = false;
        timer.done();
      }
    }).error(function() {
      console.log("error");
      /** @type {boolean} */
      $scope.funcionario_encontrado = false;
    });
  };
  /**
   * @return {undefined}
   */
  self.modificar_vinclacion = function() {
    $.jAlert({
      "type" : "confirm",
      "title" : "\u00a1Responder!",
      "size" : "md",
      "theme" : "black",
      "backgroundColor" : "white",
      "confirmQuestion" : "\u00bfEsta seguro que desea modificar.",
      "confirmBtnText" : "Si",
      "denyBtnText" : "No",
      "showAnimation" : "flipInX",
      "hideAnimation" : "flipOutX",
      /**
       * @return {undefined}
       */
      "onConfirm" : function() {
        $http.post(base_url + "index.php/App_servicios/modificar_vinculacion/", $scope.formData2).success(function(max) {
          if (String(max.casos).trim() != "false") {
            $("#mymodal").modal("hide");
            $.jAlert({
              "title" : "\u00a1Exito!",
              "content" : msn_exito,
              "theme" : "green",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "green"
              }
            });
            /** @type {string} */
            $window.location = "#Vincular_profesor/";
          } else {
            $.jAlert({
              "title" : "\u00a1Error!.",
              "content" : msn_error,
              "theme" : "red",
              "size" : "md",
              "showAnimation" : "bounceInDown",
              "hideAnimation" : "bounceOutDown",
              "btns" : {
                "text" : "Aceptar",
                "theme" : "red"
              }
            });
          }
        }).error(function() {
          $.jAlert({
            "title" : "\u00a1Error!.",
            "content" : msn_error,
            "theme" : "red",
            "size" : "md",
            "showAnimation" : "bounceInDown",
            "hideAnimation" : "bounceOutDown",
            "btns" : {
              "text" : "Aceptar",
              "theme" : "red"
            }
          });
          console.log("error");
        });
      },
      /**
       * @return {undefined}
       */
      "onDeny" : function() {
      }
    });
  };
  $scope.dtOptions = dataAndEvents.newOptions().withLanguage({
    "sProcessing" : "Procesando...",
    "sLengthMenu" : "Mostrar _MENU_ registros",
    "sZeroRecords" : "No se encontraron resultados",
    "sEmptyTable" : "Ning\u00fan dato disponible en esta tabla",
    "sInfo" : "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty" : "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered" : "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix" : "",
    "sSearch" : "Buscar:",
    "sUrl" : "",
    "sInfoThousands" : ",",
    "sLoadingRecords" : "Cargando...",
    "oPaginate" : {
      "sFirst" : "Primero",
      "sLast" : "\u00daltimo",
      "sNext" : "Siguiente",
      "sPrevious" : "Anterior"
    },
    "oAria" : {
      "sSortAscending" : ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending" : ": Activar para ordenar la columna de manera descendente"
    }
  });
}]);

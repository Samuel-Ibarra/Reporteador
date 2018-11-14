var LoginModalController = {
    tabsElementName: ".logmod__tabs li",
    tabElementName: ".logmod__tab",
    inputElementsName: ".logmod__form .input",
    hidePasswordName: ".hide-password",

    inputElements: null,
    tabsElement: null,
    tabElement: null,
    hidePassword: null,

    activeTab: null,
    tabSelection: 0, // 0 - first, 1 - second

    findElements: function () {
        var base = this;

        base.tabsElement = $(base.tabsElementName);
        base.tabElement = $(base.tabElementName);
        base.inputElements = $(base.inputElementsName);
        base.hidePassword = $(base.hidePasswordName);

        return base;
    },

    setState: function (state) {
    	var base = this,
            elem = null;

        if (!state) {
            state = 0;
        }

        if (base.tabsElement) {
        	elem = $(base.tabsElement[state]);
            elem.addClass("current");
            $("." + elem.attr("data-tabtar")).addClass("show");
        }

        return base;
    },

    getActiveTab: function () {
        var base = this;

        base.tabsElement.each(function (i, el) {
           if ($(el).hasClass("current")) {
               base.activeTab = $(el);
           }
        });

        return base;
    },

    addClickEvents: function () {
    	var base = this;

        base.hidePassword.on("click", function (e) {
            var $this = $(this),
                $pwInput = $this.prev("input");

            if ($pwInput.attr("type") == "password") {
                $pwInput.attr("type", "text");
                $this.text("Hide");
            } else {
                $pwInput.attr("type", "password");
                $this.text("Show");
            }
        });

        base.tabsElement.on("click", function (e) {
            var targetTab = $(this).attr("data-tabtar");

            e.preventDefault();
            base.activeTab.removeClass("current");
            base.activeTab = $(this);
            base.activeTab.addClass("current");

            base.tabElement.each(function (i, el) {
                el = $(el);
                el.removeClass("show");
                if (el.hasClass(targetTab)) {
                    el.addClass("show");
                }
            });
        });

        base.inputElements.find("label").on("click", function (e) {
           var $this = $(this),
               $input = $this.next("input");

            $input.focus();
        });

        return base;
    },

    initialize: function () {
        var base = this;

        base.findElements().setState().getActiveTab().addClickEvents();
    }
};

function queryParameters () {
    var result = {};


    var params = window.location.search.split(/\?|\&/);

    params.forEach( function(it) {
        if (it) {
            var param = it.split("="); 
            result[param[0]] = param[1];
        }
    });

    return result;
}

function validateForm() {

    var email = document.getElementById("user-email").value;
    var pass1 = document.getElementById("user-pw").value;
    var pass2 = document.getElementById("user-pw-repeat").value;
    var name = document.getElementById("name").value;
    var lastname1 = document.getElementById("lastName1").value;
    var lastname2 = document.getElementById("lastName2").value;
    var street = document.getElementById("street").value;
    var number = document.getElementById("number").value;
    var colony = document.getElementById("colony").value;
    var municipality = document.getElementById("municipality").value;
    var phone = document.getElementById("phone").value;

    var validate = "";

    if (email == "" || email.length < 3) {
        validate += "Correo no valido\n";
    }
    if (pass1 == "" || pass1.length < 3) {
        validate += "Contraseña mayor a 6 caracteres\n";
    }
    if (pass2 != pass1) {
        validate += "las contraseñas no coinciden\n";
    }
    if (name == "" || name.length < 3) {
        validate += "Nombre no valido\n";
    }
    if (lastname1 == "" || lastname1.length < 3) {
        validate += "Apellido Paterno no valido\n";
    }
    if (lastname2 == "" || lastname2.length < 3) {
        validate += "Apellido Materno no valido\n";
    }
    if (street == "" || street.length < 3) {
        //validate = "Calle no valida";
    }
    if (colony == "" || colony.length < 3) {
        //validate = "colonia no valida";
    }
    if (municipality == "" || municipality.length < 3) {
        //validate = "Municipio no valido";
    }
    if (isNaN(number)) {
        //validate = "Numero de calle no valido";
    }
  if (isNaN(phone)) {
        validate += "Telefono no valido\n";
    }

    if(validate.length > 0 )
    {
      alert(validate);
      return false;
    }
}

function Login() {

    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;

    var validate = "";

    if (email == "" || email.length < 3) {
        validate += "Correo no valido\n";
    }
    if (pass == "" || pass.length < 3) {
        validate += "Contraseña mayor a 6 caracteres\n";
    }
    if(validate.length > 0 )
    {
      alert(validate);
      return false;
    }
}

$(document).ready(function() {
    LoginModalController.initialize();
    if(queryParameters().e == 1)
    alert("Contraseña o Correo Incorrectos");
    else {
      alert(queryParameters().e)
    }
});

define(["knockout", "text!./login-view.html"], function(ko, homeTemplate) {

    function LoginViewModel(params) {
        this.email = ko.observable();
        this.password = ko.observable();

        this.login = function(){
            //alert(this.email());
        }
    }

    return { viewModel: LoginViewModel, template: homeTemplate };

});
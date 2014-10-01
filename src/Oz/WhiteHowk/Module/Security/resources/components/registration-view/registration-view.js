define(["knockout", "text!./registration-view.html", "app/service/proxy"], function(ko, homeTemplate, proxy) {

    function LoginViewModel(params) {
        this.email = ko.observable();
        this.password = ko.observable();

        this.register = function(){
            proxy.call('security.user_service', 'register', {email: this.email(), password: this.password()})
                .done(function(data){
                    console.log(data);
                })
        }
    }

    return { viewModel: LoginViewModel, template: homeTemplate };

});

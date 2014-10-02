define(["knockout", "text!./registration-view.html", "app/service/proxy", "jquery"], function(ko, homeTemplate, proxy, $) {

    function LoginViewModel(params) {
        this.email = ko.observable();
        this.password = ko.observable();

        this.errors = ko.observableArray([]);

        this.register = function(){
            proxy.call('security.user_service', 'register', {email: this.email(), password: this.password()})
                .done(function(data){
                    console.log(data);
                }).fail(function(errors){
                    $.each(errors, function(index, value){
                        this.errors.push(value);
                    }.bind(this));
                }.bind(this));
        }
    }

    return { viewModel: LoginViewModel, template: homeTemplate };

});

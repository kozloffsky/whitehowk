define(['jquery','knockout'], function($, ko){

    function Proxy(){

    }

    Proxy.prototype = {
        call:function(service, method, args){
            var d = $.Deferred();
            $.post(
                "/service",
                JSON.stringify({
                    service: service,
                    method: method,
                    args: args
                })
            ).done(function(data){
                    console.log('OK! resounse is ', data);
                    d.resolve(data.result);
                }
            ).fail(function(){
                    console.log('Fail load service call');
                    d.reject();
                }
            );

            return d.promise();
        }
    }

    return new Proxy();

});

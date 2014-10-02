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
                    if(data.status == 'ok'){
                        d.resolve(data.result);
                    }else{
                        d.reject(data.result.errors);
                    }
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

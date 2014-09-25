define(['jquery','knockout'], function($, ko){

    function Proxy(){

    }

    Proxy.prototype = {
        call:function(name, args){
            var d = $.Deferred();
            $.post(
                "/service",
                JSON.stringify({
                    name: name,
                    args: args
                })
            ).done(function(data){
                    console.log('OK! resounse is ', JSON.parse(data));
                    d.resolve(JSON.parse(data));
                }
            ).fail(function(){
                    console.log('Fail load service call');
                }
            );

            return d.promise();
        }
    }

    return new Proxy();

});

define(["knockout", "crossroads", "hasher","app/service/proxy"], function(ko, crossroads, hasher, proxy) {

    // This module configures crossroads.js, a routing library. If you prefer, you
    // can use any other routing library (or none at all) as Knockout is designed to
    // compose cleanly with external libraries.
    //
    // You *don't* have to follow the pattern established here (each route entry
    // specifies a 'page', which is a Knockout component) - there's nothing built into
    // Knockout that requires or even knows about this technique. It's just one of
    // many possible ways of setting up client-side routes.



    function Router(config) {
        this.currentRoute = ko.observable({page:'about-page'});

        /*ko.utils.arrayForEach(config.routes, function(route) {
            crossroads.addRoute(route.url, function(requestParams) {
                currentRoute(ko.utils.extend(requestParams, route.params));
            });
        });*/

        //activateCrossroads();
        hasher.initialized.add(this.checkHash.bind(this));
        hasher.changed.add(this.checkHash.bind(this));
        hasher.init();
    }

    Router.prototype.checkHash = function(hash, oldHash) {
        //TODO: make service call to get component for this url or error
        console.log('New Hash is',hash);
        proxy.call('router',{hash: hash}).done(function(data){
            ko.components.register(data.componentName, {require:'components/'+data.componentName+'/'+data.component});
            this.currentRoute({page: data.componentName});
        }.bind(this));
    }

    function activateCrossroads() {
        function parseHash(newHash, oldHash) { crossroads.parse(newHash); }
        crossroads.normalizeFn = crossroads.NORM_AS_OBJECT;
        hasher.initialized.add(parseHash);
        hasher.changed.add(parseHash);
        hasher.init();
    }

    return new Router({
        routes: [
            { url: '',          params: { page: 'home-page' } },
            { url: 'about',     params: { page: 'about-page' } }
        ]
    });
});
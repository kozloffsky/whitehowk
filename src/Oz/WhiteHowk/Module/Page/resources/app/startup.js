define(['jquery', 'knockout', 'app/router', 'bootstrap', 'knockout-projections'], function($, ko, router) {

  // Components can be packaged as AMD modules, such as the following:
  ko.components.register('nav-bar', { require: 'components/nav-bar/nav-bar' });
  ko.components.register('alert', { require: 'components/alert/alert' });
  //ko.components.register('home-page', { require: 'components/home-page/home' });

  // ... or for template-only components, you can just point to a .html file directly:
  ko.components.register('about-page', {
    template: { require: 'text!/components/about-page/about-page.html' }
  });

  // Start the application
  ko.applyBindings({ route: router.currentRoute });
});

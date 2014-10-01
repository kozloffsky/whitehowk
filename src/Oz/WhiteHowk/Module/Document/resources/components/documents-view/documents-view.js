define(["knockout", "text!./documents-view.html"], function(ko, homeTemplate) {

    function HomeViewModel(params) {
        this.slug = ko.observable(params.slug);
    }

    return { viewModel: HomeViewModel, template: homeTemplate };

});

define(["knockout", "text!./documents-list.html"], function(ko, homeTemplate) {

    function DocumentViewModel(params) {
        this.slug = ko.observable(params.slug);
    }

    return { viewModel: DocumentViewModel, template: homeTemplate };

});


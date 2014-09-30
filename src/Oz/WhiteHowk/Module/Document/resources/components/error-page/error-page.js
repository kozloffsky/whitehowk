define(["knockout", "text!./error-page.html"], function(ko, homeTemplate) {

    function HomeViewModel() {

    }

    return { viewModel: HomeViewModel, template: homeTemplate };

});

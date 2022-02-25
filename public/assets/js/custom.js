// // Register the plugin with FilePond
// FilePond.registerPlugin(FilePondPluginImagePreview);

// // Get a reference to the file input element
// const inputElement = document.querySelectorAll('input[type="file"]');

// // Create the FilePond instance
// const pond = FilePond.create(inputElement);
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
    },
});

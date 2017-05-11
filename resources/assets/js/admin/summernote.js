$(document).ready(function(){

    $('#summernote').summernote({
        height:300,
        toolbar: [
            // [groupName, [list of button]]
            ['style',['style']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            // ['fontname',['fontname']],
            // ['fontsize', ['fontsize']],
            // ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert',['video','picture','link','hr']],
            ['view',['fullscreen','codeview']],
            ['help',['help']]
        ],
        disableDragAndDrop: true,
    });

});

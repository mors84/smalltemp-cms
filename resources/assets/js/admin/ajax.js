// AJAX
$(document).ready(function() {

    /*
        Change Active
    */
    $('.buttonChangeActive').on('click', function() {

        var $this = $(this);
        var $isActive = $this.val();
        var $id = $this.data('id');
        var $url = $this.data('url');

        $.ajax({
            type: 'put',
            url: $url,
            headers: {'X-CSRF-TOKEN': token},
            data: {
                is_active: $isActive
            },
            success: function(data) {
                $isActive == 1 ? $this.val(0) : $this.val(1);
                getNotification(data);
            }
        });
    });


    /*
        Add new Tag
    */
    $('#buttonAddTag').on('click', function() {

        var $name = $('#name');
        var $metadataTitle = $('#metadata_title');
        var $metadataKeywords = $('#metadata_keywords');
        var $metadataDescription = $('#metadata_description');
        var $modalAddTag = $('#modalAddTag');
        var $selectList = $('#select-list');
        var $token = $('input[name="_token"]');
        var $errorName = $('#error-name');
        var $errorMetadataTitle = $('#error-metadata-title');
        var $errorMetadataKeywords = $('#error-metadata-keywords');
        var $errorMetadataDescription = $('#error-metadata-description');

        $.ajax({
            type: 'post',
            url: url,
            headers: {'X-CSRF-TOKEN': $token.val()},
            data: {
                name: $name.val(),
                metadata_title: $metadataTitle.val(),
                metadata_keywords: $metadataKeywords.val(),
                metadata_description: $metadataDescription.val()
            },
            success: function(data) {
                $modalAddTag.modal('hide');
                clearValues();
                getNotification(data);
                getUpdatedTags(data);
            },
            error: function(data) {
                $errorName.html(data.responseJSON.name);
                $errorMetadataTitle.html(data.responseJSON.metadata_title);
                $errorMetadataKeywords.html(data.responseJSON.metadata_keywords);
                $errorMetadataDescription.html(data.responseJSON.metadata_description);
            }
        });


        // HELPER FUNCTIONS
        function clearValues() {
            $name.val('');
            $metadataTitle.val('');
            $metadataKeywords.val('');
            $metadataDescription.val('');
            $errorName.html('');
            $errorMetadataTitle.html('');
            $errorMetadataKeywords.html('');
            $errorMetadataDescription.html('');
        }

        function getUpdatedTags(data) {
            var activeTags = getActiveTags();
            var newHTML = '';
            for (var i = 0; i < data.newTags.length; i++) {
                isSelected = activeTags.indexOf(data.newTags[i].name) != -1 ? 'selected ' : null;
                newHTML += '<option name="tags[]" '+isSelected;
                newHTML += ' value="'+data.newTags[i].id+'">';
                newHTML += data.newTags[i].name+'</option>';
            }
            $selectList.html(newHTML);
            $selectList.trigger('chosen:updated');
        }

        function getActiveTags() {
            var activeTags = [];
            $('.chosen-choices').find('.search-choice').each(function() {
                var $activeTagName = $(this).find('span').text();
                activeTags.push($activeTagName);
            });
            return activeTags;
        }

    });


    // HELPER FUNCTIONS FOR ALL
    function getNotification(data) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "progressBar": true,
            "preventDuplicates": false,
            "positionClass": "toast-bottom-right",
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "1000",
            "timeOut": "7000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr.success(data['status'], data['title']);
    }


});

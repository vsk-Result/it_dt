$(document).ready(function() {
    initialize();
});

$('.article').on('click', function() {
    var show_url = $(this).data('show-url');
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    var destroy_url = $(this).data('destroy-url');
    $.ajax({
        url: show_url
    }).done(function(data) {
        $('#showArticle .modal-title').text(data.article.title);
        $('#showArticle .modal-body').html(data.article.content);
        $('#showArticle .edit-article').data('edit-url', edit_url);
        $('#showArticle .edit-article').data('update-url', update_url);
        $('#showArticle #destroy-article-form').attr('action', destroy_url);
        $('#showArticle').modal('show');
    });
});

$('body').on('click', '.edit-article', function () {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#editArticle .modal-title').text(data.article.title);
        $('#article-category').val(data.article.category_id).trigger('change');
        $('#article-icon').val(data.article.icon_id);
        $('#editArticle .choose-icon i').attr('class', data.icon + ' mr-2');
        $('#article-title').val(data.article.title);
        $('#article-tags').tokenfield('setTokens', data.tags);
        $('#article-content').summernote('code', data.article.content);
        $('#edit-article-form').attr('action', update_url);
    }).always(function() {
        $('#showArticle').one('hidden.bs.modal', function () {
            $('#editArticle').modal('show');
        }).modal('hide');
    });
});

$('#editArticle').on('shown.bs.modal', function(){
    $('.note-toolbar-wrapper').removeAttr('style');
    $('.note-toolbar').removeAttr('style');
});

$('#createArticle').on('shown.bs.modal', function(){
    $('.note-toolbar-wrapper').removeAttr('style');
    $('.note-toolbar').removeAttr('style');
});

$('body').on('click', '.destroy-article', function () {
    if (confirm('Вы действительно хотите удалить статью?')) {
        $('#destroy-article-form').submit();
    }
});

$('body').on('click', '.print-article', function () {
    $("#showArticle .modal-content").print({
        noPrintSelector: ".no-print",
    });
});

$('.category').on('click', function() {
    var edit_url = $(this).data('edit-url');
    var update_url = $(this).data('update-url');
    $.ajax({
        url: edit_url
    }).done(function(data) {
        $('#editCategory .modal-title').text(data.category.name);
        $('#category-icon').val(data.category.icon_id);
        $('#editCategory .choose-icon i').attr('class', data.icon + ' mr-2');
        $('#category-name').val(data.category.name);
        $('#edit-category-form').attr('action', update_url);
    }).always(function() {
        $('#editCategory').modal('show');
    });
});

$('body').on('click', '.icons-container i', function () {
    var icon = $(this);
    var parent = icon.parents('.modal-body');
    var icons_container = parent.find('.icons-container');
    var input_icon = parent.find('.input-icon');
    var button_icon = parent.find('.choose-icon i');

    input_icon.val(icon.data('id'));
    button_icon.attr('class', icon.attr('class') + ' mr-2').removeClass('icon-2x');
    icons_container.html('').hide();
});

$('body').on('click', '.choose-icon', function () {
    var button = $(this);
    var parent = button.parents('.modal-body');
    var icons_container = parent.find('.icons-container');

    if (icons_container.is(":visible")) {
        icons_container.html('').hide();
    } else {
        icons_container.html($('#our-icon-list').html()).show();
    }
});

function setIcon (icon) {
    if (!icon.id) { return icon.text; }
    return $('<span><i class="' + icon.element.id + ' mr-2"></i>' + icon.text + '</span>');
}

// $('#editArticle .summernote').next().on('focusout', ".note-codable", function() {
//     if ($('#editArticle .summernote').summernote('codeview.isActivated')) {
//         $('#editArticle .summernote').summernote('codeview.deactivate');
//     }
// });

$('body').on('click', '#article-submit', function(e) {
    e.preventDefault();
    $('#article-content').val(
        $('#editArticle .summernote').summernote('code')
    );
    $('#editArticle form').submit();
});

function initialize() {
    $('.summernote').summernote({
        height: 400,
        dialogsInBody: true,
        callbacks : {
            onInit: function() {
                var noteBtn = '<button id="makeCode" type="button" class="note-btn btn btn-light btn-sm" title="Identify a code note" data-event="something" tabindex="-1">code</button>';
                var fileGroup = '<div class="note-file btn-group">' + noteBtn + '</div>';
                $(fileGroup).appendTo($('.note-toolbar'));
                $('#makeCode').tooltip({container: 'body', placement: 'bottom'});
                $('body').on('click', '#makeCode', function(event) {
                    var highlight = window.getSelection(),
                        code = document.createElement('code'),
                        range = highlight.getRangeAt(0);

                    code.innerHTML = highlight;
                    code.className = 'code';

                    range.deleteContents();
                    range.insertNode(code);
                });
            },
        },
    });

    $('.select').select2();
    $('.select-icon').select2({
        templateResult: setIcon,
        templateSelection: setIcon
    });

    $('.tokenfield').tokenfield();
}


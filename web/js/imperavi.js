(function($)
{
    $.Redactor.prototype.linkes = function()
    {
        return {
            myAjax: function()
            {
                var options='';
                var langid = this.$textarea.attr("data-id");
                $.ajax({
                    'dataType' : 'text',
                    'data': {'lang_id': langid},
                    'async':false,
                    'success' : function(data) {
                        options = data;
                    },
                    'type' : 'post',
                    'url' : '/backend/entity/imperavi-linkes'
                });
                return options;
            },
            getTemplate: function()
            {
                return String()
                    + '<section id="redactor-modal-linkes-insert">'
                    + '<label>Ссылки по сайту</label>'

                    + '<select id="redactor-insert-linkes-select">'
                        + this.linkes.myAjax()
                    + '</select>'

                    + '<label>Текст</label>'
                    + '<input id="redactor-insert-linkes-text" type="text">'
                    + '</section>';
            },
            init: function()
            {
                var button = this.button.addAfter('link', 'linker fa fa-link', ' Link in site');
                this.button.addCallback(button, this.linkes.show);
            },
            show: function()
            {
                this.modal.addTemplate('linkes', this.linkes.getTemplate());
                this.modal.load('linkes', 'Link in site', 700);
                this.modal.createCancelButton();
                var button = this.modal.createActionButton('Insert');
                button.on('click', this.linkes.insert);

                this.selection.save();
                this.modal.show();
                $('#redactor-insert-linkes-text').focus();

            },
            insert: function () {
                var text = $('#redactor-insert-linkes-text').val();
                var url = $('#redactor-insert-linkes-select').val();
                var dataid = $('#redactor-insert-linkes-select option:selected').data("id");
                var data = '<a class="article_content_imperavi" data-id="'+dataid+'"href="'+url+'">'+text+'</a>';

                this.selection.restore();
                this.modal.close();

                this.insert.html(data);
                this.code.sync();
            }
        };
    };
})(jQuery);
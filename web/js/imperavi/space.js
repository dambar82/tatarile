(function($)
{
    $.Redactor.prototype.space = function()
    {
        return {
            init: function()
            {
                var button = this.button.addAfter('space', 'space fa fa-eye', 'Неразрывный пробел');
                this.button.addCallback(button, this.space.insert);
            },
            insert: function () {
                var data = ' ';
                this.selection.restore();
                this.insert.html(data);
                this.code.sync();
            }
        };
    };
})(jQuery);
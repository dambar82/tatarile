(function($)
{
    $.Redactor.prototype.longtire = function()
    {
        return {
            init: function()
            {
                var button = this.button.addAfter('linker', 'longtire fa fa-minus', 'Тире');
                this.button.addCallback(button, this.longtire.insert);
            },
            insert: function () {
                var data = '&nbsp;–&nbsp;';
                this.selection.restore();
                this.insert.html(data);
                this.code.sync();
            }
        };
    };
})(jQuery);
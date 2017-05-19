(function($)
{
    $.Redactor.prototype.kavychki = function()
    {
        return {
            init: function()
            {
                var button = this.button.addAfter('tire', 'kavychki fa fa-quote-right', 'Кавычки ёлочки');
                this.button.addCallback(button, this.kavychki.insert);
            },
            insert: function () {
                var data = '&#171;&#187;';
                this.selection.restore();
                this.insert.html(data);
                this.code.sync();
            }
        };
    };
})(jQuery);
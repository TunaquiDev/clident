var appUtils = function(){}
appUtils.prototype.FullScreen = function(element){
    if(typeof(element)==='string'){
        element = document.getElementById(element);
    }
    if(element.requestFullScreen) {
        element.requestFullScreen();
    } else if(element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if(element.webkitRequestFullScreen) {
        element.webkitRequestFullScreen();
    }
}
appUtils.prototype.CancelFullScreen = function(){
    if(document.cancelFullScreen) {
        document.cancelFullScreen();
    } else if(document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if(document.webkitCancelFullScreen) {
        document.webkitCancelFullScreen();
    }
}
appUtils.prototype.ComboResponse = function(options){
    $.ajax({
        url: BasePage.StringFormat('{0}/{1}/{2}', BasePage.basePath, options.controller,options.action),
        data: options.data?options.data:{},
        success: function(response){
            var defaultText = typeof (options.defaultText) === 'string' ? options.defaultText : '<< SELECCIONE >>';
            $(options.target)
            .empty()
            .append($('<option/>',{ value: 0, text: defaultText }));
            $(response.data).each(function(i,e){
                var args = new Object();
                Object.keys(options.keys).map(function(k){
                    args[k] = e[options.keys[k]];
                });
                args['data-toggle'] = 'tooltip';
                $(options.target).append($('<option/>', args));
            });
            $(options.target).css({'width':'100%'}).select2();
            if($.isFunction(options.callback)){
                options.callback($(options.target), response);
            }
        }
    });
}
appUtils.prototype.Checked = function (target, val) {
    val = parseInt(val);
    var role = $(target).attr('data-role');
    if(role==='bstSwitch'){
        $(target).bootstrapSwitch('state', val===1);
    }else {
        $(target).prop("checked", val==1);
    }
    
}
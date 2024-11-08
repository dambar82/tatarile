/*
 * iziModal | v1.4.2
 * http://izimodal.marcelodolce.com
 * by Marcelo Dolce.
 */
if("undefined"==typeof jQuery)throw new Error("iziModal requires jQuery");(function(t){"use strict";function e(){var t,e=document.createElement("fakeelement"),i={animation:"animationend",OAnimation:"oAnimationEnd",MozAnimation:"animationend",WebkitAnimation:"webkitAnimationEnd"};for(t in i)if(void 0!==e.style[t])return i[t]}var i=t(window),n=t(document),o="iziModal",s={CLOSING:"closing",CLOSED:"closed",OPENING:"opening",OPENED:"opened",DESTROYED:"destroyed"},a=e(),r=!!/Mobi/.test(navigator.userAgent),l=0,d=function(t,e){this.init(t,e)};d.prototype={constructor:d,init:function(e,i){var n=this;this.$element=t(e),this.id=this.$element.attr("id"),this.content=this.$element.html(),this.state=s.CLOSED,this.options=i,this.width=0,this.timer=null,this.timerTimeout=null,this.progressBar=null,this.isPaused=!1,this.isFullscreen=!1,this.headerHeight=0,this.modalHeight=0,this.$overlay=t('<div class="'+o+'-overlay" style="background-color:'+i.overlayColor+'"></div>'),this.$navigate=t('<div class="'+o+'-navigate"><div class="'+o+'-navigate-caption">Use</div><button class="'+o+'-navigate-prev"></button><button class="'+o+'-navigate-next"></button></div>'),this.group={name:this.$element.attr("data-"+o+"-group"),index:null,ids:[]},this.$element.attr("aria-hidden","true"),this.$element.attr("aria-labelledby",this.id),this.$element.attr("role","dialog"),this.$element.hasClass("iziModal")||this.$element.addClass("iziModal"),void 0===this.group.name&&""!==i.group&&(this.group.name=i.group,this.$element.attr("data-"+o+"-group",i.group)),this.options.loop===!0&&this.$element.attr("data-"+o+"-loop",!0),t.each(this.options,function(t,e){var s=n.$element.attr("data-"+o+"-"+t);try{"undefined"!=typeof s&&s!==!1&&(""===s?i[t]=!0:"function"==typeof e?i[t]=new Function(s):i[t]=s)}catch(a){}}),this.$header=t('<div class="'+o+'-header"><h2 class="'+o+'-header-title">'+i.title+'</h2><p class="'+o+'-header-subtitle">'+i.subtitle+'</p><a href="javascript:void(0)" class="'+o+"-button "+o+'-button-close" data-'+o+"-close></a></div>"),i.fullscreen===!0&&(this.$header.append('<a href="javascript:void(0)" class="'+o+"-button "+o+'-button-fullscreen" data-'+o+"-fullscreen></a>"),i.rtl===!0?this.$header.css("padding-left","76px"):this.$header.css("padding-right","76px")),i.timeoutProgressbar!==!0||isNaN(parseInt(i.timeout))||i.timeout===!1||0===i.timeout||this.$header.prepend('<div class="'+o+'-progressbar"><div style="background-color:'+i.timeoutProgressbarColor+'"></div></div>'),i.iframe===!0?(this.$element.html('<div class="'+o+'-wrap"><div class="'+o+'-content"><iframe class="'+o+'-iframe"></iframe>'+this.content+"</div></div>"),null!==i.iframeHeight&&this.$element.find("."+o+"-iframe").css("height",i.iframeHeight)):this.$element.html('<div class="'+o+'-wrap"><div class="'+o+'-content">'+this.content+"</div></div>"),""===i.subtitle&&this.$header.addClass(o+"-noSubtitle"),""===i.title&&""===i.subtitle||(null!==i.headerColor&&(this.$element.css("border-bottom","3px solid "+i.headerColor),this.$header.css("background",this.options.headerColor)),null===i.icon&&null===i.iconText||(this.$header.prepend('<i class="'+o+'-header-icon"></i>'),null!==i.icon&&this.$header.find("."+o+"-header-icon").addClass(i.icon).css("color",i.iconColor),null!==i.iconText&&this.$header.find("."+o+"-header-icon").html(i.iconText)),this.$element.css("overflow","hidden").prepend(this.$header)),null===i.zindex||isNaN(parseInt(i.zindex))||(this.$element.css("z-index",i.zindex),this.$navigate.css("z-index",i.zindex-1),this.$overlay.css("z-index",i.zindex-2)),""!==i.radius&&this.$element.css("border-radius",i.radius),""!==i.padding&&this.$element.find("."+o+"-content").css("padding",i.padding),""!==i.theme&&("light"===i.theme?this.$element.addClass(o+"-light"):this.$element.addClass(i.theme)),i.openFullscreen===!0&&(this.isFullscreen=!0,this.$element.addClass("isFullscreen")),i.rtl===!0&&this.$element.addClass(o+"-rtl"),"top"!==i.attached&&"top"!=this.$element.attr("data-"+o+"-attached")||this.$element.addClass("isAttachedTop"),"bottom"!==i.attached&&"bottom"!=this.$element.attr("data-"+o+"-attached")||this.$element.addClass("isAttachedBottom"),function(){t(document.body).find("style[rel="+n.id+"]").remove();var e=/%|px|em|cm/,s=String(i.width).split(e),a=String(i.width),r="px";s=String(s).split(",")[0],isNaN(i.width)&&(r=String(i.width).indexOf("%")!=-1?"%":a.slice("-2")),n.$element.css({"margin-left":-(s/2)+r,"max-width":parseInt(s)+r}),n.width=n.$element.outerWidth(),parseInt(s)>n.width&&(n.width=parseInt(s)),n.mediaQueries='<style rel="'+n.id+'">@media handheld, only screen and (max-width: '+n.width+"px) { #"+n.id+"{ width:100% !important; max-width:100% !important; margin-left:0 !important; left:0 !important; right:0 !important; border-radius:0!important} #"+n.id+" ."+o+"-header{border-radius:0!important} }</style>",t(document.body).append(n.mediaQueries),n.$element.css("margin-top",parseInt(-(n.$element.innerHeight()/2))+"px")}()},setGroup:function(e){var i=this,n=this.group.name||e;if(this.group.ids=[],void 0!==e&&e!==this.group.name&&(n=e,this.group.name=n,this.$element.attr("data-"+o+"-group",n)),void 0!==n&&""!==n){var s=0;t.each(t("."+o+"[data-"+o+"-group="+n+"]"),function(e,n){i.group.ids.push(t(this).attr("id")),i.id==t(this).attr("id")&&(i.group.index=s),s++})}},toggle:function(){this.state==s.OPENED&&this.close(),this.state==s.CLOSED&&this.open()},open:function(e){function i(){d.state=s.OPENED,d.$element.trigger(s.OPENED),d.options.onOpened&&"function"==typeof d.options.onOpened&&d.options.onOpened(d)}function l(){d.$element.off("click","[data-"+o+"-close]").on("click","[data-"+o+"-close]",function(e){e.preventDefault();var i=t(e.currentTarget).attr("data-"+o+"-transitionOut");void 0!==i?d.close({transition:i}):d.close()}),d.$element.off("click","[data-"+o+"-fullscreen]").on("click","[data-"+o+"-fullscreen]",function(t){t.preventDefault(),d.isFullscreen===!0?(d.isFullscreen=!1,d.$element.removeClass("isFullscreen")):(d.isFullscreen=!0,d.$element.addClass("isFullscreen")),d.options.onFullscreen&&"function"==typeof d.options.onFullscreen&&d.options.onFullscreen(d),d.$element.trigger("fullscreen",d)}),d.$navigate.off("click","."+o+"-navigate-next").on("click","."+o+"-navigate-next",function(t){d.next(t)}),d.$element.off("click","[data-"+o+"-next]").on("click","[data-"+o+"-next]",function(t){d.next(t)}),d.$navigate.off("click","."+o+"-navigate-prev").on("click","."+o+"-navigate-prev",function(t){d.prev(t)}),d.$element.off("click","[data-"+o+"-prev]").on("click","[data-"+o+"-prev]",function(t){d.prev(t)})}var d=this;if(this.state==s.CLOSED){if(l(),this.setGroup(),this.state=s.OPENING,this.$element.trigger(s.OPENING),this.$element.attr("aria-hidden","false"),this.options.iframe===!0){this.$element.find("."+o+"-content").addClass(o+"-content-loader"),this.$element.find("."+o+"-iframe").on("load",function(){t(this).parent().removeClass(o+"-content-loader")});var h=null;try{h=""!==t(e.currentTarget).attr("href")?t(e.currentTarget).attr("href"):null}catch(c){}if(null===this.options.iframeURL||null!==h&&void 0!==h||(h=this.options.iframeURL),null===h||void 0===h)throw new Error("Failed to find iframe URL");this.$element.find("."+o+"-iframe").attr("src",h)}(this.options.bodyOverflow||r)&&(t("html").addClass(o+"-isOverflow"),r&&t("body").css("overflow","hidden")),this.options.onOpening&&"function"==typeof this.options.onOpening&&this.options.onOpening(this),function(){if(d.group.ids.length>1){d.$navigate.appendTo("body"),d.$navigate.addClass(d.options.transitionInOverlay),d.options.navigateCaption===!0&&d.$navigate.find("."+o+"-navigate-caption").show(),d.options.navigateArrows===!0||"closeToModal"===d.options.navigateArrows?(d.$navigate.find("."+o+"-navigate-prev").css("margin-left",-(d.width/2+84)),d.$navigate.find("."+o+"-navigate-next").css("margin-right",-(d.width/2+84))):(d.$navigate.find("."+o+"-navigate-prev").css("left",0),d.$navigate.find("."+o+"-navigate-next").css("right",0));var n;0===d.group.index&&(n=t("."+o+"[data-"+o+'-group="'+d.group.name+'"][data-'+o+"-loop]").length,0===n&&d.options.loop===!1&&d.$navigate.find("."+o+"-navigate-prev").hide()),d.group.index+1===d.group.ids.length&&(n=t("."+o+"[data-"+o+'-group="'+d.group.name+'"][data-'+o+"-loop]").length,0===n&&d.options.loop===!1&&d.$navigate.find("."+o+"-navigate-next").hide())}d.options.overlay===!0&&d.$overlay.appendTo("body"),d.options.transitionInOverlay&&d.$overlay.addClass(d.options.transitionInOverlay);var s=d.options.transitionIn;"object"==typeof e&&(void 0===e.transition&&void 0===e.transitionIn||(s=e.transition||e.transitionIn)),""!==s?(d.$element.addClass("transitionIn "+s).show(),d.$element.find("."+o+"-wrap").one(a,function(){d.$element.removeClass(s+" transitionIn"),d.$overlay.removeClass(d.options.transitionInOverlay),d.$navigate.removeClass(d.options.transitionInOverlay),i()})):(d.$element.show(),i()),d.options.pauseOnHover!==!0||d.options.pauseOnHover!==!0||d.options.timeout===!1||isNaN(parseInt(d.options.timeout))||d.options.timeout===!1||0===d.options.timeout||(d.$element.off("mouseenter").on("mouseenter",function(t){t.preventDefault(),d.isPaused=!0}),d.$element.off("mouseleave").on("mouseleave",function(t){t.preventDefault(),d.isPaused=!1}))}(),this.options.timeout===!1||isNaN(parseInt(this.options.timeout))||this.options.timeout===!1||0===this.options.timeout||(this.options.timeoutProgressbar===!0?(this.progressBar={hideEta:null,maxHideTime:null,currentTime:(new Date).getTime(),el:this.$element.find("."+o+"-progressbar > div"),updateProgress:function(){if(!d.isPaused){d.progressBar.currentTime=d.progressBar.currentTime+10;var t=(d.progressBar.hideEta-d.progressBar.currentTime)/d.progressBar.maxHideTime*100;d.progressBar.el.width(t+"%"),t<0&&d.close()}}},this.options.timeout>0&&(this.progressBar.maxHideTime=parseFloat(this.options.timeout),this.progressBar.hideEta=(new Date).getTime()+this.progressBar.maxHideTime,this.timerTimeout=setInterval(this.progressBar.updateProgress,10))):this.timerTimeout=setTimeout(function(){d.close()},d.options.timeout)),this.options.overlayClose&&!this.$element.hasClass(this.options.transitionOut)&&this.$overlay.click(function(){d.close()}),this.options.focusInput&&this.$element.find(":input:not(button):enabled:visible:first").focus(),function u(){d.recalculateLayout(),d.timer=setTimeout(u,300)}(),function(){if(d.options.history){var t=document.title;document.title=t+" - "+d.options.title,document.location.hash=d.id,document.title=t}}(),n.keydown(function(t){d.options.closeOnEscape&&27===t.keyCode&&d.close()})}},close:function(e){function i(){l.state=s.CLOSED,l.$element.trigger(s.CLOSED),l.options.iframe===!0&&l.$element.find("."+o+"-iframe").attr("src",""),(l.options.bodyOverflow||r)&&(t("html").removeClass(o+"-isOverflow"),r&&t("body").css("overflow","auto")),l.options.onClosed&&"function"==typeof l.options.onClosed&&l.options.onClosed(l),l.options.restoreDefaultContent===!0&&l.$element.find("."+o+"-content").html(l.content),void 0===t("."+o+":visible").attr("id")&&t("html").removeClass(o+"-isAttached")}var l=this;if(this.state==s.OPENED||this.state==s.OPENING){n.off("keydown"),this.state=s.CLOSING,this.$element.trigger(s.CLOSING),this.$element.attr("aria-hidden","true"),clearTimeout(this.timer),clearTimeout(this.timerTimeout),l.options.onClosing&&"function"==typeof l.options.onClosing&&l.options.onClosing(this);var d=this.options.transitionOut;if("object"==typeof e&&(void 0===e.transition&&void 0===e.transitionOut||(d=e.transition||e.transitionOut)),""!==d){var h="light"==this.options.theme?o+"-light":this.options.theme;this.$element.attr("class",o+" transitionOut "+d+" "+h+" "+String(this.isFullscreen===!0?"isFullscreen":"")+" "+String(this.$element.hasClass("isAttached")?"isAttached":"")+" "+String("top"===this.options.attached?"isAttachedTop":"")+" "+String("bottom"===this.options.attached?"isAttachedBottom":"")+(this.options.rtl?o+"-rtl":"")),this.$overlay.attr("class",o+"-overlay "+this.options.transitionOutOverlay),this.$navigate.attr("class",o+"-navigate "+this.options.transitionOutOverlay),this.$element.one(a,function(){l.$element.hasClass(d)&&l.$element.removeClass(d+" transitionOut").hide(),l.$overlay.removeClass(l.options.transitionOutOverlay).remove(),l.$navigate.removeClass(l.options.transitionOutOverlay).remove(),i()})}else this.$element.hide(),this.$overlay.remove(),this.$navigate.remove(),i()}},next:function(e){var i=this,n="fadeInRight",s="fadeOutLeft",a=t("."+o+":visible"),r={};r.out=this,void 0!==e&&"object"!=typeof e?(e.preventDefault(),a=t(e.currentTarget),n=a.attr("data-"+o+"-transitionIn"),s=a.attr("data-"+o+"-transitionOut")):void 0!==e&&(void 0!==e.transitionIn&&(n=e.transitionIn),void 0!==e.transitionOut&&(s=e.transitionOut)),this.close({transition:s}),setTimeout(function(){for(var e=t("."+o+"[data-"+o+'-group="'+i.group.name+'"][data-'+o+"-loop]").length,s=i.group.index+1;s<=i.group.ids.length;s++){try{r["in"]=t("#"+i.group.ids[s]).data().iziModal}catch(a){console.info("No next modal")}if("undefined"!=typeof r["in"]){t("#"+i.group.ids[s]).iziModal("open",{transition:n});break}if(s==i.group.ids.length&&e>0||i.options.loop===!0)for(var l=0;l<=i.group.ids.length;l++)if(r["in"]=t("#"+i.group.ids[l]).data().iziModal,"undefined"!=typeof r["in"]){t("#"+i.group.ids[l]).iziModal("open",{transition:n});break}}},200),t(document).trigger(o+"-group-change",r)},prev:function(e){var i=this,n="fadeInLeft",s="fadeOutRight",a=t("."+o+":visible"),r={};r.out=this,void 0!==e&&"object"!=typeof e?(e.preventDefault(),a=t(e.currentTarget),n=a.attr("data-"+o+"-transitionIn"),s=a.attr("data-"+o+"-transitionOut")):void 0!==e&&(void 0!==e.transitionIn&&(n=e.transitionIn),void 0!==e.transitionOut&&(s=e.transitionOut)),this.close({transition:s}),setTimeout(function(){for(var e=t("."+o+"[data-"+o+'-group="'+i.group.name+'"][data-'+o+"-loop]").length,s=i.group.index;s>=0;s--){try{r["in"]=t("#"+i.group.ids[s-1]).data().iziModal}catch(a){console.info("No previous modal")}if("undefined"!=typeof r["in"]){t("#"+i.group.ids[s-1]).iziModal("open",{transition:n});break}if(0===s&&e>0||i.options.loop===!0)for(var l=i.group.ids.length-1;l>=0;l--)if(r["in"]=t("#"+i.group.ids[l]).data().iziModal,"undefined"!=typeof r["in"]){t("#"+i.group.ids[l]).iziModal("open",{transition:n});break}}},200),t(document).trigger(o+"-group-change",r)},destroy:function(){var e=t.Event("destroy");this.$element.trigger(e),n.off("keydown"),clearTimeout(this.timer),clearTimeout(this.timerTimeout),this.options.iframe===!0&&this.$element.find("."+o+"-iframe").remove(),this.$element.html(this.$element.find("."+o+"-content").html()),n.find("style[rel="+this.id+"]").remove(),this.$element.off("click","[data-"+o+"-close]"),this.$element.off("click","[data-"+o+"-fullscreen]"),this.$element.off("."+o).removeData(o).attr("style",""),this.$overlay.remove(),this.$navigate.remove(),this.$element.trigger(s.DESTROYED),this.$element=null},getState:function(){return this.state},getGroup:function(){return this.group},setTitle:function(t){null!==this.options.title&&(this.$header.find("."+o+"-header-title").html(t),this.options.title=t)},setSubtitle:function(t){null!==this.options.subtitle&&(this.$header.find("."+o+"-header-subtitle").html(t),this.options.subtitle=t)},setIcon:function(t){0===this.$header.find("."+o+"-header-icon").length&&this.$header.prepend('<i class="'+o+'-header-icon"></i>'),this.$header.find("."+o+"-header-icon").attr("class",o+"-header-icon "+t),this.options.icon=t},setIconText:function(t){this.$header.find("."+o+"-header-icon").html(t),this.options.iconText=t},setHeaderColor:function(t){this.$element.css("border-bottom","3px solid "+t),this.$header.css("background",t),this.options.headerColor=t},setZindex:function(t){isNaN(parseInt(this.options.zindex))||(this.options.zindex=t,this.$element.css("z-index",t),this.$navigate.css("z-index",t-1),this.$overlay.css("z-index",t-2))},setTransitionIn:function(t){this.options.transitionIn=param.transition},setTransitionOut:function(t){this.options.transitionOut=param.transition},startLoading:function(){this.$element.find("."+o+"-loader").length||this.$element.append('<div class="'+o+"-loader "+this.options.transitionInOverlay+'"></div>')},stopLoading:function(){var t=this;this.$element.find("."+o+"-loader").removeClass(this.options.transitionInOverlay).addClass(this.options.transitionOutOverlay),this.$element.find("."+o+"-loader").one(a,function(){t.$element.find("."+o+"-loader").removeClass(t.options.transitionOutOverlay).remove()})},recalculateLayout:function(){this.$element.find("."+o+"-header").length&&(this.headerHeight=parseInt(this.$element.find("."+o+"-header").innerHeight())+2,this.$element.css("overflow","hidden"));var e=i.height(),n=this.$element.outerHeight(),a=this.$element.find("."+o+"-content")[0].scrollHeight,r=parseInt(-((this.$element.innerHeight()+1)/2))+"px";if(n!==this.modalHeight&&(this.modalHeight=n,this.options.onResize&&"function"==typeof this.options.onResize&&this.options.onResize(this)),this.state==s.OPENED||this.state==s.OPENING)if(this.options.iframe===!0)e<this.options.iframeHeight+this.headerHeight||this.isFullscreen===!0?(t("html").addClass(o+"-isAttached"),this.$element.addClass("isAttached"),this.$element.find("."+o+"-iframe").css({height:parseInt(e-this.headerHeight)+"px"})):(t("html").removeClass(o+"-isAttached"),this.$element.removeClass("isAttached"),this.$element.find("."+o+"-iframe").css({height:parseInt(this.options.iframeHeight)+"px"}));else{e>a+this.headerHeight&&this.isFullscreen!==!0&&(t("html").removeClass(o+"-isAttached"),this.$element.removeClass("isAttached"),this.$element.find("."+o+"-wrap").css({height:"auto"})),(a+this.headerHeight>e||Math.ceil(this.$element.innerHeight())<a||this.isFullscreen===!0)&&(t("html").hasClass(o+"-isAttached")||(t("html").addClass(o+"-isAttached"),this.$element.addClass("isAttached")),this.$element.find("."+o+"-wrap").css({height:parseInt(e-this.headerHeight)+"px"}));var l=this.$element.find("."+o+"-wrap").scrollTop(),d=this.$element.find("."+o+"-content").innerHeight(),h=this.$element.find("."+o+"-wrap").innerHeight();h+l<d-50?this.$element.addClass("hasScroll"):this.$element.removeClass("hasScroll")}this.$element.css("margin-top")==r||"0px"==this.$element.css("margin-top")||t("html").hasClass(o+"-isAttached")||this.$element.css("margin-top",r)}},i.off("hashchange load").on("hashchange load",function(e){var i=document.location.hash;if(0===l)if(""!==i){t.each(t("."+o),function(e,n){var o=t(n).iziModal("getState");"opened"!=o&&"opening"!=o||"#"+t(n).attr("id")!==i&&t(n).iziModal("close")});try{var n=t(i).data();"undefined"!=typeof n&&("load"===e.type?n.iziModal.options.autoOpen!==!1&&t(i).iziModal("open"):setTimeout(function(){t(i).iziModal("open")},200))}catch(s){console.info(s)}}else t.each(t("."+o),function(e,i){var n=t(i).iziModal("getState");"opened"!=n&&"opening"!=n||t(i).iziModal("close")});else l=0}),n.off("click","[data-"+o+"-open]").on("click","[data-"+o+"-open]",function(e){e.preventDefault();var i=t("."+o+":visible").attr("id"),n=t(e.currentTarget).attr("data-"+o+"-open"),s=t(e.currentTarget).attr("data-"+o+"-transitionIn"),a=t(e.currentTarget).attr("data-"+o+"-transitionOut");void 0!==a?t("#"+i).iziModal("close",{transition:a}):t("#"+i).iziModal("close"),setTimeout(function(){void 0!==s?t("#"+n).iziModal("open",{transition:s}):t("#"+n).iziModal("open")},200)}),n.off("keyup").on("keyup",function(e){var i=t("."+o+":visible").attr("id"),n=t("#"+i).iziModal("getGroup"),s=e||window.event,a=s.target||s.srcElement;void 0===i||void 0===n||s.ctrlKey||s.metaKey||s.altKey||"INPUT"===a.tagName.toUpperCase()||"TEXTAREA"==a.tagName.toUpperCase()||(37===s.keyCode?t("#"+i).iziModal("prev",s):39===s.keyCode&&t("#"+i).iziModal("next",s))}),t.fn[o]=function(e,i){for(var n=this,s=0;s<n.length;s++){var a=t(n[s]),r=a.data(o),h=t.extend({},t.fn[o].defaults,a.data(),"object"==typeof e&&e);if(r||e&&"object"!=typeof e){if("string"==typeof e&&"undefined"!=typeof r)return r[e].apply(r,[].concat(i))}else a.data(o,r=new d(a,h));h.autoOpen&&(isNaN(parseInt(h.autoOpen))?h.autoOpen===!0&&setTimeout(function(){r.open()},0):setTimeout(function(){r.open()},h.autoOpen),l++)}return this},t.fn[o].defaults={title:"",subtitle:"",headerColor:"#88A0B9",theme:"",attached:"",icon:null,iconText:null,iconColor:"",rtl:!1,width:600,padding:0,radius:3,zindex:999,iframe:!1,iframeHeight:400,iframeURL:null,focusInput:!0,group:"",loop:!1,navigateCaption:!0,navigateArrows:!0,history:!0,restoreDefaultContent:!1,autoOpen:0,bodyOverflow:!1,fullscreen:!1,openFullscreen:!1,closeOnEscape:!0,overlay:!0,overlayClose:!0,overlayColor:"rgba(0, 0, 0, 0.4)",timeout:!1,timeoutProgressbar:!1,pauseOnHover:!1,timeoutProgressbarColor:"rgba(255,255,255,0.5)",transitionIn:"comingIn",transitionOut:"comingOut",transitionInOverlay:"fadeIn",transitionOutOverlay:"fadeOut",onFullscreen:function(){},onResize:function(){},onOpening:function(){},onOpened:function(){},onClosing:function(){},onClosed:function(){}},t.fn[o].Constructor=d}).call(this,window.jQuery);
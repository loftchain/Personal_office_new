$(document).ready(function(){$(".jsMobileMenuClose").click(function(){$("html").removeClass("pushed")}),$(".mobile-menu").on("click",function(){e.stopPropagation()}),$(".jsMobileMenuOpen").click(function(o){o.preventDefault(),o.stopPropagation(),$(".mobile-menu").show(),$("html").addClass("pushed")}),$("html").on("click",".visibleContent",function(){$("html").hasClass("pushed")&&$("html").removeClass("pushed")}),$(".jsPopupModalShow").click(function(o){o.preventDefault(),$($(this).attr("href")).show(),$(".overlay").show()}),$(".jsDropDown").click(function(){$(this).parent().find(".leftMenu__subMenu").slideToggle()}),$(document).ready(function(){$(".owl-carousel").owlCarousel({items:1,dots:!0})}),$(".fancybox").fancybox({lang:"ru",i18n:{ru:{CLOSE:"Закрыть",NEXT:"Дальше",PREV:"Назад",ERROR:"Не удается загрузить. <br/> Попробуйте позднее.",PLAY_START:"Начать слайдшоу",PLAY_STOP:"Остановить слайдшоу",FULL_SCREEN:"На весь экран",THUMBS:"Превью"}},buttons:["thumbs","close"]}),$(".jsModalClose, .overlay").click(function(){$(".jsPopupModal").hide(),$(".overlay").hide()})});
//# sourceMappingURL=app-dist.js.map
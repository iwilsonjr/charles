jQuery(document).ready(function(t){var i=t('input[name="anchor"]'),e=t(".nav-tab-wrapper>a"),a=window.location.hash;""!==a&&(a="#"+a.replace("#","")),""!==a&&i.val(a),t(".table").addClass("ui-tabs-hide"),t(i.val()).removeClass("ui-tabs-hide"),"#backwpup-tab-information"===i.val()&&(t("#submit").hide(),t("#default_settings").hide()),e.removeClass("nav-tab-active"),e.each(function(){t(this).attr("href")===i.val()&&t(this).addClass("nav-tab-active")}),e.on("click",function(){var a=t(this).attr("href");return e.removeClass("nav-tab-active"),t(this).addClass("nav-tab-active"),t(".table").addClass("ui-tabs-hide"),t(a).removeClass("ui-tabs-hide"),t("#message").hide(),i.val(a),"#backwpup-tab-information"===a?(t("#submit").hide(),t("#default_settings").hide()):(t("#submit").show(),t("#default_settings").show()),window.location.hash=a,window.scrollTo(0,0),!1}),t("#authentication_method").change(function(){var a=t("#authentication_method").val();""===a?(t(".authentication_basic").hide(),t(".authentication_query_arg").hide(),t(".authentication_user").hide()):"basic"===a?(t(".authentication_basic").show(),t(".authentication_query_arg").hide(),t(".authentication_user").hide()):"query_arg"===a?(t(".authentication_basic").hide(),t(".authentication_query_arg").show(),t(".authentication_user").hide()):"user"===a&&(t(".authentication_basic").hide(),t(".authentication_query_arg").hide(),t(".authentication_user").show())})});
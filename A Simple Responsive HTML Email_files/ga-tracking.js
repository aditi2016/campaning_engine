var _gaq=_gaq||[];_gaq.push(["_setAccount","UA-11792865-44"]);_gaq.push(["_trackPageview"]);(function(){var e=document.createElement("script");e.type="text/javascript";e.async=true;e.src=("https:"==document.location.protocol?"https://ssl":"http://www")+".google-analytics.com/ga.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();$(function(){$("a").on("click",function(e){var t=$(this).attr("href");if(e.currentTarget.host!=window.location.host){_gat._getTrackerByName()._trackEvent("Outbound Links",e.currentTarget.host.replace(":80",""),t,0);if(e.metaKey||e.ctrlKey||this.target=="_blank"||e.which==2){var n=true}if(!n){e.preventDefault();setTimeout('document.location = "'+t+'"',100)}}})})
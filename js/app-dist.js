!function(){"use strict";$(".scrollHolder").niceScroll({cursorwidth:4,cursoropacitymin:.4,cursorcolor:"#FEC808",cursorborder:"none",cursorborderradius:4,autohidemode:"leave"});$("#files").on("dragenter",function(e){$(".drop").css({border:"4px dashed #09f",background:"rgba(0, 153, 255, .05)"}),$(".cont").css({color:"#09f"})}).on("dragleave dragend mouseout drop",function(e){$(".drop").css({border:"3px dashed #DADFE3",background:"transparent"}),$(".cont").css({color:"#8E99A5"})}),$("#files").change(function(e){for(var t,a=e.target.files,o=0;t=a[o];o++)if(t.type.match("image.*")){var n=new FileReader;n.onload=function(e){return function(t){var a=document.createElement("span");a.innerHTML=['<img class="thumb" src="',t.target.result,'" title="',escape(e.name),'"/>'].join(""),document.getElementById("list").insertBefore(a,null)}}(t),n.readAsDataURL(t)}});var e=$("#tokenChart"),t=new Chart(e,{type:"doughnut",data:{datasets:[{data:[68,15,10,7],backgroundColor:["#FFEE6F","#F71546","#6C6C6C","#CFCFCF"],label:"Dataset 1"}],labels:["68% Token Sale","15% Team","10% Advisors and Partners","7% Bounties and Airdrops"]},options:{responsive:!0,cutoutPercentage:92,layout:{padding:{left:0,right:0,top:0,bottom:0}},title:{display:!1,text:"Chart.js Doughnut Chart"},animation:{animateScale:!0,animateRotate:!0},legend:{display:!1},legendCallback:function(e){var t=[];t.push("<ul>");for(var a=e.data.datasets[0],o=0;o<a.data.length;o++)t.push("<li>"),t.push('<span class="chart-legend" style="background-color:'+a.backgroundColor[o]+'"></span>'),t.push('<span class="chart-legend-label-text">'+e.data.labels[o]+"</span>"),t.push("</li>");return t.push("</ul>"),t.join("")}}});$("#js-legend").html(t.generateLegend()),$(".percentBar").each(function(e,t){var a=$(t).data("percent");$(t).find(".percentBar__fill").css("width",a+"%"),$(t).find(".percentBar__marker").css("left",a+"%"),$(t).find(".percentBar__number").text(a+"%"),a<50&&$(t).find(".percentBar__number").css("color","#BDBDBD")}),$(".owl-carousel").owlCarousel({loop:!1,dots:!1,nav:!0,autoWidth:!0,items:3,navText:["",""],responsive:{0:{items:1},600:{items:2},1e3:{items:3}}});for(var a=document.querySelectorAll(".cmn-toggle-switch"),o=a.length-1;o>=0;o--){!function(e){e.addEventListener("click",function(e){e.preventDefault(),$(".jsSidebar").toggleClass("sidebar--mobileVisible"),$(".jsWorkArea").toggleClass("workArea--shifted"),!0===this.classList.contains("active")?this.classList.remove("active"):this.classList.add("active")})}(a[o])}}(),Vue.config.devtools=!0;var buyTokensApp=new Vue({el:"#buyTokens",data:{name:"buyTokens",invsetmentWalletETH:"cjsdxhnaa634a345623564v2x5237zb646",minumumDeposit:"0,1",gas:"199 000"},methods:{copyToBuffer:function(e){console.log("ok");var t=document.getElementById("ethWallet");t.select(),document.execCommand("copy"),alert("Copied: "+t.value)},onCopy:function(e){alert("You just copied: "+e.text)},onError:function(e){alert("Failed to copy texts")}}});
//# sourceMappingURL=app-dist.js.map
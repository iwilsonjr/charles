(function(a,b){if(typeof exports==="object"){module.exports=b(window,document)}else{a.SimpleScrollbar=b(window,document)}})(this,function(h,f){var e=h.requestAnimationFrame||h.setImmediate||function(d){return setTimeout(d,0)};function g(d){Object.defineProperty(d,"data-simple-scrollbar",{value:new j(d),configurable:true})}function i(d){if(!Object.prototype.hasOwnProperty.call(d,"data-simple-scrollbar")){return}d["data-simple-scrollbar"].unBind();delete d["data-simple-scrollbar"]}function b(o,m){var d;o.addEventListener("mousedown",function(p){d=p.pageY;o.classList.add("ss-grabbed");f.body.classList.add("ss-grabbed");f.addEventListener("mousemove",n);f.addEventListener("mouseup",l);return false});function n(p){var q=p.pageY-d;d=p.pageY;e(function(){m.el.scrollTop+=q/m.scrollRatio})}function l(){o.classList.remove("ss-grabbed");f.body.classList.remove("ss-grabbed");f.removeEventListener("mousemove",n);f.removeEventListener("mouseup",l)}}function k(l){this.target=l;this.content=l.firstElementChild;this.direction=h.getComputedStyle(this.target).direction;this.bar='<div class="ss-scroll">';this.mB=this.moveBar.bind(this);this.wrapper=f.createElement("div");this.wrapper.setAttribute("class","rsssl-ss-wrapper");this.el=f.createElement("div");this.el.setAttribute("class","rsssl-ss-content");if(this.direction==="rtl"){this.el.classList.add("rtl")}this.wrapper.appendChild(this.el);while(this.target.firstChild){this.el.appendChild(this.target.firstChild)}this.target.appendChild(this.wrapper);this.target.insertAdjacentHTML("beforeend",this.bar);this.bar=this.target.lastChild;b(this.bar,this);this.moveBar();h.addEventListener("resize",this.mB);this.el.addEventListener("scroll",this.mB);this.el.addEventListener("mouseenter",this.mB);this.target.classList.add("ss-container");var d=h.getComputedStyle(l);if(d.height==="0px"&&d["max-height"]!=="0px"){l.style.height=d["max-height"]}this.unBind=function(){h.removeEventListener("resize",this.mB);this.el.removeEventListener("scroll",this.mB);this.el.removeEventListener("mouseenter",this.mB);this.target.classList.remove("ss-container");this.target.insertBefore(this.content,this.wrapper);this.target.removeChild(this.wrapper);this.target.removeChild(this.bar);this.bar=null}}k.prototype={moveBar:function(o){var n=this.el.scrollHeight,d=this.el.clientHeight,p=this;this.scrollRatio=d/n;var l=p.direction==="rtl";var m=l?(p.target.clientWidth-p.bar.clientWidth+18):(p.target.clientWidth-p.bar.clientWidth)*-1;e(function(){if(p.scrollRatio>=1){p.bar.classList.add("ss-hidden")}else{p.bar.classList.remove("ss-hidden");p.bar.style.cssText="height:"+Math.max(p.scrollRatio*100,10)+"%; top:"+(p.el.scrollTop/n)*100+"%;right:"+m+"px;"}})}};function a(){var d=f.querySelectorAll("*[ss-container]");for(var l=0;l<d.length;l++){g(d[l])}}function c(){var d=f.querySelectorAll(".ss-container");for(var l=0;l<d.length;l++){i(d[l])}}f.addEventListener("DOMContentLoaded",a);k.initEl=g;k.initAll=a;k.unbindEl=i;k.unbindAll=c;var j=k;return j});
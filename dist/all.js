!function s(o,a,l){function c(t,e){if(!a[t]){if(!o[t]){var i="function"==typeof require&&require;if(!e&&i)return i(t,!0);if(h)return h(t,!0);var n=new Error("Cannot find module '"+t+"'");throw n.code="MODULE_NOT_FOUND",n}var r=a[t]={exports:{}};o[t][0].call(r.exports,function(e){return c(o[t][1][e]||e)},r,r.exports,s,o,a,l)}return a[t].exports}for(var h="function"==typeof require&&require,e=0;e<l.length;e++)c(l[e]);return c}({1:[function(e,t,i){"use strict";var s="bfred-it:object-fit-images",o=/(object-fit|object-position)\s*:\s*([-.\w\s%]+)/g,n="undefined"==typeof Image?{style:{"object-position":1}}:new Image,a="object-fit"in n.style,r="object-position"in n.style,l="background-size"in n.style,c="string"==typeof n.currentSrc,h=n.getAttribute,d=n.setAttribute,u=!1;function f(e,t,i){var n="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='"+(t||1)+"' height='"+(i||0)+"'%3E%3C/svg%3E";h.call(e,"src")!==n&&d.call(e,"src",n)}function g(e,t){e.naturalWidth?t(e):setTimeout(g,100,e,t)}function p(t){var i,n,e=function(e){for(var t,i=getComputedStyle(e).fontFamily,n={};null!==(t=o.exec(i));)n[t[1]]=t[2];return n}(t),r=t[s];if(e["object-fit"]=e["object-fit"]||"fill",!r.img){if("fill"===e["object-fit"])return;if(!r.skipTest&&a&&!e["object-position"])return}if(!r.img){r.img=new Image(t.width,t.height),r.img.srcset=h.call(t,"data-ofi-srcset")||t.srcset,r.img.src=h.call(t,"data-ofi-src")||t.src,d.call(t,"data-ofi-src",t.src),t.srcset&&d.call(t,"data-ofi-srcset",t.srcset),f(t,t.naturalWidth||t.width,t.naturalHeight||t.height),t.srcset&&(t.srcset="");try{i=t,n={get:function(e){return i[s].img[e||"src"]},set:function(e,t){return i[s].img[t||"src"]=e,d.call(i,"data-ofi-"+t,e),p(i),e}},Object.defineProperty(i,"src",n),Object.defineProperty(i,"currentSrc",{get:function(){return n.get("currentSrc")}}),Object.defineProperty(i,"srcset",{get:function(){return n.get("srcset")},set:function(e){return n.set(e,"srcset")}})}catch(e){window.console&&console.warn("https://bit.ly/ofi-old-browser")}}!function(e){if(e.srcset&&!c&&window.picturefill){var t=window.picturefill._;e[t.ns]&&e[t.ns].evaled||t.fillImg(e,{reselect:!0}),e[t.ns].curSrc||(e[t.ns].supported=!1,t.fillImg(e,{reselect:!0})),e.currentSrc=e[t.ns].curSrc||e.src}}(r.img),t.style.backgroundImage='url("'+(r.img.currentSrc||r.img.src).replace(/"/g,'\\"')+'")',t.style.backgroundPosition=e["object-position"]||"center",t.style.backgroundRepeat="no-repeat",t.style.backgroundOrigin="content-box",/scale-down/.test(e["object-fit"])?g(r.img,function(){r.img.naturalWidth>t.width||r.img.naturalHeight>t.height?t.style.backgroundSize="contain":t.style.backgroundSize="auto"}):t.style.backgroundSize=e["object-fit"].replace("none","auto").replace("fill","100% 100%"),g(r.img,function(e){f(t,e.naturalWidth,e.naturalHeight)})}function m(e,t){var i=!u&&!e;if(t=t||{},e=e||"img",r&&!t.skipTest||!l)return!1;"img"===e?e=document.getElementsByTagName("img"):"string"==typeof e?e=document.querySelectorAll(e):"length"in e||(e=[e]);for(var n=0;n<e.length;n++)e[n][s]=e[n][s]||{skipTest:t.skipTest},p(e[n]);i&&(document.body.addEventListener("load",function(e){"IMG"===e.target.tagName&&m(e.target,{skipTest:t.skipTest})},!0),u=!0,e="img"),t.watchMQ&&window.addEventListener("resize",m.bind(null,e,{skipTest:t.skipTest}))}m.supportsObjectFit=a,m.supportsObjectPosition=r,function(){function i(e,t){return e[s]&&e[s].img&&("src"===t||"srcset"===t)?e[s].img:e}r||(HTMLImageElement.prototype.getAttribute=function(e){return h.call(i(this,e),e)},HTMLImageElement.prototype.setAttribute=function(e,t){return d.call(i(this,e),e,String(t))})}(),t.exports=m},{}],2:[function(e,t,i){var n,r;n="undefined"!=typeof self?self:this,r=function(){return function(i){function n(e){if(r[e])return r[e].exports;var t=r[e]={i:e,l:!1,exports:{}};return i[e].call(t.exports,t,t.exports,n),t.l=!0,t.exports}var r={};return n.m=i,n.c=r,n.d=function(e,t,i){n.o(e,t)||Object.defineProperty(e,t,{configurable:!1,enumerable:!0,get:i})},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},r=function(){function n(e,t){for(var i=0;i<t.length;i++){var n=t[i];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(e,t,i){return t&&n(e.prototype,t),i&&n(e,i),e}}(),s=function(){function i(e){var t=this;if(function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,i),this.config=i.mergeSettings(e),this.selector="string"==typeof this.config.selector?document.querySelector(this.config.selector):this.config.selector,null===this.selector)throw new Error("Something wrong with your selector 😭");this.resolveSlidesNumber(),this.selectorWidth=this.selector.offsetWidth,this.innerElements=[].slice.call(this.selector.children),this.currentSlide=this.config.loop?this.config.startIndex%this.innerElements.length:Math.max(0,Math.min(this.config.startIndex,this.innerElements.length-this.perPage)),this.transformProperty=i.webkitOrNot(),["resizeHandler","touchstartHandler","touchendHandler","touchmoveHandler","mousedownHandler","mouseupHandler","mouseleaveHandler","mousemoveHandler","clickHandler"].forEach(function(e){t[e]=t[e].bind(t)}),this.init()}return r(i,[{key:"attachEvents",value:function(){window.addEventListener("resize",this.resizeHandler),this.config.draggable&&(this.pointerDown=!1,this.drag={startX:0,endX:0,startY:0,letItGo:null,preventClick:!1},this.selector.addEventListener("touchstart",this.touchstartHandler),this.selector.addEventListener("touchend",this.touchendHandler),this.selector.addEventListener("touchmove",this.touchmoveHandler),this.selector.addEventListener("mousedown",this.mousedownHandler),this.selector.addEventListener("mouseup",this.mouseupHandler),this.selector.addEventListener("mouseleave",this.mouseleaveHandler),this.selector.addEventListener("mousemove",this.mousemoveHandler),this.selector.addEventListener("click",this.clickHandler))}},{key:"detachEvents",value:function(){window.removeEventListener("resize",this.resizeHandler),this.selector.removeEventListener("touchstart",this.touchstartHandler),this.selector.removeEventListener("touchend",this.touchendHandler),this.selector.removeEventListener("touchmove",this.touchmoveHandler),this.selector.removeEventListener("mousedown",this.mousedownHandler),this.selector.removeEventListener("mouseup",this.mouseupHandler),this.selector.removeEventListener("mouseleave",this.mouseleaveHandler),this.selector.removeEventListener("mousemove",this.mousemoveHandler),this.selector.removeEventListener("click",this.clickHandler)}},{key:"init",value:function(){this.attachEvents(),this.selector.style.overflow="hidden",this.selector.style.direction=this.config.rtl?"rtl":"ltr",this.buildSliderFrame(),this.config.onInit.call(this)}},{key:"buildSliderFrame",value:function(){var e=this.selectorWidth/this.perPage,t=this.config.loop?this.innerElements.length+2*this.perPage:this.innerElements.length;this.sliderFrame=document.createElement("div"),this.sliderFrame.style.width=e*t+"px",this.enableTransition(),this.config.draggable&&(this.selector.style.cursor="-webkit-grab");var i=document.createDocumentFragment();if(this.config.loop)for(var n=this.innerElements.length-this.perPage;n<this.innerElements.length;n++){var r=this.buildSliderFrameItem(this.innerElements[n].cloneNode(!0));i.appendChild(r)}for(var s=0;s<this.innerElements.length;s++){var o=this.buildSliderFrameItem(this.innerElements[s]);i.appendChild(o)}if(this.config.loop)for(var a=0;a<this.perPage;a++){var l=this.buildSliderFrameItem(this.innerElements[a].cloneNode(!0));i.appendChild(l)}this.sliderFrame.appendChild(i),this.selector.innerHTML="",this.selector.appendChild(this.sliderFrame),this.slideToCurrent()}},{key:"buildSliderFrameItem",value:function(e){var t=document.createElement("div");return t.style.cssFloat=this.config.rtl?"right":"left",t.style.float=this.config.rtl?"right":"left",t.style.width=(this.config.loop?100/(this.innerElements.length+2*this.perPage):100/this.innerElements.length)+"%",t.appendChild(e),t}},{key:"resolveSlidesNumber",value:function(){if("number"==typeof this.config.perPage)this.perPage=this.config.perPage;else if("object"===n(this.config.perPage))for(var e in this.perPage=1,this.config.perPage)window.innerWidth>=e&&(this.perPage=this.config.perPage[e])}},{key:"prev",value:function(){var e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:1,t=arguments[1];if(!(this.innerElements.length<=this.perPage)){var i=this.currentSlide;if(this.config.loop)if(this.currentSlide-e<0){this.disableTransition();var n=this.currentSlide+this.innerElements.length,r=n+this.perPage,s=(this.config.rtl?1:-1)*r*(this.selectorWidth/this.perPage),o=this.config.draggable?this.drag.endX-this.drag.startX:0;this.sliderFrame.style[this.transformProperty]="translate3d("+(s+o)+"px, 0, 0)",this.currentSlide=n-e}else this.currentSlide=this.currentSlide-e;else this.currentSlide=Math.max(this.currentSlide-e,0);i!==this.currentSlide&&(this.slideToCurrent(this.config.loop),this.config.onChange.call(this),t&&t.call(this))}}},{key:"next",value:function(){var e=0<arguments.length&&void 0!==arguments[0]?arguments[0]:1,t=arguments[1];if(!(this.innerElements.length<=this.perPage)){var i=this.currentSlide;if(this.config.loop)if(this.currentSlide+e>this.innerElements.length-this.perPage){this.disableTransition();var n=this.currentSlide-this.innerElements.length,r=n+this.perPage,s=(this.config.rtl?1:-1)*r*(this.selectorWidth/this.perPage),o=this.config.draggable?this.drag.endX-this.drag.startX:0;this.sliderFrame.style[this.transformProperty]="translate3d("+(s+o)+"px, 0, 0)",this.currentSlide=n+e}else this.currentSlide=this.currentSlide+e;else this.currentSlide=Math.min(this.currentSlide+e,this.innerElements.length-this.perPage);i!==this.currentSlide&&(this.slideToCurrent(this.config.loop),this.config.onChange.call(this),t&&t.call(this))}}},{key:"disableTransition",value:function(){this.sliderFrame.style.webkitTransition="all 0ms "+this.config.easing,this.sliderFrame.style.transition="all 0ms "+this.config.easing}},{key:"enableTransition",value:function(){this.sliderFrame.style.webkitTransition="all "+this.config.duration+"ms "+this.config.easing,this.sliderFrame.style.transition="all "+this.config.duration+"ms "+this.config.easing}},{key:"goTo",value:function(e,t){if(!(this.innerElements.length<=this.perPage)){var i=this.currentSlide;this.currentSlide=this.config.loop?e%this.innerElements.length:Math.min(Math.max(e,0),this.innerElements.length-this.perPage),i!==this.currentSlide&&(this.slideToCurrent(),this.config.onChange.call(this),t&&t.call(this))}}},{key:"slideToCurrent",value:function(e){var t=this,i=this.config.loop?this.currentSlide+this.perPage:this.currentSlide,n=(this.config.rtl?1:-1)*i*(this.selectorWidth/this.perPage);e?requestAnimationFrame(function(){requestAnimationFrame(function(){t.enableTransition(),t.sliderFrame.style[t.transformProperty]="translate3d("+n+"px, 0, 0)"})}):this.sliderFrame.style[this.transformProperty]="translate3d("+n+"px, 0, 0)"}},{key:"updateAfterDrag",value:function(){var e=(this.config.rtl?-1:1)*(this.drag.endX-this.drag.startX),t=Math.abs(e),i=this.config.multipleDrag?Math.ceil(t/(this.selectorWidth/this.perPage)):1,n=0<e&&this.currentSlide-i<0,r=e<0&&this.currentSlide+i>this.innerElements.length-this.perPage;0<e&&t>this.config.threshold&&this.innerElements.length>this.perPage?this.prev(i):e<0&&t>this.config.threshold&&this.innerElements.length>this.perPage&&this.next(i),this.slideToCurrent(n||r)}},{key:"resizeHandler",value:function(){this.resolveSlidesNumber(),this.currentSlide+this.perPage>this.innerElements.length&&(this.currentSlide=this.innerElements.length<=this.perPage?0:this.innerElements.length-this.perPage),this.selectorWidth=this.selector.offsetWidth,this.buildSliderFrame()}},{key:"clearDrag",value:function(){this.drag={startX:0,endX:0,startY:0,letItGo:null,preventClick:this.drag.preventClick}}},{key:"touchstartHandler",value:function(e){-1!==["TEXTAREA","OPTION","INPUT","SELECT"].indexOf(e.target.nodeName)||(e.stopPropagation(),this.pointerDown=!0,this.drag.startX=e.touches[0].pageX,this.drag.startY=e.touches[0].pageY)}},{key:"touchendHandler",value:function(e){e.stopPropagation(),this.pointerDown=!1,this.enableTransition(),this.drag.endX&&this.updateAfterDrag(),this.clearDrag()}},{key:"touchmoveHandler",value:function(e){if(e.stopPropagation(),null===this.drag.letItGo&&(this.drag.letItGo=Math.abs(this.drag.startY-e.touches[0].pageY)<Math.abs(this.drag.startX-e.touches[0].pageX)),this.pointerDown&&this.drag.letItGo){e.preventDefault(),this.drag.endX=e.touches[0].pageX,this.sliderFrame.style.webkitTransition="all 0ms "+this.config.easing,this.sliderFrame.style.transition="all 0ms "+this.config.easing;var t=(this.config.loop?this.currentSlide+this.perPage:this.currentSlide)*(this.selectorWidth/this.perPage),i=this.drag.endX-this.drag.startX,n=this.config.rtl?t+i:t-i;this.sliderFrame.style[this.transformProperty]="translate3d("+(this.config.rtl?1:-1)*n+"px, 0, 0)"}}},{key:"mousedownHandler",value:function(e){-1!==["TEXTAREA","OPTION","INPUT","SELECT"].indexOf(e.target.nodeName)||(e.preventDefault(),e.stopPropagation(),this.pointerDown=!0,this.drag.startX=e.pageX)}},{key:"mouseupHandler",value:function(e){e.stopPropagation(),this.pointerDown=!1,this.selector.style.cursor="-webkit-grab",this.enableTransition(),this.drag.endX&&this.updateAfterDrag(),this.clearDrag()}},{key:"mousemoveHandler",value:function(e){if(e.preventDefault(),this.pointerDown){"A"===e.target.nodeName&&(this.drag.preventClick=!0),this.drag.endX=e.pageX,this.selector.style.cursor="-webkit-grabbing",this.sliderFrame.style.webkitTransition="all 0ms "+this.config.easing,this.sliderFrame.style.transition="all 0ms "+this.config.easing;var t=(this.config.loop?this.currentSlide+this.perPage:this.currentSlide)*(this.selectorWidth/this.perPage),i=this.drag.endX-this.drag.startX,n=this.config.rtl?t+i:t-i;this.sliderFrame.style[this.transformProperty]="translate3d("+(this.config.rtl?1:-1)*n+"px, 0, 0)"}}},{key:"mouseleaveHandler",value:function(e){this.pointerDown&&(this.pointerDown=!1,this.selector.style.cursor="-webkit-grab",this.drag.endX=e.pageX,this.drag.preventClick=!1,this.enableTransition(),this.updateAfterDrag(),this.clearDrag())}},{key:"clickHandler",value:function(e){this.drag.preventClick&&e.preventDefault(),this.drag.preventClick=!1}},{key:"remove",value:function(e,t){if(e<0||e>=this.innerElements.length)throw new Error("Item to remove doesn't exist 😭");var i=e<this.currentSlide,n=this.currentSlide+this.perPage-1===e;(i||n)&&this.currentSlide--,this.innerElements.splice(e,1),this.buildSliderFrame(),t&&t.call(this)}},{key:"insert",value:function(e,t,i){if(t<0||t>this.innerElements.length+1)throw new Error("Unable to inset it at this index 😭");if(-1!==this.innerElements.indexOf(e))throw new Error("The same item in a carousel? Really? Nope 😭");var n=0<(t<=this.currentSlide)&&this.innerElements.length;this.currentSlide=n?this.currentSlide+1:this.currentSlide,this.innerElements.splice(t,0,e),this.buildSliderFrame(),i&&i.call(this)}},{key:"prepend",value:function(e,t){this.insert(e,0),t&&t.call(this)}},{key:"append",value:function(e,t){this.insert(e,this.innerElements.length+1),t&&t.call(this)}},{key:"destroy",value:function(){var e=0<arguments.length&&void 0!==arguments[0]&&arguments[0],t=arguments[1];if(this.detachEvents(),this.selector.style.cursor="auto",e){for(var i=document.createDocumentFragment(),n=0;n<this.innerElements.length;n++)i.appendChild(this.innerElements[n]);this.selector.innerHTML="",this.selector.appendChild(i),this.selector.removeAttribute("style")}t&&t.call(this)}}],[{key:"mergeSettings",value:function(e){var t={selector:".siema",duration:200,easing:"ease-out",perPage:1,startIndex:0,draggable:!0,multipleDrag:!0,threshold:20,loop:!1,rtl:!1,onInit:function(){},onChange:function(){}},i=e;for(var n in i)t[n]=i[n];return t}},{key:"webkitOrNot",value:function(){return"string"==typeof document.documentElement.style.transform?"transform":"WebkitTransform"}}]),i}();t.default=s,e.exports=t.default}])},"object"==typeof i&&"object"==typeof t?t.exports=r():"function"==typeof define&&define.amd?define("Siema",[],r):"object"==typeof i?i.Siema=r():n.Siema=r()},{}],3:[function(e,i,t){(function(t){!function(e){"use strict";"object"==typeof i&&"object"==typeof i.exports?i.exports=e("undefined"!=typeof window?window.jQuery:void 0!==t?t.jQuery:null):e(jQuery)}(function(o){"use strict";o.fn.smoothScroll=function(e){var s=o.extend({duration:600,offset:0},e);return this.each(function(){var e=o(this),t=e.attr("href"),n=t.substr(t.indexOf("#")).substr(1),r=document.getElementById(n);r?e.click(function(e){e.stopPropagation(),e.preventDefault();var t=r.getBoundingClientRect(),i=o(document).scrollTop();window.location.hash="#"+n,o(document).scrollTop(i),o("html, body").animate({scrollTop:t.top+i+s.offset},s.duration)}):"top"==n&&e.click(function(e){e.stopPropagation(),e.preventDefault(),o("html, body").animate({scrollTop:0},s.duration)})})}})}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],4:[function(e,i,t){(function(t){!function(e){"use strict";"object"==typeof i&&"object"==typeof i.exports?i.exports=e("undefined"!=typeof window?window.jQuery:void 0!==t?t.jQuery:null):e(jQuery)}(function(r){"use strict";r.fn.toggleHash=function(e){var n={onAdd:(e=e||{}).onAdd||function(){},onRemove:e.onRemove||function(){}};return this.each(function(){var e=r(this);e.attr("href");e.click(function(e){e.preventDefault();var t=r(this).attr("href");if(t==window.location.hash){var i=r(document).scrollTop();window.location.hash="#",r(document).scrollTop(i),"replaceState"in window.history&&window.history.replaceState("",document.title,window.location.pathname+window.location.search),n.onRemove(t)}else{i=r(document).scrollTop();window.location.hash=t,r(document).scrollTop(i),n.onAdd(t)}})})}})}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],5:[function(e,t,i){e("./all.js"),e("./cookie-consent.js"),e("./google-map.js"),e("./object-fit-polyfill.js"),e("./popup.js"),e("./slideshow.js"),e("./smooth-scroll.js"),e("./toggle-hash.js")},{"./all.js":5,"./cookie-consent.js":6,"./google-map.js":7,"./object-fit-polyfill.js":8,"./popup.js":9,"./slideshow.js":10,"./smooth-scroll.js":11,"./toggle-hash.js":12}],6:[function(e,t,i){!function(){"use strict";if("undefined"!=typeof SLEEK_CHILD_CONFIG){var e=window.localStorage.getItem("cookie_consent"),t=SLEEK_CHILD_CONFIG.COOKIE_CONSENT;if(!e){var i=document.createElement("div");i.id="cookie-consent",i.innerHTML=t,document.body.appendChild(i),i.querySelector("a.close").addEventListener("click",function(e){e.preventDefault(),window.localStorage.setItem("cookie_consent",!0),i.parentNode.removeChild(i)})}}}()},{}],7:[function(e,t,i){(function(e){!function(){"use strict";var s="undefined"!=typeof window?window.jQuery:void 0!==e?e.jQuery:null;if("undefined"!=typeof gmInit){if("undefined"!=typeof SLEEK_CONFIG&&void 0!==SLEEK_CONFIG.GOOGLE_MAPS_API_KEY){var o=function(e,t,i,n){if(t=parseFloat(t),i=parseFloat(i),t&&i){var r=new google.maps.Map(e,{center:{lat:t,lng:i},zoom:13,scrollwheel:!1,mapTypeControl:!1,streetViewControl:!1,styles:[{featureType:"landscape",stylers:[{hue:"#FFBB00"},{saturation:43.400000000000006},{lightness:37.599999999999994},{gamma:1}]},{featureType:"road.highway",stylers:[{hue:"#FFC200"},{saturation:-61.8},{lightness:45.599999999999994},{gamma:1}]},{featureType:"road.arterial",stylers:[{hue:"#FF0300"},{saturation:-100},{lightness:51.19999999999999},{gamma:1}]},{featureType:"road.local",stylers:[{hue:"#FF0300"},{saturation:-100},{lightness:52},{gamma:1}]},{featureType:"water",stylers:[{hue:"#0078FF"},{saturation:-13.200000000000003},{lightness:2.4000000000000057},{gamma:1}]},{featureType:"poi",stylers:[{hue:"#00FF6A"},{saturation:-1.0989010989011234},{lightness:11.200000000000017},{gamma:1}]}]}),s=new google.maps.Marker({position:new google.maps.LatLng(t,i),map:r}),o=!1;return n&&(o=new google.maps.InfoWindow({content:'<div class="google-map-info-window">'+n+"</div>"}),s.addListener("click",function(){o.open(r,s)})),{map:r,marker:s,infoWin:o}}return!1};gmInit(function(){s(".google-map").each(function(){var i=s(this),e=i.attr("data-lat"),t=i.attr("data-lng"),n=i.attr("data-address"),r=i.find(".google-map-info-window");(r=!!r.length&&r.html(),n&&(n=JSON.parse(n))&&(n=n.address+", "+n.city+", "+n.postalcode),n)?(new google.maps.Geocoder).geocode({address:n},function(e,t){"OK"===t&&o(i[0],e[0].geometry.location.lat(),e[0].geometry.location.lng(),r)}):o(i[0],e,t,r)})})}}else console.log("gmInit is not defined - have you entered a valid Google Maps API key inside the admin?")}()}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],8:[function(e,t,i){!function(){"use strict";e("object-fit-images")()}()},{"object-fit-images":1}],9:[function(e,t,i){(function(e){!function(){"use strict";var n="undefined"!=typeof window?window.jQuery:void 0!==e?e.jQuery:null;n(".popup, .popup__close").click(function(e){var t;e.target==this&&(e.preventDefault(),t=n(document).scrollTop(),window.location.hash="#",n(document).scrollTop(t),"replaceState"in window.history&&window.history.pushState("",document.title,window.location.pathname+window.location.search))}),n("[data-popup-template]").click(function(){var e=n(this),t=e.attr("href").substr(1),i=e.attr("data-popup-template");n("#"+t).find("div.popup-template-content").html(n("#"+i).html())})}()}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{}],10:[function(t,e,i){(function(e){!function(){"use strict";var h="undefined"!=typeof window?window.jQuery:void 0!==e?e.jQuery:null,d=t("siema");h("div.gallery").each(function(){var e=1,t=h(this).addClass("is-slideshow"),i=t.attr("class").split(" ").filter(function(e){return-1!=e.indexOf("gallery-columns-")});i&&i.length&&(e=i[0].replace("gallery-columns-","")),t.wrapInner('<div data-slideshow="'+e+'"></div>')}),h("[data-slideshow]").each(function(){var e=h(this),t=e.find("> *").length,i=e.attr("data-slideshow"),n=h('<a href="#" class="slideshow-prev">Prev</a>').appendTo(e.parent()),r=h('<a href="#" class="slideshow-next">Next</a>').appendTo(e.parent()),s=h('<nav class="slideshow-pages"></nav>'),o={selector:this,duration:400,easing:"ease-out",perPage:i=i?parseInt(i):1,startIndex:0,draggable:!0,multipleDrag:!0,threshold:20,loop:!0,rtl:!1};n.on("click",function(e){e.preventDefault(),c.prev()}),r.on("click",function(e){e.preventDefault(),c.next()});for(var a="",l=0;l<t;l++)a+='<a href="#" data-slideshow-page="'+l+'">'+(l+1)+"</a>";s.html(a).appendTo(e.parent()),s.on("click","a",function(e){e.preventDefault(),c.goTo(parseInt(this.getAttribute("data-slideshow-page")))}),o.onInit=o.onChange=function(){var e=this.currentSlide;e<0&&(e=t+e),s.find("a").removeClass("active"),s.find('[data-slideshow-page="'+e+'"]').addClass("active")},window.matchMedia("(max-width: 600px)").matches&&(o.perPage=1);var c=new d(o)})}()}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{siema:2}],11:[function(i,e,t){(function(t){!function(){"use strict";var e="undefined"!=typeof window?window.jQuery:void 0!==t?t.jQuery:null;i("smooth-scroll"),e("[data-smooth-scroll]").smoothScroll()}()}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{"smooth-scroll":3}],12:[function(t,e,i){(function(e){!function(){"use strict";var s="undefined"!=typeof window?window.jQuery:void 0!==e?e.jQuery:null;t("toggle-hash"),s("[data-toggle-hash]").each(function(){var t=s(this),i=t.text(),n=t.attr("data-toggle-hash"),r=!!n;n=n||i,t.toggleHash({onAdd:function(e){r&&t.text(n),s(document.documentElement).addClass("hash-active").addClass("hash-active-"+e.substr(1))},onRemove:function(e){r&&t.text(i),s(document.documentElement).removeClass("hash-active").removeClass("hash-active-"+e.substr(1))}})})}()}).call(this,"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{"toggle-hash":4}]},{},[5]);
//# sourceMappingURL=all.js.map

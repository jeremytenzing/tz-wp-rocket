<?php

$html = '<html>
<head><title>Sample Page</title></head>
<body></body>
</html>';

$ie_compat = '<script>if(navigator.userAgent.match(/MSIE|Internet Explorer/i)||navigator.userAgent.match(/Trident\/7\..*?rv:11/i)){var href=document.location.href;if(!href.match(/[?&]nowprocket/)){if(href.indexOf("?")==-1){if(href.indexOf("#")==-1){document.location.href=href+"?nowprocket=1"}else{document.location.href=href.replace("#","?nowprocket=1#")}}else{if(href.indexOf("#")==-1){document.location.href=href+"&nowprocket=1"}else{document.location.href=href.replace("#","&nowprocket=1#")}}}}</script>';

$delay_js = '<script>class RocketLazyLoadScripts{constructor(){this.triggerEvents=["keydown","mousedown","mousemove","touchmove","touchstart","touchend","wheel"],this.userEventHandler=this._triggerListener.bind(this),this.touchStartHandler=this._onTouchStart.bind(this),this.touchMoveHandler=this._onTouchMove.bind(this),this.touchEndHandler=this._onTouchEnd.bind(this),this.clickHandler=this._onClick.bind(this),this.interceptedClicks=[],window.addEventListener("pageshow",a=>{this.persisted=a.persisted}),window.addEventListener("DOMContentLoaded",()=>{this._preconnect3rdParties()}),this.delayedScripts={normal:[],async:[],defer:[]},this.trash=[],this.allJQueries=[]}_addUserInteractionListener(a){if(document.hidden){a._triggerListener();return}this.triggerEvents.forEach(b=>window.addEventListener(b,a.userEventHandler,{passive:!0})),window.addEventListener("touchstart",a.touchStartHandler,{passive:!0}),window.addEventListener("mousedown",a.touchStartHandler),document.addEventListener("visibilitychange",a.userEventHandler)}_removeUserInteractionListener(){this.triggerEvents.forEach(a=>window.removeEventListener(a,this.userEventHandler,{passive:!0})),document.removeEventListener("visibilitychange",this.userEventHandler)}_onTouchStart(a){"HTML"!==a.target.tagName&&(window.addEventListener("touchend",this.touchEndHandler),window.addEventListener("mouseup",this.touchEndHandler),window.addEventListener("touchmove",this.touchMoveHandler,{passive:!0}),window.addEventListener("mousemove",this.touchMoveHandler),a.target.addEventListener("click",this.clickHandler),this._renameDOMAttribute(a.target,"onclick","rocket-onclick"),this._pendingClickStarted())}_onTouchMove(a){window.removeEventListener("touchend",this.touchEndHandler),window.removeEventListener("mouseup",this.touchEndHandler),window.removeEventListener("touchmove",this.touchMoveHandler,{passive:!0}),window.removeEventListener("mousemove",this.touchMoveHandler),a.target.removeEventListener("click",this.clickHandler),this._renameDOMAttribute(a.target,"rocket-onclick","onclick"),this._pendingClickFinished()}_onTouchEnd(a){window.removeEventListener("touchend",this.touchEndHandler),window.removeEventListener("mouseup",this.touchEndHandler),window.removeEventListener("touchmove",this.touchMoveHandler,{passive:!0}),window.removeEventListener("mousemove",this.touchMoveHandler)}_onClick(a){a.target.removeEventListener("click",this.clickHandler),this._renameDOMAttribute(a.target,"rocket-onclick","onclick"),this.interceptedClicks.push(a),a.preventDefault(),a.stopPropagation(),a.stopImmediatePropagation(),this._pendingClickFinished()}_replayClicks(){window.removeEventListener("touchstart",this.touchStartHandler,{passive:!0}),window.removeEventListener("mousedown",this.touchStartHandler),this.interceptedClicks.forEach(a=>{a.target.dispatchEvent(new MouseEvent("click",{view:a.view,bubbles:!0,cancelable:!0}))})}_waitForPendingClicks(){return new Promise(a=>{this._isClickPending?this._pendingClickFinished=a:a()})}_pendingClickStarted(){this._isClickPending=!0}_pendingClickFinished(){this._isClickPending=!1}_renameDOMAttribute(b,a,c){b.hasAttribute&&b.hasAttribute(a)&&(event.target.setAttribute(c,event.target.getAttribute(a)),event.target.removeAttribute(a))}_triggerListener(){this._removeUserInteractionListener(this),"loading"===document.readyState?document.addEventListener("DOMContentLoaded",this._loadEverythingNow.bind(this)):this._loadEverythingNow()}_preconnect3rdParties(){let a=[];document.querySelectorAll("script[type=rocketlazyloadscript]").forEach(b=>{if(b.hasAttribute("src")){let c=new URL(b.src).origin;c!==location.origin&&a.push({src:c,crossOrigin:b.crossOrigin||"module"===b.getAttribute("data-rocket-type")})}}),a=[...new Map(a.map(a=>[JSON.stringify(a),a])).values()],this._batchInjectResourceHints(a,"preconnect")}async _loadEverythingNow(){this.lastBreath=Date.now(),this._delayEventListeners(),this._delayJQueryReady(this),this._handleDocumentWrite(),this._registerAllDelayedScripts(),this._preloadAllScripts(),await this._loadScriptsFromList(this.delayedScripts.normal),await this._loadScriptsFromList(this.delayedScripts.defer),await this._loadScriptsFromList(this.delayedScripts.async);try{await this._triggerDOMContentLoaded(),await this._triggerWindowLoad()}catch(a){console.error(a)}window.dispatchEvent(new Event("rocket-allScriptsLoaded")),this._waitForPendingClicks().then(()=>{this._replayClicks()}),this._emptyTrash()}_registerAllDelayedScripts(){document.querySelectorAll("script[type=rocketlazyloadscript]").forEach(a=>{a.hasAttribute("data-rocket-src")?a.hasAttribute("async")&& !1!==a.async?this.delayedScripts.async.push(a):a.hasAttribute("defer")&& !1!==a.defer||"module"===a.getAttribute("data-rocket-type")?this.delayedScripts.defer.push(a):this.delayedScripts.normal.push(a):this.delayedScripts.normal.push(a)})}async _transformScript(a){return await this._littleBreath(),new Promise(b=>{try{let c=a.getAttribute("data-rocket-type"),d=a.getAttribute("data-rocket-src");c?(a.type=c,a.removeAttribute("data-rocket-type")):a.removeAttribute("type"),a.addEventListener("load",b),a.addEventListener("error",b),d?(a.src=d,a.removeAttribute("data-rocket-src")):a.src="data:text/javascript;base64,"+btoa(a.text)}catch(e){b()}})}async _loadScriptsFromList(a){let b=a.shift();return b?(await this._transformScript(b),this._loadScriptsFromList(a)):Promise.resolve()}_preloadAllScripts(){this._batchInjectResourceHints([...this.delayedScripts.normal,...this.delayedScripts.defer,...this.delayedScripts.async],"preload")}_batchInjectResourceHints(a,c){var b=document.createDocumentFragment();a.forEach(a=>{let e=a.getAttribute&&a.getAttribute("data-rocket-src")||a.src;if(e){let d=document.createElement("link");d.href=e,d.rel=c,"preconnect"!==c&&(d.as="script"),a.getAttribute&&"module"===a.getAttribute("data-rocket-type")&&(d.crossOrigin=!0),a.crossOrigin&&(d.crossOrigin=a.crossOrigin),a.integrity&&(d.integrity=a.integrity),b.appendChild(d),this.trash.push(d)}}),document.head.appendChild(b)}_delayEventListeners(){let c={};function a(a,b){!function(a){c[a]||(c[a]={originalFunctions:{add:a.addEventListener,remove:a.removeEventListener},eventsToRewrite:[]},a.addEventListener=function(){arguments[0]=b(arguments[0]),c[a].originalFunctions.add.apply(a,arguments)},a.removeEventListener=function(){arguments[0]=b(arguments[0]),c[a].originalFunctions.remove.apply(a,arguments)});function b(b){return c[a].eventsToRewrite.indexOf(b)>=0?"rocket-"+b:b}}(a),c[a].eventsToRewrite.push(b)}function b(a,b){let c=a[b];Object.defineProperty(a,b,{get:()=>c||function(){},set(d){a["rocket"+b]=c=d}})}a(document,"DOMContentLoaded"),a(window,"DOMContentLoaded"),a(window,"load"),a(window,"pageshow"),a(document,"readystatechange"),b(document,"onreadystatechange"),b(window,"onload"),b(window,"onpageshow")}_delayJQueryReady(b){let c;function a(a){if(a&&a.fn&&!b.allJQueries.includes(a)){a.fn.ready=a.fn.init.prototype.ready=function(c){b.domReadyFired?c.bind(document)(a):document.addEventListener("rocket-DOMContentLoaded",()=>c.bind(document)(a))};let d=a.fn.on;a.fn.on=a.fn.init.prototype.on=function(){if(this[0]===window){function a(a){return a.split(" ").map(a=>"load"===a||0===a.indexOf("load.")?"rocket-jquery-load":a).join(" ")}"string"==typeof arguments[0]||arguments[0]instanceof String?arguments[0]=a(arguments[0]):"object"==typeof arguments[0]&&Object.keys(arguments[0]).forEach(b=>{delete Object.assign(arguments[0],{[a(b)]:arguments[0][b]})[b]})}return d.apply(this,arguments),this},b.allJQueries.push(a)}c=a}a(window.jQuery),Object.defineProperty(window,"jQuery",{get:()=>c,set(b){a(b)}})}async _triggerDOMContentLoaded(){this.domReadyFired=!0,await this._littleBreath(),document.dispatchEvent(new Event("rocket-DOMContentLoaded")),await this._littleBreath(),window.dispatchEvent(new Event("rocket-DOMContentLoaded")),await this._littleBreath(),document.dispatchEvent(new Event("rocket-readystatechange")),await this._littleBreath(),document.rocketonreadystatechange&&document.rocketonreadystatechange()}async _triggerWindowLoad(){await this._littleBreath(),window.dispatchEvent(new Event("rocket-load")),await this._littleBreath(),window.rocketonload&&window.rocketonload(),await this._littleBreath(),this.allJQueries.forEach(a=>a(window).trigger("rocket-jquery-load")),await this._littleBreath();let a=new Event("rocket-pageshow");a.persisted=this.persisted,window.dispatchEvent(a),await this._littleBreath(),window.rocketonpageshow&&window.rocketonpageshow({persisted:this.persisted})}_handleDocumentWrite(){let a=new Map;document.write=document.writeln=function(e){let b=document.currentScript;b||console.error("WPRocket unable to document.write this: "+e);let f=document.createRange(),g=b.parentElement,c=a.get(b);void 0===c&&(c=b.nextSibling,a.set(b,c));let d=document.createDocumentFragment();f.setStart(d,0),d.appendChild(f.createContextualFragment(e)),g.insertBefore(d,c)}}async _littleBreath(){Date.now()-this.lastBreath>45&&(await this._requestAnimFrame(),this.lastBreath=Date.now())}async _requestAnimFrame(){return document.hidden?new Promise(a=>setTimeout(a)):new Promise(a=>requestAnimationFrame(a))}_emptyTrash(){this.trash.forEach(a=>a.remove())}static run(){let a=new RocketLazyLoadScripts;a._addUserInteractionListener(a)}}RocketLazyLoadScripts.run()</script>';

$expected = '<html>
<head>' . $ie_compat . $delay_js . '<title>Sample Page</title></head>
<body></body>
</html>';

$charset = '<meta charset="UTF-8">';
$charset_http_equiv = "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"/>";

$html_charset = "<html>
<head>
{$charset}
<title>Sample Page</title></head>
<body></body>
</html>";

$expected_charset = "<html>
<head>{$charset}{$ie_compat}{$delay_js}

<title>Sample Page</title></head>
<body></body>
</html>";

$html_http_equiv_charset = "<html>
<head>
{$charset_http_equiv}
<title>Sample Page</title></head>
<body></body>
</html>";

$expected_http_equiv_charset = "<html>
<head>{$charset_http_equiv}{$ie_compat}{$delay_js}

<title>Sample Page</title></head>
<body></body>
</html>";


$html_invalid_charset_head = "<html>
<head>
<meta name=\"keywords\" charset=\"UTF-8\" content=\"Hello!\" />
<title>Sample Page</title></head>
<body></body>
</html>";

$expected_invalid_charset_head = "<html>
<head><meta name=\"keywords\" charset=\"UTF-8\" content=\"Hello!\" />{$ie_compat}{$delay_js}

<title>Sample Page</title></head>
<body></body>
</html>";


$html_invalid_charset_body = "<html>
<head>
<title>Sample Page</title></head>
<body><meta charset=\"UTF-8\"></body>
</html>";

$expected_invalid_charset_body = "<html>
<head>{$ie_compat}{$delay_js}
<title>Sample Page</title></head>
<body><meta charset=\"UTF-8\"></body>
</html>";

return [
	'testShouldNotAddScriptsWhenBypass' => [
		'config'   => [
			'delay_js'      => 1,
			'donotoptimize' => false,
			'bypass'        => true,
		],
		'html'     => $html,
		'expected' => $html,
	],

	'testShouldNotAddScriptsWhenDONOTOPTIMIZE' => [
		'config'   => [
			'delay_js'      => 0,
			'donotoptimize' => true,
			'bypass'        => false,
		],
		'html'     => $html,
		'expected' => $html,
	],

	'testShouldNotAddScriptsWhenDelaySettingDisabled' => [
		'config'   => [
			'delay_js'      => 0,
			'donotoptimize' => false,
			'bypass'        => false,
		],
		'html'     => $html,
		'expected' => $html,
	],

	'testShouldAddScripts' => [
		'config'   => [
			'delay_js' => 1,
			'donotoptimize' => false,
			'bypass'        => false,
		],
		'html'     => $html,
		'expected' => $expected,
	],
	'testShouldAddScriptsAfterMetaCharset' => [
		'config'   => [
			'delay_js' => 1,
			'donotoptimize' => false,
			'bypass'        => false,
		],
		'html'     => $html_charset,
		'expected' => $expected_charset,
	],
	'testShouldAddScriptsAfterMEtaHttpEquivCharset' => [
		'config'   => [
			'delay_js' => 1,
			'donotoptimize' => false,
			'bypass'        => false,
		],
		'html'     => $html_http_equiv_charset,
		'expected' => $expected_http_equiv_charset,
	],
	'testShouldAddScriptsAfterHeadInvalidCharsetHead' => [
		'config'   => [
			'delay_js' => 1,
			'donotoptimize' => false,
			'bypass'        => false,
		],
		'html'     => $html_invalid_charset_head,
		'expected' => $expected_invalid_charset_head,
	],
	'testShouldAddScriptsAfterHeadCharsetBody' => [
		'config'   => [
			'delay_js' => 1,
			'donotoptimize' => false,
			'bypass'        => false,
		],
		'html'     => $html_invalid_charset_body,
		'expected' => $expected_invalid_charset_body,
	],
];

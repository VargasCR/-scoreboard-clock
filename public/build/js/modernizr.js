/*!
 * modernizr v3.6.0
 * Build https://modernizr.com/download?-webp-dontmin
 *
 * Copyright (c)
 *  Faruk Ates
 *  Paul Irish
 *  Alex Sexton
 *  Ryan Seddon
 *  Patrick Kettner
 *  Stu Cox
 *  Richard Herrera

 * MIT License
 */
!function(e,A,n){var o=[],a={_version:"3.6.0",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,A){var n=this;setTimeout((function(){A(n[e])}),0)},addTest:function(e,A,n){o.push({name:e,fn:A,options:n})},addAsyncTest:function(e){o.push({name:null,fn:e})}},t=function(){};t.prototype=a,t=new t;var i,s,r=[];function l(e,A){return typeof e===A}i=l(s={}.hasOwnProperty,"undefined")||l(s.call,"undefined")?function(e,A){return A in e&&l(e.constructor.prototype[A],"undefined")}:function(e,A){return s.call(e,A)};var f=A.documentElement,u="svg"===f.nodeName.toLowerCase();function c(e,A){if("object"==typeof e)for(var n in e)i(e,n)&&c(n,e[n]);else{var o=(e=e.toLowerCase()).split("."),a=t[o[0]];if(2==o.length&&(a=a[o[1]]),void 0!==a)return t;A="function"==typeof A?A():A,1==o.length?t[o[0]]=A:(!t[o[0]]||t[o[0]]instanceof Boolean||(t[o[0]]=new Boolean(t[o[0]])),t[o[0]][o[1]]=A),function(e){var A=f.className,n=t._config.classPrefix||"";if(u&&(A=A.baseVal),t._config.enableJSClass){var o=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");A=A.replace(o,"$1"+n+"js$2")}t._config.enableClasses&&(A+=" "+n+e.join(" "+n),u?f.className.baseVal=A:f.className=A)}([(A&&0!=A?"":"no-")+o.join("-")]),t._trigger(e,A)}return t}a._l={},a.on=function(e,A){this._l[e]||(this._l[e]=[]),this._l[e].push(A),t.hasOwnProperty(e)&&setTimeout((function(){t._trigger(e,t[e])}),0)},a._trigger=function(e,A){if(this._l[e]){var n=this._l[e];setTimeout((function(){var e;for(e=0;e<n.length;e++)(0,n[e])(A)}),0),delete this._l[e]}},t._q.push((function(){a.addTest=c})),
/*!
  {
    "name": "Webp",
    "async": true,
    "property": "webp",
    "tags": ["image"],
    "builderAliases": ["img_webp"],
    "authors": ["Krister Kari", "@amandeep", "Rich Bradshaw", "Ryan Seddon", "Paul Irish"],
    "notes": [{
      "name": "Webp Info",
      "href": "https://developers.google.com/speed/webp/"
    }, {
      "name": "Chormium blog - Chrome 32 Beta: Animated WebP images and faster Chrome for Android touch input",
      "href": "https://blog.chromium.org/2013/11/chrome-32-beta-animated-webp-images-and.html"
    }, {
      "name": "Webp Lossless Spec",
      "href": "https://developers.google.com/speed/webp/docs/webp_lossless_bitstream_specification"
    }, {
      "name": "Article about WebP support on Android browsers",
      "href": "http://www.wope-framework.com/en/2013/06/24/webp-support-on-android-browsers/"
    }, {
      "name": "Chormium WebP announcement",
      "href": "https://blog.chromium.org/2011/11/lossless-and-transparency-encoding-in.html?m=1"
    }]
  }
  !*/
t.addAsyncTest((function(){var e=[{uri:"data:image/webp;base64,UklGRiQAAABXRUJQVlA4IBgAAAAwAQCdASoBAAEAAwA0JaQAA3AA/vuUAAA=",name:"webp"},{uri:"data:image/webp;base64,UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAABBxAR/Q9ERP8DAABWUDggGAAAADABAJ0BKgEAAQADADQlpAADcAD++/1QAA==",name:"webp.alpha"},{uri:"data:image/webp;base64,UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA",name:"webp.animation"},{uri:"data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=",name:"webp.lossless"}],A=e.shift();function n(e,A,n){var o=new Image;function a(A){var a=!(!A||"load"!==A.type)&&1==o.width;c(e,"webp"===e&&a?new Boolean(a):a),n&&n(A)}o.onerror=a,o.onload=a,o.src=A}n(A.name,A.uri,(function(A){if(A&&"load"===A.type)for(var o=0;o<e.length;o++)n(e[o].name,e[o].uri)}))})),function(){var e,A,n,a,i,s;for(var f in o)if(o.hasOwnProperty(f)){if(e=[],(A=o[f]).name&&(e.push(A.name.toLowerCase()),A.options&&A.options.aliases&&A.options.aliases.length))for(n=0;n<A.options.aliases.length;n++)e.push(A.options.aliases[n].toLowerCase());for(a=l(A.fn,"function")?A.fn():A.fn,i=0;i<e.length;i++)1===(s=e[i].split(".")).length?t[s[0]]=a:(!t[s[0]]||t[s[0]]instanceof Boolean||(t[s[0]]=new Boolean(t[s[0]])),t[s[0]][s[1]]=a),r.push((a?"":"no-")+s.join("-"))}}(),delete a.addTest,delete a.addAsyncTest;for(var p=0;p<t._q.length;p++)t._q[p]();e.Modernizr=t}(window,document);
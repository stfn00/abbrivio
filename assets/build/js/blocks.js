!function(e){var t={};function n(o){if(t[o])return t[o].exports;var a=t[o]={i:o,l:!1,exports:{}};return e[o].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(o,a,function(t){return e[t]}.bind(null,a));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=24)}([function(e,t){!function(){e.exports=this.wp.i18n}()},function(e,t){!function(){e.exports=this.wp.blockEditor}()},function(e,t){!function(){e.exports=this.wp.blocks}()},function(e,t){!function(){e.exports=this.React}()},,function(e,t){!function(){e.exports=this.wp.components}()},,function(e,t){!function(){e.exports=this.lodash}()},,,,,,,,,,,function(e,t,n){},,,,,,function(e,t,n){"use strict";n.r(t);n(18);var o=n(3);function a(){return(a=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e}).apply(this,arguments)}var r=function(e){return o.createElement("svg",a({width:20,height:20,viewBox:"0 0 417.813 417"},e),o.createElement("path",{xmlns:"http://www.w3.org/2000/svg",d:"M159.988 318.582c-3.988 4.012-9.43 6.25-15.082 6.25s-11.094-2.238-15.082-6.25L9.375 198.113c-12.5-12.5-12.5-32.77 0-45.246l15.082-15.086c12.504-12.5 32.75-12.5 45.25 0l75.2 75.203L348.104 9.781c12.504-12.5 32.77-12.5 45.25 0l15.082 15.086c12.5 12.5 12.5 32.766 0 45.246zm0 0",fill:"#06ab1c","data-original":"#2196f3"}))};function i(){return(i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var n=arguments[t];for(var o in n)Object.prototype.hasOwnProperty.call(n,o)&&(e[o]=n[o])}return e}).apply(this,arguments)}var c=function(e){return o.createElement("svg",i({width:20,height:20,viewBox:"0 0 123.05 123.05"},e),o.createElement("path",{d:"M121.325 10.925l-8.5-8.399c-2.3-2.3-6.1-2.3-8.5 0l-42.4 42.399L18.726 1.726c-2.301-2.301-6.101-2.301-8.5 0l-8.5 8.5c-2.301 2.3-2.301 6.1 0 8.5l43.1 43.1-42.3 42.5c-2.3 2.3-2.3 6.1 0 8.5l8.5 8.5c2.3 2.3 6.1 2.3 8.5 0l42.399-42.4 42.4 42.4c2.3 2.3 6.1 2.3 8.5 0l8.5-8.5c2.3-2.3 2.3-6.1 0-8.5l-42.5-42.4 42.4-42.399a6.13 6.13 0 00.1-8.602z",fill:"#e30101","data-original":"#000000",xmlns:"http://www.w3.org/2000/svg"}))},l=n(7),s=function(e){var t={dos:r,donts:c};return!Object(l.isEmpty)(e)&&e in t?t[e]:t.dos},u=n(5),b=n(0),d=n(1),f=function(e){var t=e.className,n=e.attributes,o=e.setAttributes,a=n.option,r=n.content,i=s(a);return React.createElement("div",{className:"abbrivio-icon-heading"},React.createElement("span",{className:"abbrivio-icon-heading__heading"},React.createElement(i,null)),React.createElement(d.RichText,{tagName:"h4",className:t,value:r,onChange:function(e){return o({contentVal:e})},placeholder:Object(b.__)("Heading…","abbrivio")}),React.createElement(d.InspectorControls,null,React.createElement(u.PanelBody,{title:Object(b.__)("Block Settings","abbrivio")},React.createElement(u.RadioControl,{label:Object(b.__)("Select the icon","abbrivio"),help:Object(b.__)("Controls icon selection","abbrivio"),selected:a,options:[{label:"Dos",value:"dos"},{label:"Dont's",value:"donts"}],onChange:function(e){o({optionVal:e})}}))))},p=n(2);Object(p.registerBlockType)("abbrivio-blocks/heading",{title:Object(b.__)("Heading with Icon","abbrivio"),icon:"admin-customizer",description:Object(b.__)("Add Heading and select Icons","abbrivio"),category:"abbrivio",attributes:{option:{type:"string",default:"dos"},content:{type:"string",source:"html",selector:"h4",default:Object(b.__)("Dos","abbrivio")}},edit:f,save:function(e){var t=e.attributes,n=t.option,o=t.content,a=s(n);return React.createElement("div",{className:"abbrivio-icon-heading"},React.createElement("span",{className:"abbrivio-icon-heading__heading"},React.createElement(a,null)),React.createElement(d.RichText.Content,{tagName:"h4",value:o}))}});var v=function(e,t,n){return["core/column",{className:t},[["abbrivio-blocks/heading",{className:"abbrivio-dos-and-donts__heading",option:e,content:"<strong><span>".concat(n,"</span></strong>")}],["core/list",{className:"abbrivio-dos-and-donts__list"}]]]},g=[["core/group",{className:"abbrivio-dos-and-donts__group",backgroundColor:"pale-cyan-blue"},[["core/columns",{className:"abbrivio-dos-and-donts__cols"},[v("dos","abbrivio-dos-and-donts__col-one","Dos"),v("donts","abbrivio-dos-and-donts__col-two","Dont's")]]]]],m=["core/group"],h=function(){return React.createElement("div",{className:"abbrivio-dos-and-donts"},React.createElement(d.InnerBlocks,{template:g,allowedBlocks:m,templateLock:!0}))};Object(p.registerBlockType)("abbrivio-blocks/dos-and-donts",{title:Object(b.__)("Dos and dont's","abbrivio"),icon:"editor-table",description:Object(b.__)("Add headings and text","abbrivio"),category:"abbrivio",edit:h,save:function(){return React.createElement("div",{className:"abbrivio-dos-and-donts"},React.createElement(d.InnerBlocks.Content,null))}});var _=[{name:"layout-dark-background",label:Object(b.__)("Layout style dark background","abbrivio")}],y=[{name:"layout-border-blue-fill",label:Object(b.__)("Blue outline","abbrivio")},{name:"layout-border-white-no-fill",label:Object(b.__)("White outline - to be used with dark background","abbrivio")}];wp.domReady((function(){Object(p.unregisterBlockStyle)("core/quote","large"),Object(p.unregisterBlockStyle)("core/button","outline"),_.forEach((function(e){return Object(p.registerBlockStyle)("core/quote",e)})),y.forEach((function(e){return Object(p.registerBlockStyle)("core/button",e)}))}))}]);
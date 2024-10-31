(window.vcvWebpackJsonp4x=window.vcvWebpackJsonp4x||[]).push([[0],{"./node_modules/raw-loader/index.js!./spacer/cssMixins/height.pcss":function(e,t){e.exports=".pavc-spacer-element {\r\n    &.pavc-spacer-rule-all .pavc-spacer-gap {\r\n        @if $heightAll != false {\r\n            min-height: $heightAll;\r\n        }\r\n    }\r\n    .pavc-spacer-custom-dimensions-$selector {\r\n        @media (--xs-only) {\r\n            @if $heightXS != false {\r\n                min-height: $heightXS;\r\n            }\r\n        }\r\n        @media (--sm-only) {\r\n            @if $heightSM != false {\r\n                min-height: $heightSM;\r\n            }\r\n        }\r\n        @media (--md-only) {\r\n            @if $heightMD != false {\r\n                min-height: $heightMD;\r\n            }\r\n        }\r\n        @media (--lg-only) {\r\n            @if $heightLG != false {\r\n                min-height: $heightLG;\r\n            }\r\n        }\r\n        @media (--xl-only) {\r\n            @if $heightXL != false {\r\n                min-height: $heightXL;\r\n            }\r\n        }\r\n    }\r\n}"},"./spacer/index.js":function(e,t,i){"use strict";i.r(t);var s=i("./node_modules/vc-cake/index.js"),n=i("./node_modules/@babel/runtime/helpers/extends.js"),l=i.n(n),a=i("./node_modules/@babel/runtime/helpers/classCallCheck.js"),o=i.n(a),c=i("./node_modules/@babel/runtime/helpers/createClass.js"),r=i.n(c),p=i("./node_modules/@babel/runtime/helpers/inherits.js"),u=i.n(p),h=i("./node_modules/@babel/runtime/helpers/possibleConstructorReturn.js"),d=i.n(h),g=i("./node_modules/@babel/runtime/helpers/getPrototypeOf.js"),m=i.n(g),v=i("./node_modules/react/index.js"),b=i.n(v);function y(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var i,s=m()(e);if(t){var n=m()(this).constructor;i=Reflect.construct(s,arguments,n)}else i=s.apply(this,arguments);return d()(this,i)}}var f=function(e){u()(i,e);var t=y(i);function i(){return o()(this,i),t.apply(this,arguments)}return r()(i,[{key:"render",value:function(){var e=this.props,t=e.id,i=e.atts,s=e.editor,n=i.devicesRule,a=(i.height,i.customClass),o=i.metaCustomId,c="pavc-spacer-element",r="pavc-spacer-gap",p={};"string"==typeof o&&o&&(p.id=o),"string"==typeof a&&a&&(c=c.concat(" "+a)),n&&(c=c.concat(" pavc-spacer-rule-"+n));var u=this.getMixinData("height");u&&(r+=" pavc-spacer-custom-dimensions-".concat(u.selector));var h=this.applyDO("all");return b.a.createElement("div",l()({className:c},s,p),b.a.createElement("div",l()({id:"el-"+t,className:[].join(" ")},h),b.a.createElement("div",{className:r})))}}]),i}(Object(s.getService)("api").elementComponent);(0,Object(s.getService)("cook").add)(i("./spacer/settings.json"),(function(e){e.add(f)}),{css:!1,editorCss:!1,mixins:{height:{mixin:i("./node_modules/raw-loader/index.js!./spacer/cssMixins/height.pcss")}}})},"./spacer/settings.json":function(e){e.exports=JSON.parse('{"devicesRule":{"type":"dropdown","access":"public","value":"all","options":{"label":"Devices","values":[{"label":"All","value":"all"},{"label":"Custom","value":"custom"}]}},"height":{"type":"inputSelect","access":"public","value":{"input":"400","select":"px"},"options":{"label":"Height","type":"size","values":[],"cssMixin":{"mixin":"height","property":"heightAll"},"onChange":{"rules":{"devicesRule":{"rule":"value","options":{"value":"all"}}},"actions":[{"action":"toggleVisibility"}]}}},"heightxl":{"type":"inputSelect","access":"public","value":{"input":"400","select":"px"},"options":{"label":"Height for Desktop","type":"size","values":[],"cssMixin":{"mixin":"height","property":"heightXL"},"onChange":{"rules":{"devicesRule":{"rule":"value","options":{"value":"custom"}}},"actions":[{"action":"toggleVisibility"}]}}},"heightlg":{"type":"inputSelect","access":"public","value":{"input":"350","select":"px"},"options":{"label":"Height for Landscape Tablet","type":"size","values":[],"cssMixin":{"mixin":"height","property":"heightLG"},"onChange":{"rules":{"devicesRule":{"rule":"value","options":{"value":"custom"}}},"actions":[{"action":"toggleVisibility"}]}}},"heightmd":{"type":"inputSelect","access":"public","value":{"input":"300","select":"px"},"options":{"label":"Height for Portrait Tablet","type":"size","values":[],"cssMixin":{"mixin":"height","property":"heightMD"},"onChange":{"rules":{"devicesRule":{"rule":"value","options":{"value":"custom"}}},"actions":[{"action":"toggleVisibility"}]}}},"heightsm":{"type":"inputSelect","access":"public","value":{"input":"250","select":"px"},"options":{"label":"Height for Landscape Mobile","type":"size","values":[],"cssMixin":{"mixin":"height","property":"heightSM"},"onChange":{"rules":{"devicesRule":{"rule":"value","options":{"value":"custom"}}},"actions":[{"action":"toggleVisibility"}]}}},"heightxs":{"type":"inputSelect","access":"public","value":{"input":"200","select":"px"},"options":{"label":"Height for Portrait Mobile","type":"size","values":[],"cssMixin":{"mixin":"height","property":"heightXS"},"onChange":{"rules":{"devicesRule":{"rule":"value","options":{"value":"custom"}}},"actions":[{"action":"toggleVisibility"}]}}},"designOptions":{"type":"designOptions","access":"public","value":{},"options":{"label":"Design Options"}},"editFormTab1":{"type":"group","access":"protected","value":["devicesRule","height","heightxl","heightlg","heightmd","heightsm","heightxs"],"options":{"label":"General"}},"advancedTab":{"type":"group","access":"protected","value":["metaCustomId","customClass"],"options":{"label":"Advanced"}},"metaEditFormTabs":{"type":"group","access":"protected","value":["editFormTab1","advancedTab","designOptions"]},"relatedTo":{"type":"group","access":"protected","value":["General"]},"customClass":{"type":"string","access":"public","value":"","options":{"label":"Extra class name","description":"Add an extra class name to the element and refer to it from Custom CSS option."}},"metaCustomId":{"type":"customId","access":"public","value":"","options":{"label":"Element ID","description":"Apply unique ID to element to link directly to it by using #your_id (for element ID use lowercase input only)."}},"tag":{"access":"protected","type":"string","value":"spacer"}}')}},[["./spacer/index.js"]]]);
(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-744b2e2c"],{"12b23":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",[a("v-toolbar",{attrs:{flat:"",height:"64px"}},[a("v-toolbar-title",[t._v(t._s(t.$t("App.botManager")))])],1),a("v-card-title",[a("v-btn",{attrs:{color:"primary"},on:{click:t.createBot}},[t._v(t._s(t.$t("App.createBot")))]),a("v-spacer"),a("v-text-field",{attrs:{"append-icon":"search",label:t.$t("Sys.search"),"single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1),a("v-data-table",{attrs:{headers:t.headers,items:t.desserts,search:t.search,"rows-per-page-text":t.$t("App.perPageText")},scopedSlots:t._u([{key:"items",fn:function(e){return[a("td",[t._v(t._s(e.item.id))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.name))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.username))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.property_key))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.create_time))]),a("td",{staticClass:"text-xs-center"},[a("a-switch",{attrs:{checkedChildren:t.$t("Sys.enable"),unCheckedChildren:t.$t("Sys.disable")},on:{change:function(a){return t.setState(e)}},model:{value:e.item.status,callback:function(a){t.$set(e.item,"status",a)},expression:"props.item.status"}})],1),a("td",{staticClass:"text-xs-center"},[a("a-tag",{attrs:{color:"#108ee9"},on:{click:function(a){return t.editUser(e)}}},[t._v(t._s(t.$t("Sys.edit")))]),a("a-popconfirm",{attrs:{placement:"topLeft",okText:t.$t("Sys.yes"),cancelText:t.$t("Sys.no")},on:{confirm:function(a){return t.resetPwd(e)}}},[a("template",{slot:"title"},[a("p",[t._v(t._s(t.$t("Sys.resetPwdMsg")))])])],2)],1)]}}])}),a("v-dialog",{attrs:{persistent:"","max-width":"600px"},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[a("v-card",{ref:"user"},[a("v-card-title",[a("span",{staticClass:"headline"},[t._v(t._s(t.$t("App.videoProfile")))])]),a("v-card-text",[a("v-container",{attrs:{"grid-list-md":""}},[a("v-layout",{attrs:{wrap:""}},[a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"name",attrs:{label:t.$t("App.botName")+"*",rules:[t.rules.required]},model:{value:t.Bot.name,callback:function(e){t.$set(t.Bot,"name",e)},expression:"Bot.name"}})],1),a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"username",attrs:{label:t.$t("App.botUsername")+"*",type:"username",rules:[t.rules.required]},model:{value:t.Bot.username,callback:function(e){t.$set(t.Bot,"username",e)},expression:"Bot.username"}})],1),a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"property_key",attrs:{label:t.$t("App.botKey")+"*",type:"property_key",rules:[t.rules.required]},model:{value:t.Bot.property_key,callback:function(e){t.$set(t.Bot,"property_key",e)},expression:"Bot.property_key"}})],1)],1)],1),a("small",[t._v(t._s(t.$t("Sys.requireMsg")))])],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:t.close}},[t._v(t._s(t.$t("Sys.close")))]),a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:t.createOrUpdateVideo}},[t._v(t._s(t.$t("Sys.save")))])],1)],1)],1)],1)},r=[],i=(a("456d"),a("ac6a"),a("bc3a")),n=a.n(i),o={data:function(){return{search:"",show:"",dialog:!1,isCreate:!1,roles:[],rules:{required:function(t){return!!t||"Required."}},Bot:{name:"",username:"",property_key:""},addBot:{},desserts:[]}},computed:{headers:function(){return[{text:"ID",align:"center",value:"id"},{text:this.$t("App.botName"),value:"name",align:"center"},{text:this.$t("App.botUsername"),value:"username",align:"center"},{text:this.$t("App.botKey"),value:"key",align:"center"},{text:this.$t("Sys.createTime"),value:"create_time",align:"center"},{text:this.$t("App.botStatus"),value:"status",align:"center"},{text:this.$t("Sys.operation"),sortable:!1,align:"center"}]}},methods:{init:function(){var t=this;n.a.all([this.$api.bot.get(),this.$api.role.get()]).then(n.a.spread(function(e,a){t.$data.desserts=e.data.map(function(t){return t.status=!!t.status,t}),t.$data.roles=a.data}))},setState:function(t){var e=this,a=t.item.status?1:0;this.$api.bot.setState(t.item.id,a).then(function(){e.$notify.success("edit success",{timeout:500})})},editUser:function(t){var e=this;this.$api.bot.getBotById(t.item.id).then(function(t){e.$data.Bot=t.data,e.$data.dialog=!0})},resetPwd:function(t){var e=this;this.$api.bot.resetPwd(t.item.id).then(function(){e.$notify.success("reset password success",{timeout:500})})},createOrUpdateVideo:function(){var t=this;if(this.$data.isCreate){var e=Object.assign({},this.$data.Bot,this.$data.addBot);this.$api.bot.createBot(e).then(function(){t.$data.isCreate=!1,t.init(),t.$notify.success("create success",{timeout:500})})}else this.$api.bot.editBot(this.$data.Bot.id,this.$data.Bot).then(function(){t.init(),t.$notify.success("edit success",{timeout:500})});this.dialog=!1},createBot:function(){var t=this,e=["name","username","property_key"];Object.keys(this.$data.Bot).forEach(function(a){0<=e.indexOf(a)&&t.$refs[a].reset()}),this.$data.isCreate=!0,this.$data.dialog=!0},close:function(){this.$data.isCreate&&(this.$data.isCreate=!1),this.$data.dialog=!1}},created:function(){this.init()}},c=o,l=a("2877"),d=a("6544"),u=a.n(d),p=a("8336"),h=a("b0af"),f=a("99d9"),m=a("12b2"),v=a("a523"),$=a("8fea"),b=a("169a"),x=a("0e8f"),y=a("a722"),_=a("9910"),g=a("2677"),k=a("71d9"),B=a("2a7f"),C=Object(l["a"])(c,s,r,!1,null,null,null);e["default"]=C.exports;u()(C,{VBtn:p["a"],VCard:h["a"],VCardActions:f["a"],VCardText:f["b"],VCardTitle:m["a"],VContainer:v["a"],VDataTable:$["a"],VDialog:b["a"],VFlex:x["a"],VLayout:y["a"],VSpacer:_["a"],VTextField:g["a"],VToolbar:k["a"],VToolbarTitle:B["a"]})}}]);
//# sourceMappingURL=chunk-744b2e2c.a79ca394.js.map
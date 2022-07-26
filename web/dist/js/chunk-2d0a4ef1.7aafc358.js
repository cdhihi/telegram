(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0a4ef1"],{"090b":function(t,e,a){"use strict";a.r(e);var s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",[a("v-toolbar",{attrs:{flat:"",height:"64px"}},[a("v-toolbar-title",[t._v(t._s(t.$t("App.advertiseManager")))])],1),a("v-card-title",[a("v-btn",{attrs:{color:"primary"},on:{click:t.createUser}},[t._v(t._s(t.$t("App.createAdvertise")))]),a("v-spacer"),a("v-text-field",{attrs:{"append-icon":"search",label:t.$t("Sys.search"),"single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1),a("v-data-table",{attrs:{headers:t.headers,items:t.desserts,search:t.search,"rows-per-page-text":t.$t("App.perPageText")},scopedSlots:t._u([{key:"items",fn:function(e){return[a("td",[t._v(t._s(e.item.id))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.name))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.link))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.create_time))]),a("td",{staticClass:"text-xs-center"},[t._v(t._s(e.item.update_time))]),a("td",{staticClass:"text-xs-center"},[a("a-switch",{attrs:{checkedChildren:t.$t("Sys.enable"),unCheckedChildren:t.$t("Sys.disable")},on:{change:function(a){return t.setState(e)}},model:{value:e.item.status,callback:function(a){t.$set(e.item,"status",a)},expression:"props.item.status"}})],1),a("td",{staticClass:"text-xs-center"},[a("a-tag",{attrs:{color:"#108ee9"},on:{click:function(a){return t.editUser(e)}}},[t._v(t._s(t.$t("Sys.edit")))]),a("a-popconfirm",{attrs:{placement:"topLeft",okText:t.$t("Sys.yes"),cancelText:t.$t("Sys.no")},on:{confirm:function(a){return t.resetPwd(e)}}},[a("template",{slot:"title"},[a("p",[t._v(t._s(t.$t("Sys.resetPwdMsg")))])])],2)],1)]}}])}),a("v-dialog",{attrs:{persistent:"","max-width":"600px"},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[a("v-card",{ref:"user"},[a("v-card-title",[a("span",{staticClass:"headline"},[t._v(t._s(t.$t("App.advertiseProfile")))])]),a("v-card-text",[a("v-container",{attrs:{"grid-list-md":""}},[a("v-layout",{attrs:{wrap:""}},[a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"name",attrs:{label:t.$t("App.advertiseName")+"*",rules:[t.rules.required]},model:{value:t.advertise.name,callback:function(e){t.$set(t.advertise,"name",e)},expression:"advertise.name"}})],1),a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"link",attrs:{label:t.$t("App.advertiseLink")+"*",type:"link",rules:[t.rules.required]},model:{value:t.advertise.link,callback:function(e){t.$set(t.advertise,"link",e)},expression:"advertise.link"}})],1)],1)],1),a("small",[t._v(t._s(t.$t("Sys.requireMsg")))])],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:t.close}},[t._v(t._s(t.$t("Sys.close")))]),a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:t.createOrUpdateAdvertise}},[t._v(t._s(t.$t("Sys.save")))])],1)],1)],1)],1)},i=[],r=(a("456d"),a("ac6a"),a("bc3a")),n=a.n(r),d={data:function(){return{search:"",show:"",dialog:!1,isCreate:!1,roles:[],rules:{required:function(t){return!!t||"Required."}},advertise:{name:"",link:""},addUser:{},desserts:[]}},computed:{headers:function(){return[{text:"ID",align:"center",value:"id"},{text:this.$t("App.advertiseName"),value:"id",align:"center"},{text:this.$t("App.advertiseLink"),value:"name",align:"center"},{text:this.$t("Sys.createTime"),value:"create_time",align:"center"},{text:this.$t("Sys.updateTime"),value:"update_time",align:"center"},{text:this.$t("App.advertiseStatus"),value:"link",align:"center"},{text:this.$t("Sys.operation"),sortable:!1,align:"center"}]}},methods:{init:function(){var t=this;n.a.all([this.$api.advertise.get(),this.$api.role.get()]).then(n.a.spread(function(e,a){t.$data.desserts=e.data.map(function(t){return t.status=!!t.status,t}),t.$data.roles=a.data}))},setState:function(t){var e=this,a=t.item.status?1:0;this.$api.advertise.setState(t.item.id,a).then(function(){e.$notify.success("edit success",{timeout:500})})},editUser:function(t){var e=this;this.$api.advertise.getAdvertiseById(t.item.id).then(function(t){e.$data.advertise=t.data,e.$data.dialog=!0})},resetPwd:function(t){var e=this;this.$api.user.resetPwd(t.item.id).then(function(){e.$notify.success("reset password success",{timeout:500})})},createOrUpdateAdvertise:function(){var t=this;if(this.$data.isCreate){var e=Object.assign({},this.$data.advertise,this.$data.addUser);this.$api.advertise.createAdvertise(e).then(function(){t.$data.isCreate=!1,t.$api.advertise.get().then(function(e){t.$data.desserts=e.data}),t.$notify.success("create success",{timeout:500})})}else this.$api.advertise.editAdvertise(this.$data.advertise.id,this.$data.advertise).then(function(){t.$api.advertise.get().then(function(e){t.$data.desserts=e.data}),t.$notify.success("edit success",{timeout:500})});this.dialog=!1},createUser:function(){var t=this,e=["name","link"];Object.keys(this.$data.advertise).forEach(function(a){0<=e.indexOf(a)&&t.$refs[a].reset()}),this.$data.isCreate=!0,this.$data.dialog=!0},close:function(){this.$data.isCreate&&(this.$data.isCreate=!1),this.$data.dialog=!1}},created:function(){this.init()}},c=d,l=a("2877"),o=a("6544"),u=a.n(o),v=a("8336"),p=a("b0af"),h=a("99d9"),f=a("12b2"),$=a("a523"),m=a("8fea"),x=a("169a"),g=a("0e8f"),_=a("a722"),b=a("9910"),k=a("2677"),y=a("71d9"),C=a("2a7f"),S=Object(l["a"])(c,s,i,!1,null,null,null);e["default"]=S.exports;u()(S,{VBtn:v["a"],VCard:p["a"],VCardActions:h["a"],VCardText:h["b"],VCardTitle:f["a"],VContainer:$["a"],VDataTable:m["a"],VDialog:x["a"],VFlex:g["a"],VLayout:_["a"],VSpacer:b["a"],VTextField:k["a"],VToolbar:y["a"],VToolbarTitle:C["a"]})}}]);
//# sourceMappingURL=chunk-2d0a4ef1.7aafc358.js.map
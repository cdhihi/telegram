(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0a4f25"],{"0939":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-card",[a("v-toolbar",{attrs:{flat:"",height:"64px"}},[a("v-toolbar-title",[e._v(e._s(e.$t("App.videoManager")))])],1),a("v-card-title",[a("v-btn",{attrs:{color:"primary"},on:{click:e.createUser}},[e._v(e._s(e.$t("App.createVideo")))]),a("v-spacer"),a("v-text-field",{attrs:{"append-icon":"search",label:e.$t("Sys.search"),"single-line":"","hide-details":""},model:{value:e.search,callback:function(t){e.search=t},expression:"search"}})],1),a("v-data-table",{attrs:{headers:e.headers,items:e.desserts,search:e.search,"rows-per-page-text":e.$t("App.perPageText")},scopedSlots:e._u([{key:"items",fn:function(t){return[a("td",[e._v(e._s(t.item.id))]),a("td",{staticClass:"text-xs-center"},[e._v(e._s(t.item.name))]),a("td",{staticClass:"text-xs-center"},[e._v(e._s(t.item.link))]),a("td",{staticClass:"text-xs-center"},[e._v(e._s(t.item.describe))]),a("td",{staticClass:"text-xs-center"},[e._v(e._s(t.item.create_time))]),a("td",{staticClass:"text-xs-center"},[a("a-switch",{attrs:{checkedChildren:e.$t("Sys.enable"),unCheckedChildren:e.$t("Sys.disable")},on:{change:function(a){return e.setState(t)}},model:{value:t.item.status,callback:function(a){e.$set(t.item,"status",a)},expression:"props.item.status"}})],1),a("td",{staticClass:"text-xs-center"},[a("a-tag",{attrs:{color:"#108ee9"},on:{click:function(a){return e.editUser(t)}}},[e._v(e._s(e.$t("Sys.edit")))]),a("a-popconfirm",{attrs:{placement:"topLeft",okText:e.$t("Sys.yes"),cancelText:e.$t("Sys.no")},on:{confirm:function(a){return e.resetPwd(t)}}},[a("template",{slot:"title"},[a("p",[e._v(e._s(e.$t("Sys.resetPwdMsg")))])])],2)],1)]}}])}),a("v-dialog",{attrs:{persistent:"","max-width":"600px"},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[a("v-card",{ref:"user"},[a("v-card-title",[a("span",{staticClass:"headline"},[e._v(e._s(e.$t("App.videoProfile")))])]),a("v-card-text",[a("v-container",{attrs:{"grid-list-md":""}},[a("v-layout",{attrs:{wrap:""}},[a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"name",attrs:{label:e.$t("App.videoName")+"*",rules:[e.rules.required]},model:{value:e.Video.name,callback:function(t){e.$set(e.Video,"name",t)},expression:"Video.name"}})],1),a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"link",attrs:{label:e.$t("App.videoLink")+"*",type:"link",rules:[e.rules.required]},model:{value:e.Video.link,callback:function(t){e.$set(e.Video,"link",t)},expression:"Video.link"}})],1),a("v-flex",{attrs:{xs12:""}},[a("v-text-field",{ref:"link",attrs:{label:e.$t("App.videoDescribe")+"*",type:"link",rules:[e.rules.required]},model:{value:e.Video.describe,callback:function(t){e.$set(e.Video,"describe",t)},expression:"Video.describe"}})],1)],1)],1),a("small",[e._v(e._s(e.$t("Sys.requireMsg")))])],1),a("v-card-actions",[a("v-spacer"),a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:e.close}},[e._v(e._s(e.$t("Sys.close")))]),a("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:e.createOrUpdateVideo}},[e._v(e._s(e.$t("Sys.save")))])],1)],1)],1)],1)},i=[],r=(a("456d"),a("ac6a"),a("bc3a")),n=a.n(r),d={data:function(){return{search:"",show:"",dialog:!1,isCreate:!1,roles:[],rules:{required:function(e){return!!e||"Required."}},Video:{name:"",link:"",describe:""},addUser:{},desserts:[]}},computed:{headers:function(){return[{text:"ID",align:"center",value:"id"},{text:this.$t("App.videoName"),value:"id",align:"center"},{text:this.$t("App.videoLink"),value:"name",align:"center"},{text:this.$t("App.videoDescribe"),value:"describe",align:"center"},{text:this.$t("Sys.createTime"),value:"create_time",align:"center"},{text:this.$t("App.videoStatus"),value:"link",align:"center"},{text:this.$t("Sys.operation"),sortable:!1,align:"center"}]}},methods:{init:function(){var e=this;n.a.all([this.$api.video.get(),this.$api.role.get()]).then(n.a.spread(function(t,a){e.$data.desserts=t.data.map(function(e){return e.status=!!e.status,e}),e.$data.roles=a.data}))},setState:function(e){var t=this,a=e.item.status?1:0;this.$api.video.setState(e.item.id,a).then(function(){t.$notify.success("edit success",{timeout:500})})},editUser:function(e){var t=this;this.$api.video.getVideoById(e.item.id).then(function(e){t.$data.Video=e.data,t.$data.dialog=!0})},resetPwd:function(e){var t=this;this.$api.video.resetPwd(e.item.id).then(function(){t.$notify.success("reset password success",{timeout:500})})},createOrUpdateVideo:function(){var e=this;if(this.$data.isCreate){var t=Object.assign({},this.$data.Video,this.$data.addUser);this.$api.video.createVideo(t).then(function(){e.$data.isCreate=!1,e.$api.video.get().then(function(t){e.$data.desserts=t.data}),e.$notify.success("create success",{timeout:500})})}else this.$api.video.editVideo(this.$data.Video.id,this.$data.Video).then(function(){e.$api.video.get().then(function(t){e.$data.desserts=t.data}),e.$notify.success("edit success",{timeout:500})});this.dialog=!1},createUser:function(){var e=this,t=["name","link"];Object.keys(this.$data.Video).forEach(function(a){0<=t.indexOf(a)&&e.$refs[a].reset()}),this.$data.isCreate=!0,this.$data.dialog=!0},close:function(){this.$data.isCreate&&(this.$data.isCreate=!1),this.$data.dialog=!1}},created:function(){this.init()}},o=d,c=a("2877"),l=a("6544"),u=a.n(l),v=a("8336"),p=a("b0af"),h=a("99d9"),f=a("12b2"),$=a("a523"),m=a("8fea"),x=a("169a"),b=a("0e8f"),V=a("a722"),g=a("9910"),k=a("2677"),_=a("71d9"),y=a("2a7f"),C=Object(c["a"])(o,s,i,!1,null,null,null);t["default"]=C.exports;u()(C,{VBtn:v["a"],VCard:p["a"],VCardActions:h["a"],VCardText:h["b"],VCardTitle:f["a"],VContainer:$["a"],VDataTable:m["a"],VDialog:x["a"],VFlex:b["a"],VLayout:V["a"],VSpacer:g["a"],VTextField:k["a"],VToolbar:_["a"],VToolbarTitle:y["a"]})}}]);
//# sourceMappingURL=chunk-2d0a4f25.ba83d1ae.js.map
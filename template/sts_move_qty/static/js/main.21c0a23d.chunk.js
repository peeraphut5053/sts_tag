(this.webpackJsonpsts_delivery_note=this.webpackJsonpsts_delivery_note||[]).push([[0],{389:function(e,t,a){e.exports=a(503)},394:function(e,t,a){},395:function(e,t,a){},503:function(e,t,a){"use strict";a.r(t);var n=a(0),c=a.n(n),r=a(16),o=a.n(r),l=(a(394),a(35)),i=(a(395),a(533)),s=a(534),u=a(525),m=a(380),d=a(203),f=a(337),g=a(315),h=a(189),b=a(314),_=a(77),v=a.n(_),E=a(536);function y(e){return c.a.createElement(E.a,{id:"combo-box-demo",options:e.selectValue,getOptionLabel:function(e){return e.title},style:{width:"100%",margin:10},onChange:function(t,a){e.handleSelectValue(a.title)},renderInput:function(t){return c.a.createElement(b.a,Object.assign({},t,{label:e.label,variant:"outlined"}))},size:"small"})}var j=Object(g.a)({root:{width:"100%",margin:10},textField:{margin:5,width:"100%",padding:0}});var O=function(e){var t=j(),a=Object(n.useState)([]),r=Object(l.a)(a,2),o=r[0],i=r[1];return Object(n.useEffect)((function(){v.a.get("http://localhost/sts_web_center/module/API_QuantityMove/data.php?load=location_mst").then((function(e){var t=e.data.map((function(e){return{title:e.loc}}));i(t)}))}),[]),c.a.createElement(h.a,{className:t.root},c.a.createElement(u.a,{container:!0,alignItems:"center",direction:"row",justify:"space-between",spacing:0},e.PageState?c.a.createElement(u.a,{container:!0,alignItems:"center",direction:"row",justify:"space-between",spacing:0},c.a.createElement(u.a,{item:!0,md:4,container:!0},c.a.createElement(y,{label:"Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07",selectValue:o,handleSelectValue:e.handleToLocation})),c.a.createElement(u.a,{item:!0,md:8,container:!0},c.a.createElement(b.a,{size:"small",label:"Scan tag",id:"tagScan",variant:"outlined",className:t.textField,onKeyUp:function(t){"Enter"===t.key&&(e.handleScanTag(t.target.value),document.getElementById("tagScan").value="")}}))):c.a.createElement(c.a.Fragment,null,c.a.createElement(u.a,{item:!0,md:4,container:!0},c.a.createElement(b.a,{size:"small",label:"Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07",variant:"outlined",className:t.textField,value:e.STS_qty_move_hdr_loc})),c.a.createElement(u.a,{item:!0,md:4,container:!0},c.a.createElement(b.a,{size:"small",label:"Move Qty Document ID",variant:"outlined",className:t.textField,value:e.DocNum})),c.a.createElement(u.a,{item:!0,md:4,container:!0},c.a.createElement(b.a,{size:"small",label:"Date",variant:"outlined",className:t.textField,value:e.STS_qty_move_hdr_date})))))},S=a(194),p=a.n(S),w=a(359),x=a.n(w),q=a(369),T=a.n(q),P=a(360),I=a.n(P),R=a(367),A=a.n(R),L=a(249),C=a.n(L),N=a(248),k=a.n(N),D=a(361),M=a.n(D),F=a(362),Q=a.n(F),B=a(364),V=a.n(B),W=a(365),z=a.n(W),H=a(366),J=a.n(H),X=a(370),K=a.n(X),U=a(363),$=a.n(U),G=a(368),Y=a.n(G),Z=a(371),ee=a.n(Z),te=a(372),ae=a.n(te),ne=a(373),ce=a.n(ne),re=a(374),oe=a.n(re),le={Add:Object(n.forwardRef)((function(e,t){return c.a.createElement(x.a,Object.assign({},e,{ref:t}))})),Check:Object(n.forwardRef)((function(e,t){return c.a.createElement(I.a,Object.assign({},e,{ref:t}))})),Clear:Object(n.forwardRef)((function(e,t){return c.a.createElement(k.a,Object.assign({},e,{ref:t}))})),Delete:Object(n.forwardRef)((function(e,t){return c.a.createElement(M.a,Object.assign({},e,{ref:t}))})),DetailPanel:Object(n.forwardRef)((function(e,t){return c.a.createElement(C.a,Object.assign({},e,{ref:t}))})),Edit:Object(n.forwardRef)((function(e,t){return c.a.createElement(Q.a,Object.assign({},e,{ref:t}))})),Export:Object(n.forwardRef)((function(e,t){return c.a.createElement($.a,Object.assign({},e,{ref:t}))})),Filter:Object(n.forwardRef)((function(e,t){return c.a.createElement(V.a,Object.assign({},e,{ref:t}))})),FirstPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(z.a,Object.assign({},e,{ref:t}))})),LastPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(J.a,Object.assign({},e,{ref:t}))})),NextPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(C.a,Object.assign({},e,{ref:t}))})),PreviousPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(A.a,Object.assign({},e,{ref:t}))})),ResetSearch:Object(n.forwardRef)((function(e,t){return c.a.createElement(k.a,Object.assign({},e,{ref:t}))})),Search:Object(n.forwardRef)((function(e,t){return c.a.createElement(Y.a,Object.assign({},e,{ref:t}))})),SortArrow:Object(n.forwardRef)((function(e,t){return c.a.createElement(T.a,Object.assign({},e,{ref:t}))})),ThirdStateCheck:Object(n.forwardRef)((function(e,t){return c.a.createElement(K.a,Object.assign({},e,{ref:t}))})),ViewColumn:Object(n.forwardRef)((function(e,t){return c.a.createElement(ee.a,Object.assign({},e,{ref:t}))})),PrintIcon:Object(n.forwardRef)((function(e,t){return c.a.createElement(ae.a,Object.assign({},e,{ref:t}))})),FormatListNumberedIcon:Object(n.forwardRef)((function(e,t){return c.a.createElement(ce.a,Object.assign({},e,{ref:t}))})),CropFreeIcon:Object(n.forwardRef)((function(e,t){return c.a.createElement(oe.a,Object.assign({},e,{ref:t}))}))},ie=Object(g.a)({root:{padding:10,width:"99%",margin:10}});var se=function(e){var t=ie();return c.a.createElement(h.a,{className:t.root},c.a.createElement(p.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:le,title:"Quantity Move List :"+e.qtyMoveList.length,columns:[{title:"id",field:"id"},{title:"lot",field:"lot"},{title:"From location",field:"loc"},{title:"item",field:"item"},{title:"\u0e40\u0e2a\u0e49\u0e19/\u0e21\u0e31\u0e14",field:"qty1",type:"numeric"},{title:"unit",field:"u_m"}],data:e.qtyMoveList,options:{search:!1,paging:!1,maxBodyHeight:"50vh",minBodyHeight:"50vh"}}))},ue=a(201),me=a.n(ue),de=a(378),fe=a.n(de),ge=a(375),he=a(376),be=a(381),_e=a(379),ve=a(377),Ee=function(e){Object(be.a)(a,e);var t=Object(_e.a)(a);function a(){return Object(ge.a)(this,a),t.apply(this,arguments)}return Object(he.a)(a,[{key:"render",value:function(){return c.a.createElement(i.a,null,c.a.createElement(u.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement("br",null),"123456"))}}]),a}(c.a.Component);function ye(){var e=Object(n.useRef)(),t=Object(ve.useReactToPrint)({content:function(){return e.current}});return c.a.createElement(c.a.Fragment,null,c.a.createElement(u.a,{container:!0,spacing:3,style:{textAlign:"center",visibility:"hidden"}},c.a.createElement(Ee,{ref:e})),c.a.createElement(f.a,{variant:"contained",color:"secondary",startIcon:c.a.createElement(me.a,null),style:{margin:10},onClick:t},"Print  "))}var je=a(343),Oe=a(89),Se=a(236);function pe(e){return c.a.createElement(Se.a,{display:"flex",alignItems:"center"},c.a.createElement(Se.a,{width:"100%",mr:1},c.a.createElement(je.a,Object.assign({variant:"determinate"},e))),c.a.createElement(Se.a,{minWidth:35},c.a.createElement(Oe.a,{variant:"body2",color:"textSecondary"},"".concat(Math.round(e.value),"%"))))}var we=Object(g.a)({root:{width:"100%"}});function xe(e){var t=we(),a=c.a.useState(0),n=Object(l.a)(a,2),r=n[0],o=n[1];return c.a.useEffect((function(){var t=1,a=setInterval((function(){o((function(t){return t>=100?0:t+100/e.listLength})),console.log(t),t===e.listLength+1&&(clearInterval(a),alert("\u0e22\u0e49\u0e32\u0e22\u0e02\u0e49\u0e2d\u0e21\u0e39\u0e25\u0e2a\u0e33\u0e40\u0e23\u0e47\u0e08"),e.handleProcessSuccess(!1)),t+=1}),1200);return function(){clearInterval(a)}}),[]),c.a.createElement("div",{className:t.root},c.a.createElement(pe,{value:r}))}var qe=function(e){var t=Object(n.useState)(),a=Object(l.a)(t,2),r=a[0],o=a[1],s=Object(n.useState)([]),h=Object(l.a)(s,2),b=h[0],_=h[1],E=Object(n.useState)(""),y=Object(l.a)(E,2),j=y[0],S=y[1],p=Object(n.useState)(!1),w=Object(l.a)(p,2),x=w[0],q=w[1],T=Object(n.useState)(!1),P=Object(l.a)(T,2),I=P[0],R=P[1];Object(n.useEffect)((function(){console.log(x),q(!1)}),[I]);var A=Object(g.a)((function(e){return{paper:{position:"absolute",width:"80%",backgroundColor:e.palette.background.paper,border:"2px solid #000",boxShadow:e.shadows[5],padding:e.spacing(2,4,3),margin:"5%"}}}))(),L=c.a.createElement("div",{className:A.paper},c.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},c.a.createElement(u.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(u.a,{item:!0,xs:4,style:{textAlign:"center"}},"  \u0e40\u0e25\u0e02\u0e40\u0e2d\u0e01\u0e2a\u0e32\u0e23:",j),c.a.createElement(u.a,{item:!0,xs:4,style:{textAlign:"center"}},"  Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07:",r),c.a.createElement(u.a,{item:!0,xs:4,style:{textAlign:"center"}},"  \u0e17\u0e33\u0e01\u0e32\u0e23\u0e22\u0e49\u0e32\u0e22 Location ",b.length," \u0e23\u0e32\u0e22\u0e01\u0e32\u0e23")),c.a.createElement(u.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(u.a,{item:!0,xs:12,style:{textAlign:"center"}},c.a.createElement(xe,{listLength:b.length,handleProcessSuccess:function(t){q(!1),R(t),e.setPageState(t)}}))),c.a.createElement(u.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(u.a,{item:!0,xs:12,style:{textAlign:"center"}}))));return c.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},c.a.createElement("div",null,c.a.createElement(d.a,{open:x,onClose:function(){q(!1)},"aria-labelledby":"simple-modal-title","aria-describedby":"simple-modal-description"},L)),c.a.createElement(u.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(O,{handleScanTag:function(e){v.a.get("http://localhost/sts_web_center/module/API_QuantityMove/data.php?load=SearchTagDetail&tag_id=".concat(e)).then((function(e){var t=e.data;e.data.length>0?_((function(e){return[].concat(Object(m.a)(e),[{id:t[0].id,lot:t[0].lot,loc:t[0].loc,item:t[0].item,qty1:t[0].qty1,u_m:t[0].u_m}])})):alert("\u0e44\u0e21\u0e48\u0e1e\u0e1a Tags")}))},handleToLocation:function(e){o(e)},DocNum:e.DocNum,STS_qty_move_hdr_loc:e.STS_qty_move_hdr_loc,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date,PageState:e.PageState}),c.a.createElement(se,{qtyMoveList:e.PageState?b:e.STS_qty_move_line}),c.a.createElement("div",{style:{width:"100%"}},e.PageState?c.a.createElement(f.a,{variant:"contained",color:"primary",startIcon:c.a.createElement(me.a,null),style:{margin:10},onClick:function(){r?(q(!0),v.a.get("http://localhost/sts_web_center/module/API_QuantityMove/data.php?load=moveqty_create_hdr&toLoc=".concat(r)).then((function(e){var t=e.data;if(S(t.doc_num),o(t.loc),b.length>0){var a=1;console.log(b[a-1]);var n=setInterval((function(){v.a.get("http://localhost/sts_web_center/module/API_QuantityMove/data.php?load=moveqty_create_line&docnum=".concat(t.doc_num,"&docline=").concat(a,"&tagnum=").concat(b[a-1].id,"&toLoc=").concat(r)).then((function(e){console.log("Call API moveqty_create_line")})),a===b.length&&(clearInterval(n),_([])),a+=1}),1e3)}}))):(alert("\u0e01\u0e23\u0e38\u0e13\u0e32\u0e01\u0e23\u0e2d\u0e01 location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07"),q(!1))}},"Save  "):c.a.createElement(ye,null),c.a.createElement(f.a,{variant:"contained",color:"default",startIcon:c.a.createElement(fe.a,null),style:{margin:10}}," Clear "))))};function Te(e){return c.a.createElement(h.a,null,c.a.createElement(p.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:le,title:"Document List",columns:[{title:"Doc num",field:"doc_num"},{title:"date",field:"create_date.date",type:"date"},{title:"To location",field:"loc"}],onRowClick:function(t,a){var n;n=a,e.handleDocNum(n.doc_num),e.handleSTS_qty_move_hdr_loc(n.loc),e.handleSTS_qty_move_hdr_date(n.create_date.date),v.a.get("http://localhost/sts_web_center/module/API_QuantityMove/data.php?load=STS_qty_move_line&doc_num=".concat(n.doc_num)).then((function(t){console.log(t.data),e.handleSTS_qty_move_line(t.data)}))},data:e.STS_qty_move_hrd,options:{search:!1,paging:!1,maxBodyHeight:"70vh",minBodyHeight:"70vh"}}))}var Pe=function(){var e=Object(n.useState)(!1),t=Object(l.a)(e,2),a=t[0],r=t[1],o=Object(n.useState)(""),m=Object(l.a)(o,2),d=m[0],f=m[1],g=Object(n.useState)(""),h=Object(l.a)(g,2),b=h[0],_=h[1],E=Object(n.useState)(""),y=Object(l.a)(E,2),j=y[0],O=y[1],S=Object(n.useState)([]),p=Object(l.a)(S,2),w=p[0],x=p[1],q=Object(n.useState)([]),T=Object(l.a)(q,2),P=T[0],I=T[1];return Object(n.useEffect)((function(){console.log(1),v.a.get("http://localhost/sts_web_center/module/API_QuantityMove/data.php?load=STS_qty_move_hrd").then((function(e){I(e.data)}))}),[a]),c.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},c.a.createElement(u.a,{container:!0,spacing:3},c.a.createElement(u.a,{item:!0,xs:a?2:5,hidden:!!a,style:{textAlign:"center"}},c.a.createElement(Te,{STS_qty_move_hrd:P,handleDocNum:function(e){return f(e)},handleSTS_qty_move_hdr_loc:function(e){return _(e)},handleSTS_qty_move_hdr_date:function(e){O(e)},handleSTS_qty_move_line:function(e){return x(e)}})),c.a.createElement(u.a,{item:!0,xs:a?12:7},c.a.createElement(s.a,{checked:a,onChange:function(){return r((function(e){return!e}))}}),a?"Create 1901302030137":"View",c.a.createElement(qe,{PageState:a,DocNum:d,STS_qty_move_hdr_loc:b,STS_qty_move_hdr_date:j,STS_qty_move_line:w,setPageState:function(e){r(e)}}))))};Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));o.a.render(c.a.createElement(c.a.StrictMode,null,c.a.createElement(Pe,null)),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(e){e.unregister()})).catch((function(e){console.error(e.message)}))}},[[389,1,2]]]);
//# sourceMappingURL=main.21c0a23d.chunk.js.map
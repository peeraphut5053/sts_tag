(this.webpackJsonpsts_delivery_note=this.webpackJsonpsts_delivery_note||[]).push([[0],{388:function(e,t,a){e.exports=a(502)},393:function(e,t,a){},394:function(e,t,a){},502:function(e,t,a){"use strict";a.r(t);var n=a(0),r=a.n(n),c=a(16),o=a.n(c),l=(a(393),a(34)),i=(a(394),a(532)),m=a(533),s=a(524),u=a(379),d=a(202),f=a(336),g=a(314),h=a(188),_=a(305),E=a(536);function b(e){return r.a.createElement(E.a,{id:"combo-box-demo",options:e.selectValue,getOptionLabel:function(e){return e.title},style:{width:"100%",margin:10},onChange:function(t,a){e.handleSelectValue(a.title)},renderInput:function(t){return r.a.createElement(_.a,Object.assign({},t,{label:e.label,variant:"outlined"}))},size:"small"})}var v=a(354),y=a.n(v).a.create({baseURL:"http://".concat(window.location.host,"/sts_web_center/")}),S=Object(g.a)({root:{width:"100%",margin:10},textField:{margin:5,width:"100%",padding:0}});var p=function(e){var t=S(),a=Object(n.useState)([]),c=Object(l.a)(a,2),o=c[0],i=c[1];return Object(n.useEffect)((function(){y.get("module/API_QuantityMove/data.php?load=location_mst").then((function(e){var t=e.data.map((function(e){return{title:e.loc}}));i(t)}))}),[]),r.a.createElement(h.a,{className:t.root},r.a.createElement(s.a,{container:!0,alignItems:"center",direction:"row",justify:"space-between",spacing:0},e.PageState?r.a.createElement(s.a,{container:!0,alignItems:"center",direction:"row",justify:"space-between",spacing:0},r.a.createElement(s.a,{item:!0,md:4,container:!0},r.a.createElement(b,{label:"Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07",selectValue:o,handleSelectValue:e.handleToLocation})),r.a.createElement(s.a,{item:!0,md:8,container:!0},r.a.createElement(_.a,{size:"small",label:"Scan tag",id:"tagScan",variant:"outlined",className:t.textField,onKeyUp:function(t){"Enter"===t.key&&(e.handleScanTag(t.target.value),document.getElementById("tagScan").value="")}}))):r.a.createElement(r.a.Fragment,null,r.a.createElement(s.a,{item:!0,md:4,container:!0},r.a.createElement(_.a,{size:"small",label:"Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07",variant:"outlined",className:t.textField,value:e.STS_qty_move_hdr_loc})),r.a.createElement(s.a,{item:!0,md:4,container:!0},r.a.createElement(_.a,{size:"small",label:"Move Qty Document ID",variant:"outlined",className:t.textField,value:e.DocNum})),r.a.createElement(s.a,{item:!0,md:4,container:!0},r.a.createElement(_.a,{size:"small",label:"Date",variant:"outlined",className:t.textField,value:e.STS_qty_move_hdr_date})))))},j=a(193),O=a.n(j),w=a(359),q=a.n(w),x=a(369),L=a.n(x),T=a(360),P=a.n(T),I=a(367),R=a.n(I),N=a(249),M=a.n(N),A=a(248),D=a.n(A),k=a(361),C=a.n(k),F=a(362),Q=a.n(F),B=a(364),W=a.n(B),z=a(365),V=a.n(z),H=a(366),J=a.n(H),U=a(370),X=a.n(U),K=a(363),Y=a.n(K),$=a(368),G=a.n($),Z=a(371),ee=a.n(Z),te=a(372),ae=a.n(te),ne=a(373),re=a.n(ne),ce=a(374),oe=a.n(ce),le={Add:Object(n.forwardRef)((function(e,t){return r.a.createElement(q.a,Object.assign({},e,{ref:t}))})),Check:Object(n.forwardRef)((function(e,t){return r.a.createElement(P.a,Object.assign({},e,{ref:t}))})),Clear:Object(n.forwardRef)((function(e,t){return r.a.createElement(D.a,Object.assign({},e,{ref:t}))})),Delete:Object(n.forwardRef)((function(e,t){return r.a.createElement(C.a,Object.assign({},e,{ref:t}))})),DetailPanel:Object(n.forwardRef)((function(e,t){return r.a.createElement(M.a,Object.assign({},e,{ref:t}))})),Edit:Object(n.forwardRef)((function(e,t){return r.a.createElement(Q.a,Object.assign({},e,{ref:t}))})),Export:Object(n.forwardRef)((function(e,t){return r.a.createElement(Y.a,Object.assign({},e,{ref:t}))})),Filter:Object(n.forwardRef)((function(e,t){return r.a.createElement(W.a,Object.assign({},e,{ref:t}))})),FirstPage:Object(n.forwardRef)((function(e,t){return r.a.createElement(V.a,Object.assign({},e,{ref:t}))})),LastPage:Object(n.forwardRef)((function(e,t){return r.a.createElement(J.a,Object.assign({},e,{ref:t}))})),NextPage:Object(n.forwardRef)((function(e,t){return r.a.createElement(M.a,Object.assign({},e,{ref:t}))})),PreviousPage:Object(n.forwardRef)((function(e,t){return r.a.createElement(R.a,Object.assign({},e,{ref:t}))})),ResetSearch:Object(n.forwardRef)((function(e,t){return r.a.createElement(D.a,Object.assign({},e,{ref:t}))})),Search:Object(n.forwardRef)((function(e,t){return r.a.createElement(G.a,Object.assign({},e,{ref:t}))})),SortArrow:Object(n.forwardRef)((function(e,t){return r.a.createElement(L.a,Object.assign({},e,{ref:t}))})),ThirdStateCheck:Object(n.forwardRef)((function(e,t){return r.a.createElement(X.a,Object.assign({},e,{ref:t}))})),ViewColumn:Object(n.forwardRef)((function(e,t){return r.a.createElement(ee.a,Object.assign({},e,{ref:t}))})),PrintIcon:Object(n.forwardRef)((function(e,t){return r.a.createElement(ae.a,Object.assign({},e,{ref:t}))})),FormatListNumberedIcon:Object(n.forwardRef)((function(e,t){return r.a.createElement(re.a,Object.assign({},e,{ref:t}))})),CropFreeIcon:Object(n.forwardRef)((function(e,t){return r.a.createElement(oe.a,Object.assign({},e,{ref:t}))}))},ie=Object(g.a)({root:{padding:10,width:"99%",margin:10}});var me=function(e){var t=ie();return r.a.createElement(h.a,{className:t.root},r.a.createElement(O.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:le,title:"Quantity Move List :"+e.qtyMoveList.length,columns:[{title:"id",field:"id"},{title:"lot",field:"lot"},{title:"From location",field:"loc"},{title:"item",field:"item"},{title:"\u0e40\u0e2a\u0e49\u0e19/\u0e21\u0e31\u0e14",field:"qty1",type:"numeric"},{title:"unit",field:"u_m"}],data:e.qtyMoveList,options:{search:!1,paging:!1,maxBodyHeight:"45vh",minBodyHeight:"45vh"}}))},se=a(200),ue=a.n(se),de=a(375),fe=a(376),ge=a(380),he=a(378),_e=a(377),Ee=a(236),be=a(343),ve=a(323),ye=a(318),Se=a(534),pe=a(340),je=a(324),Oe=function(e){Object(ge.a)(a,e);var t=Object(he.a)(a);function a(){return Object(de.a)(this,a),t.apply(this,arguments)}return Object(fe.a)(a,[{key:"render",value:function(){var e=this.props.qtyMoveList.reduce((function(e,t){return e+t.qty1}),0);return r.a.createElement(i.a,null,r.a.createElement(i.a,{maxWidth:"lg",style:{paddingTop:50,width:"99%"}},r.a.createElement(s.a,{container:!0},r.a.createElement(s.a,{item:!0,xs:12,style:{textAlign:"center"}},r.a.createElement(Ee.a,{border:1},r.a.createElement("p",null,"\u0e23\u0e32\u0e22\u0e07\u0e32\u0e19\u0e01\u0e32\u0e23\u0e22\u0e49\u0e32\u0e22 Item Location"))),r.a.createElement(s.a,{item:!0,xs:12},r.a.createElement(Ee.a,{border:1,paddingLeft:2},r.a.createElement("p",null,"Document :  ",this.props.DocNum),r.a.createElement("p",null,"Location Destination :  ",this.props.toLocation),r.a.createElement("p",null,"\u0e40\u0e27\u0e25\u0e32 : ",this.props.STS_qty_move_hdr_date))),r.a.createElement(s.a,{item:!0,xs:12},r.a.createElement(Ee.a,{border:1},r.a.createElement(Se.a,{component:h.a},r.a.createElement(be.a,{"aria-label":"simple table",size:"small"},r.a.createElement(pe.a,null,r.a.createElement(je.a,null,r.a.createElement(ye.a,{align:"right"},"#"),r.a.createElement(ye.a,{align:"center"},"lot"),r.a.createElement(ye.a,{align:"center"},"From\xa0Location"),r.a.createElement(ye.a,{align:"center"},"item"),r.a.createElement(ye.a,{align:"center"},"\u0e40\u0e2a\u0e49\u0e19/\u0e21\u0e31\u0e14"))),r.a.createElement(ve.a,null,this.props.qtyMoveList.filter((function(e){return e.qty1>1})).map((function(e,t){return r.a.createElement(je.a,{key:e.id},r.a.createElement(ye.a,{align:"right"},t+1),r.a.createElement(ye.a,{align:"right"},e.lot),r.a.createElement(ye.a,{align:"center"},e.fromloc),r.a.createElement(ye.a,{align:"right"},e.item),r.a.createElement(ye.a,{align:"right"},e.qty1))})),r.a.createElement(je.a,null,r.a.createElement(ye.a,{colSpan:3}),r.a.createElement(ye.a,null,"total"),r.a.createElement(ye.a,{align:"right"},e))))))))))}}]),a}(r.a.Component);function we(e){var t=Object(n.useRef)(),a=Object(_e.useReactToPrint)({content:function(){return t.current}});return r.a.createElement(r.a.Fragment,null,r.a.createElement(f.a,{variant:"contained",color:"secondary",startIcon:r.a.createElement(ue.a,null),style:{margin:10},onClick:a},"Print  "),r.a.createElement("div",{style:{textAlign:"center",height:0,overflowY:"scroll"}},r.a.createElement(Oe,{ref:t,DocNum:e.DocNum,toLocation:e.toLocation,qtyMoveList:e.qtyMoveList,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date})))}var qe=a(342),xe=a(89);function Le(e){return r.a.createElement(Ee.a,{display:"flex",alignItems:"center"},r.a.createElement(Ee.a,{width:"100%",mr:1},r.a.createElement(qe.a,Object.assign({variant:"determinate"},e))),r.a.createElement(Ee.a,{minWidth:35},r.a.createElement(xe.a,{variant:"body2",color:"textSecondary"},"".concat(Math.round(e.value),"%"))))}var Te=Object(g.a)({root:{width:"100%"}});function Pe(e){var t=Te(),a=Object(n.useState)(0),c=Object(l.a)(a,2),o=c[0],i=c[1];return Object(n.useEffect)((function(){var t=1,a=setInterval((function(){i((function(t){return t>=100?0:t+100/e.listLength})),t===e.listLength+1&&(clearInterval(a),alert("\u0e22\u0e49\u0e32\u0e22\u0e02\u0e49\u0e2d\u0e21\u0e39\u0e25\u0e2a\u0e33\u0e40\u0e23\u0e47\u0e08"),e.handleProcessSuccess(!1)),t+=1}),1200);return function(){clearInterval(a)}}),[]),r.a.createElement("div",{className:t.root},r.a.createElement(Le,{value:o}))}function Ie(e){var t=Object(g.a)((function(e){return{paper:{position:"absolute",width:"80%",backgroundColor:e.palette.background.paper,border:"2px solid #000",boxShadow:e.shadows[5],padding:e.spacing(2,4,3),margin:"5%"}}}))();return r.a.createElement("div",{className:t.paper},r.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},r.a.createElement(s.a,{container:!0,spacing:3,style:{textAlign:"center"}},r.a.createElement(s.a,{item:!0,xs:4,style:{textAlign:"center"}},"  \u0e40\u0e25\u0e02\u0e40\u0e2d\u0e01\u0e2a\u0e32\u0e23:",e.docNum),r.a.createElement(s.a,{item:!0,xs:4,style:{textAlign:"center"}},"  Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07:",e.toLocation),r.a.createElement(s.a,{item:!0,xs:4,style:{textAlign:"center"}},"  \u0e17\u0e33\u0e01\u0e32\u0e23\u0e22\u0e49\u0e32\u0e22 Location ",e.qtyMoveList.length," \u0e23\u0e32\u0e22\u0e01\u0e32\u0e23")),r.a.createElement(s.a,{container:!0,spacing:3,style:{textAlign:"center"}},r.a.createElement(s.a,{item:!0,xs:12,style:{textAlign:"center"}},r.a.createElement(Pe,{listLength:e.qtyMoveList.length,handleProcessSuccess:e.handleProcessSuccess}))),r.a.createElement(s.a,{container:!0,spacing:3,style:{textAlign:"center"}},r.a.createElement(s.a,{item:!0,xs:12,style:{textAlign:"center"}}))))}var Re=function(e){var t=Object(n.useState)(),a=Object(l.a)(t,2),c=a[0],o=a[1],m=Object(n.useState)([]),g=Object(l.a)(m,2),h=g[0],_=g[1],E=Object(n.useState)(""),b=Object(l.a)(E,2),v=b[0],S=b[1],j=Object(n.useState)(!1),O=Object(l.a)(j,2),w=O[0],q=O[1],x=Object(n.useState)(!1),L=Object(l.a)(x,2),T=L[0],P=L[1];Object(n.useEffect)((function(){q(!1)}),[T]);var I=r.a.createElement("div",null,r.a.createElement(Ie,{docNum:v,toLocation:c,qtyMoveList:h,handleProcessSuccess:function(t){q(!1),P(t),e.setPageState(t)}}));return r.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},r.a.createElement("div",null,r.a.createElement(d.a,{open:w,onClose:function(){q(!1)},"aria-labelledby":"simple-modal-title","aria-describedby":"simple-modal-description"},I)),r.a.createElement(s.a,{container:!0,spacing:3,style:{textAlign:"center"}},r.a.createElement(p,{handleScanTag:function(e){y.get("module/API_QuantityMove/data.php?load=SearchTagDetail&tag_id=".concat(e)).then((function(e){var t=e.data;e.data.length>0?_((function(e){return[].concat(Object(u.a)(e),[{id:t[0].id,lot:t[0].lot,loc:t[0].loc,item:t[0].item,qty1:t[0].qty1,u_m:t[0].u_m}])})):alert("\u0e44\u0e21\u0e48\u0e1e\u0e1a Tags")}))},handleToLocation:function(e){o(e)},DocNum:e.DocNum,STS_qty_move_hdr_loc:e.STS_qty_move_hdr_loc,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date,PageState:e.PageState,qtyMoveList:h}),r.a.createElement(me,{qtyMoveList:e.PageState?h:e.STS_qty_move_line}),r.a.createElement("div",{style:{width:"100%",padding:15}},e.PageState?r.a.createElement(f.a,{variant:"contained",color:"primary",startIcon:r.a.createElement(ue.a,null),style:{margin:10},onClick:function(){c?(q(!0),y.get("module/API_QuantityMove/data.php?load=moveqty_create_hdr&toLoc=".concat(c)).then((function(e){var t=e.data;if(S(t.doc_num),o(t.loc),h.length>0)var a=1,n=setInterval((function(){y.get("module/API_QuantityMove/data.php?load=moveqty_create_line&docnum=".concat(t.doc_num,"&docline=").concat(a,"&tagnum=").concat(h[a-1].id,"&toLoc=").concat(c)).then((function(e){console.log("Call API moveqty_create_line")})),a===h.length&&(clearInterval(n),_([])),a+=1}),1e3)}))):(alert("\u0e01\u0e23\u0e38\u0e13\u0e32\u0e01\u0e23\u0e2d\u0e01 location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07"),q(!1))}},"Save  "):r.a.createElement(we,{DocNum:e.DocNum,toLocation:e.STS_qty_move_hdr_loc,qtyMoveList:e.STS_qty_move_line,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date}))))};function Ne(e){return r.a.createElement(h.a,null,r.a.createElement(O.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:le,title:"Document List",columns:[{title:"Doc num",field:"doc_num"},{title:"date",field:"create_date.date",type:"date"},{title:"To location",field:"loc"}],onRowClick:function(t,a){var n;n=a,e.handleDocNum(n.doc_num),e.handleSTS_qty_move_hdr_loc(n.loc),e.handleSTS_qty_move_hdr_date(n.create_date.date),y.get("module/API_QuantityMove/data.php?load=STS_qty_move_line&doc_num=".concat(n.doc_num)).then((function(t){console.log(t.data),e.handleSTS_qty_move_line(t.data)}))},data:e.STS_qty_move_hrd,options:{search:!1,paging:!1,maxBodyHeight:"68vh",minBodyHeight:"68vh"}}))}var Me=function(){var e=Object(n.useState)(!1),t=Object(l.a)(e,2),a=t[0],c=t[1],o=Object(n.useState)(!0),u=Object(l.a)(o,2),d=u[0],f=u[1],g=Object(n.useState)(""),h=Object(l.a)(g,2),_=h[0],E=h[1],b=Object(n.useState)(""),v=Object(l.a)(b,2),S=v[0],p=v[1],j=Object(n.useState)(""),O=Object(l.a)(j,2),w=O[0],q=O[1],x=Object(n.useState)([]),L=Object(l.a)(x,2),T=L[0],P=L[1],I=Object(n.useState)([]),R=Object(l.a)(I,2),N=R[0],M=R[1];return Object(n.useEffect)((function(){y.get("module/API_QuantityMove/data.php?load=STS_qty_move_hrd").then((function(e){M(e.data)})),console.log("555555555555555"),console.log(window.location.host)}),[a]),r.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},r.a.createElement(s.a,{container:!0,spacing:3},r.a.createElement(s.a,{item:!0,xs:a?2:5,hidden:!!a,style:{textAlign:"center"}},r.a.createElement(Ne,{STS_qty_move_hrd:N,handleDocNum:function(e){return E(e)},handleSTS_qty_move_hdr_loc:function(e){return p(e)},handleSTS_qty_move_hdr_date:function(e){q(e)},handleSTS_qty_move_line:function(e){return P(e)}})),r.a.createElement(s.a,{item:!0,xs:a?12:7},r.a.createElement(m.a,{checked:a,onChange:function(){return c((function(e){return!e}))}}),a?"Create":"View",r.a.createElement(m.a,{checked:d,onChange:function(){return f((function(e){return!e}))}}),d?"172.18.1.194":"61.90.156.165",r.a.createElement(Re,{PageState:a,DocNum:_,STS_qty_move_hdr_loc:S,STS_qty_move_hdr_date:w,STS_qty_move_line:T,setPageState:function(e){c(e)}}))))};Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));o.a.render(r.a.createElement(r.a.StrictMode,null,r.a.createElement(Me,null)),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(e){e.unregister()})).catch((function(e){console.error(e.message)}))}},[[388,1,2]]]);
//# sourceMappingURL=main.9bf7bf40.chunk.js.map
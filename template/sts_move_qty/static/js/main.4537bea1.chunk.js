(this.webpackJsonpsts_delivery_note=this.webpackJsonpsts_delivery_note||[]).push([[0],{389:function(e,t,a){e.exports=a(503)},394:function(e,t,a){},395:function(e,t,a){},503:function(e,t,a){"use strict";a.r(t);var n=a(0),c=a.n(n),r=a(16),l=a.n(r),o=(a(394),a(27)),i=(a(395),a(533)),m=a(534),d=a(530),s=a(380),u=a(202),f=a(337),g=a(336),h=a(190),E=a(306),_=a(537);function b(e){return c.a.createElement(_.a,{id:"combo-box-demo",options:e.selectValue,getOptionLabel:function(e){return e.title},style:{width:"100%",margin:10},onChange:function(t,a){console.log(a),a.title.length>0&&e.handleSelectValue(a.title)},renderInput:function(t){return c.a.createElement(E.a,Object.assign({},t,{label:e.label,variant:"outlined"}))},size:"small"})}var v=a(355),y=a.n(v).a.create({baseURL:"http://".concat(window.location.host,"/sts_web_center/")}),p=a(375),S=a.n(p),j=a(121),O=a.n(j),w=a(360),L=a.n(w),q=a(369),x=a.n(q),T=a(361),I=a.n(T),P=a(368),M=a.n(P),R=a(250),N=a.n(R),A=a(249),C=a.n(A),k=a(362),D=a.n(k),F=a(363),B=a.n(F),Q=a(365),V=a.n(Q),W=a(366),z=a.n(W),H=a(367),U=a.n(H),X=a(370),J=a.n(X),K=a(364),Y=a.n(K),$=a(244),G=a.n($),Z=a(371),ee=a.n(Z),te=a(372),ae=a.n(te),ne=a(373),ce=a.n(ne),re=a(374),le=a.n(re),oe={Add:Object(n.forwardRef)((function(e,t){return c.a.createElement(L.a,Object.assign({},e,{ref:t}))})),Check:Object(n.forwardRef)((function(e,t){return c.a.createElement(I.a,Object.assign({},e,{ref:t}))})),Clear:Object(n.forwardRef)((function(e,t){return c.a.createElement(C.a,Object.assign({},e,{ref:t}))})),Delete:Object(n.forwardRef)((function(e,t){return c.a.createElement(D.a,Object.assign({},e,{ref:t}))})),DetailPanel:Object(n.forwardRef)((function(e,t){return c.a.createElement(N.a,Object.assign({},e,{ref:t}))})),Edit:Object(n.forwardRef)((function(e,t){return c.a.createElement(B.a,Object.assign({},e,{ref:t}))})),Export:Object(n.forwardRef)((function(e,t){return c.a.createElement(Y.a,Object.assign({},e,{ref:t}))})),Filter:Object(n.forwardRef)((function(e,t){return c.a.createElement(V.a,Object.assign({},e,{ref:t}))})),FirstPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(z.a,Object.assign({},e,{ref:t}))})),LastPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(U.a,Object.assign({},e,{ref:t}))})),NextPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(N.a,Object.assign({},e,{ref:t}))})),PreviousPage:Object(n.forwardRef)((function(e,t){return c.a.createElement(M.a,Object.assign({},e,{ref:t}))})),ResetSearch:Object(n.forwardRef)((function(e,t){return c.a.createElement(C.a,Object.assign({},e,{ref:t}))})),Search:Object(n.forwardRef)((function(e,t){return c.a.createElement(G.a,Object.assign({},e,{ref:t}))})),SortArrow:Object(n.forwardRef)((function(e,t){return c.a.createElement(x.a,Object.assign({},e,{ref:t}))})),ThirdStateCheck:Object(n.forwardRef)((function(e,t){return c.a.createElement(J.a,Object.assign({},e,{ref:t}))})),ViewColumn:Object(n.forwardRef)((function(e,t){return c.a.createElement(ee.a,Object.assign({},e,{ref:t}))})),PrintIcon:Object(n.forwardRef)((function(e,t){return c.a.createElement(ae.a,Object.assign({},e,{ref:t}))})),FormatListNumberedIcon:Object(n.forwardRef)((function(e,t){return c.a.createElement(ce.a,Object.assign({},e,{ref:t}))})),CropFreeIcon:Object(n.forwardRef)((function(e,t){return c.a.createElement(le.a,Object.assign({},e,{ref:t}))}))},ie=Object(g.a)({root:{width:"100%",margin:10},textField:{margin:5,width:"100%",padding:0},CheckLocationModal:{width:"50%",margin:50}});var me=function(e){var t=ie(),a=Object(n.useState)([]),r=Object(o.a)(a,2),l=r[0],i=r[1],m=Object(n.useState)([]),s=Object(o.a)(m,2),g=s[0],_=s[1],v=Object(n.useState)(!1),p=Object(o.a)(v,2),j=p[0],w=p[1];Object(n.useEffect)((function(){y.get("module/API_QuantityMove/data.php?load=location_mst").then((function(e){var t=e.data.map((function(e){return{title:e.loc}}));i(t)})),y.get("module/API_QuantityMove/data.php?load=wc_mst").then((function(e){var t=e.data.map((function(e){return{title:e.wc}}));console.log(t),_(t)}))}),[]);var L=c.a.createElement("div",{style:{width:"85%",margin:"5%"}},c.a.createElement(h.a,null,c.a.createElement(O.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:oe,title:"\u0e08\u0e33\u0e19\u0e27\u0e19 "+e.ItemLoc.length+" \u0e23\u0e32\u0e22\u0e01\u0e32\u0e23",columns:[{title:"item",field:"item",width:"400"},{title:"description",field:"description",width:"400"},{title:"\u0e08\u0e33\u0e19\u0e27\u0e19\u0e21\u0e31\u0e14(Lot)",field:"countlot",type:"numeric"},{title:"\u0e40\u0e2a\u0e49\u0e19/\u0e21\u0e31\u0e14",field:"Uf_pack",type:"numeric"},{title:"\u0e23\u0e27\u0e21",field:"sumqty",type:"numeric"}],data:e.ItemLoc,options:{search:!1,paging:!1,maxBodyHeight:"68vh",minBodyHeight:"68vh"}})));return c.a.createElement(h.a,{className:t.root},c.a.createElement("div",null,c.a.createElement(u.a,{open:j,onClose:function(){w(!1)},"aria-labelledby":"simple-modal-title","aria-describedby":"simple-modal-description"},L)),c.a.createElement(d.a,{container:!0,alignItems:"center",direction:"row",justify:"space-between",spacing:0},e.PageState?c.a.createElement(d.a,{container:!0,alignItems:"center",direction:"row",justify:"space-between",spacing:0},c.a.createElement(d.a,{item:!0,md:2,container:!0},c.a.createElement(b,{label:"Work center",selectValue:g,handleSelectValue:e.handlew_c})),c.a.createElement(d.a,{item:!0,md:2,container:!0},c.a.createElement(b,{label:"Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07",selectValue:l,handleSelectValue:e.handleToLocation})),c.a.createElement(d.a,{item:!0,md:8,container:!0},c.a.createElement(E.a,{size:"small",label:"Scan tag",id:"tagScan",variant:"outlined",className:t.textField,onKeyUp:function(t){"Enter"===t.key&&(e.handleScanTag(t.target.value),document.getElementById("tagScan").value="")}}))):c.a.createElement(c.a.Fragment,null,c.a.createElement(d.a,{item:!0,md:3,container:!0},c.a.createElement(E.a,{size:"small",label:"Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07",variant:"outlined",className:t.textField,value:e.STS_qty_move_hdr_loc})),c.a.createElement(d.a,{item:!0,md:2,container:!0},c.a.createElement(f.a,{variant:"contained",color:"primary",startIcon:c.a.createElement(S.a,null),style:{margin:10,fontSize:7.8},disabled:!e.STS_qty_move_hdr_loc,onClick:function(){w(!0)}}," item Location")),c.a.createElement(d.a,{item:!0,md:3,container:!0},c.a.createElement(E.a,{size:"small",label:"Document ID",variant:"outlined",className:t.textField,value:e.DocNum})),c.a.createElement(d.a,{item:!0,md:4,container:!0},c.a.createElement(E.a,{size:"small",label:"Date",variant:"outlined",className:t.textField,value:e.STS_qty_move_hdr_date})))))},de=a(532),se=a(112),ue=Object(g.a)({root:{padding:10,width:"99%",margin:10}});var fe=function(e){var t=ue(),a=Object(se.a)({overrides:{MuiTableCell:{root:{padding:"5px 5px"}}}});return c.a.createElement(h.a,{className:t.root},c.a.createElement(de.a,{theme:a},c.a.createElement(O.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:oe,title:"Quantity Move List : "+e.qtyMoveList.length+" \u0e23\u0e32\u0e22\u0e01\u0e32\u0e23",columns:[{title:"id",field:"id"},{title:"lot",field:"lot",width:200},{title:"From loc",field:"loc",width:100},{title:"item",field:"item",width:300},{title:"qty",field:"qty1",type:"numeric"},{title:"unit",field:"u_m"}],data:e.qtyMoveList,options:{search:!1,paging:!1,maxBodyHeight:"45vh",minBodyHeight:"45vh"}})))},ge=a(151),he=a.n(ge),Ee=a(376),_e=a(377),be=a(381),ve=a(379),ye=a(378),pe=a(236),Se=a(344),je=a(323),Oe=a(318),we=a(535),Le=a(341),qe=a(324),xe=function(e){Object(be.a)(a,e);var t=Object(ve.a)(a);function a(){return Object(Ee.a)(this,a),t.apply(this,arguments)}return Object(_e.a)(a,[{key:"render",value:function(){var e=this.props.qtyMoveList.reduce((function(e,t){return e+t.qty1}),0);return c.a.createElement(i.a,null,c.a.createElement(i.a,{maxWidth:"lg",style:{paddingTop:50,width:"99%"}},c.a.createElement(d.a,{container:!0},c.a.createElement(d.a,{item:!0,xs:12,style:{textAlign:"center"}},c.a.createElement(pe.a,{border:1},c.a.createElement("p",null,"\u0e23\u0e32\u0e22\u0e07\u0e32\u0e19\u0e01\u0e32\u0e23\u0e22\u0e49\u0e32\u0e22 Item Location"))),c.a.createElement(d.a,{item:!0,xs:12},c.a.createElement(pe.a,{border:1,paddingLeft:2},c.a.createElement("p",null,"Document :  ",this.props.DocNum),c.a.createElement("p",null,"Location Destination :  ",this.props.toLocation),c.a.createElement("p",null,"\u0e40\u0e27\u0e25\u0e32 : ",this.props.STS_qty_move_hdr_date))),c.a.createElement(d.a,{item:!0,xs:12},c.a.createElement(pe.a,{border:1},c.a.createElement(we.a,{component:h.a},c.a.createElement(Se.a,{"aria-label":"simple table",size:"small"},c.a.createElement(Le.a,null,c.a.createElement(qe.a,null,c.a.createElement(Oe.a,{align:"right"},"#"),c.a.createElement(Oe.a,{align:"center"},"lot"),c.a.createElement(Oe.a,{align:"center"},"From\xa0Location"),c.a.createElement(Oe.a,{align:"center"},"item"),c.a.createElement(Oe.a,{align:"center"},"\u0e40\u0e2a\u0e49\u0e19/\u0e21\u0e31\u0e14"))),c.a.createElement(je.a,null,this.props.qtyMoveList.filter((function(e){return e.qty1>1})).map((function(e,t){return c.a.createElement(qe.a,{key:e.id},c.a.createElement(Oe.a,{align:"right"},t+1),c.a.createElement(Oe.a,{align:"right"},e.lot),c.a.createElement(Oe.a,{align:"center"},e.fromloc),c.a.createElement(Oe.a,{align:"right"},e.item),c.a.createElement(Oe.a,{align:"right"},e.qty1))})),c.a.createElement(qe.a,null,c.a.createElement(Oe.a,{colSpan:3}),c.a.createElement(Oe.a,null,"total"),c.a.createElement(Oe.a,{align:"right"},e))))))))))}}]),a}(c.a.Component);function Te(e){var t=Object(n.useRef)(),a=Object(ye.useReactToPrint)({content:function(){return t.current}});return c.a.createElement(c.a.Fragment,null,c.a.createElement(f.a,{variant:"contained",color:"secondary",startIcon:c.a.createElement(he.a,null),style:{margin:10},onClick:a},"Print  "),c.a.createElement(f.a,{variant:"contained",color:"primary",startIcon:c.a.createElement(he.a,null),style:{margin:10}},"\u0e23\u0e32\u0e22\u0e07\u0e32\u0e19\u0e1b\u0e23\u0e30\u0e08\u0e33\u0e27\u0e31\u0e19  "),c.a.createElement("div",{style:{textAlign:"center",height:0,overflowY:"scroll"}},c.a.createElement(xe,{ref:t,DocNum:e.DocNum,toLocation:e.toLocation,qtyMoveList:e.qtyMoveList,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date})))}var Ie=a(343),Pe=a(90);function Me(e){return c.a.createElement(pe.a,{display:"flex",alignItems:"center"},c.a.createElement(pe.a,{width:"100%",mr:1},c.a.createElement(Ie.a,Object.assign({variant:"determinate"},e))),c.a.createElement(pe.a,{minWidth:35},c.a.createElement(Pe.a,{variant:"body2",color:"textSecondary"},"".concat(Math.round(e.value),"%"))))}var Re=Object(g.a)({root:{width:"100%"}});function Ne(e){var t=Re(),a=Object(n.useState)(0),r=Object(o.a)(a,2),l=r[0],i=r[1];return Object(n.useEffect)((function(){var t=1,a=setInterval((function(){i((function(t){return t>=100?0:t+100/e.listLength})),t===e.listLength+1&&(clearInterval(a),alert("\u0e22\u0e49\u0e32\u0e22\u0e02\u0e49\u0e2d\u0e21\u0e39\u0e25\u0e2a\u0e33\u0e40\u0e23\u0e47\u0e08"),e.handleProcessSuccess(!1)),t+=1}),1200);return function(){clearInterval(a)}}),[]),c.a.createElement("div",{className:t.root},c.a.createElement(Me,{value:l}))}function Ae(e){var t=Object(g.a)((function(e){return{paper:{position:"absolute",width:"80%",backgroundColor:e.palette.background.paper,border:"2px solid #000",boxShadow:e.shadows[5],padding:e.spacing(2,4,3),margin:"5%"}}}))();return c.a.createElement("div",{className:t.paper},c.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},c.a.createElement(d.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(d.a,{item:!0,xs:4,style:{textAlign:"center"}},"  \u0e40\u0e25\u0e02\u0e40\u0e2d\u0e01\u0e2a\u0e32\u0e23:",e.docNum),c.a.createElement(d.a,{item:!0,xs:4,style:{textAlign:"center"}},"  Location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07:",e.toLocation),c.a.createElement(d.a,{item:!0,xs:4,style:{textAlign:"center"}},"  \u0e17\u0e33\u0e01\u0e32\u0e23\u0e22\u0e49\u0e32\u0e22 Location ",e.qtyMoveList.length," \u0e23\u0e32\u0e22\u0e01\u0e32\u0e23")),c.a.createElement(d.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(d.a,{item:!0,xs:12,style:{textAlign:"center"}},c.a.createElement(Ne,{listLength:e.qtyMoveList.length,handleProcessSuccess:e.handleProcessSuccess}))),c.a.createElement(d.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(d.a,{item:!0,xs:12,style:{textAlign:"center"}}))))}var Ce=function(e){var t=Object(n.useState)(),a=Object(o.a)(t,2),r=a[0],l=a[1],m=Object(n.useState)(""),g=Object(o.a)(m,2),h=g[0],E=g[1],_=Object(n.useState)([]),b=Object(o.a)(_,2),v=b[0],p=b[1],S=Object(n.useState)(""),j=Object(o.a)(S,2),O=j[0],w=j[1],L=Object(n.useState)(!1),q=Object(o.a)(L,2),x=q[0],T=q[1],I=Object(n.useState)(!1),P=Object(o.a)(I,2),M=P[0],R=P[1];Object(n.useEffect)((function(){T(!1)}),[M]);var N=c.a.createElement("div",null,c.a.createElement(Ae,{docNum:O,toLocation:r,qtyMoveList:v,handleProcessSuccess:function(t){T(!1),R(t),e.setPageState(t)}}));return c.a.createElement(i.a,{maxWidth:"lg",style:{padding:5}},c.a.createElement("div",null,c.a.createElement(u.a,{open:x,onClose:function(){T(!1)},"aria-labelledby":"simple-modal-title","aria-describedby":"simple-modal-description"},N)),c.a.createElement(d.a,{container:!0,spacing:3,style:{textAlign:"center"}},c.a.createElement(me,{handleScanTag:function(e){y.get("module/API_QuantityMove/data.php?load=SearchTagDetail&tag_id=".concat(e)).then((function(e){var t=e.data;e.data.length>0?p((function(e){return[].concat(Object(s.a)(e),[{id:t[0].id,lot:t[0].lot,loc:t[0].loc,item:t[0].item,qty1:t[0].qty1,u_m:t[0].u_m}])})):alert("\u0e44\u0e21\u0e48\u0e1e\u0e1a Tags")}))},handleToLocation:function(e){l(e)},handlew_c:function(e){E(e)},DocNum:e.DocNum,STS_qty_move_hdr_loc:e.STS_qty_move_hdr_loc,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date,PageState:e.PageState,qtyMoveList:v,ItemLoc:e.ItemLoc}),c.a.createElement(fe,{qtyMoveList:e.PageState?v:e.STS_qty_move_line}),c.a.createElement("div",{style:{width:"100%",padding:15}},e.PageState?c.a.createElement(f.a,{variant:"contained",color:"primary",startIcon:c.a.createElement(he.a,null),style:{margin:10},onClick:function(){r&&0!=v.length?(T(!0),y.get("module/API_QuantityMove/data.php?load=moveqty_create_hdr&toLoc=".concat(r,"&w_c=").concat(h)).then((function(e){var t=e.data;if(w(t.doc_num),l(t.loc),v.length>0)var a=1,n=setInterval((function(){y.get("module/API_QuantityMove/data.php?load=moveqty_create_line&docnum=".concat(t.doc_num,"&docline=").concat(a,"&tagnum=").concat(v[a-1].id,"&toLoc=").concat(r)).then((function(e){console.log("Call API moveqty_create_line")})),a===v.length&&(clearInterval(n),p([])),a+=1}),1e3)}))):(alert("\u0e01\u0e23\u0e38\u0e13\u0e32\u0e01\u0e23\u0e2d\u0e01 location \u0e1b\u0e25\u0e32\u0e22\u0e17\u0e32\u0e07 \u0e2b\u0e23\u0e37\u0e2d scan barcode \u0e2d\u0e22\u0e48\u0e32\u0e07\u0e19\u0e49\u0e2d\u0e22 1 lot"),T(!1))}},"Save  "):c.a.createElement(c.a.Fragment,null,c.a.createElement(Te,{DocNum:e.DocNum,toLocation:e.STS_qty_move_hdr_loc,qtyMoveList:e.STS_qty_move_line,STS_qty_move_hdr_date:e.STS_qty_move_hdr_date})))))};function ke(e){var t=Object(se.a)({overrides:{MuiTableCell:{root:{padding:"10px 15px"}}}});return c.a.createElement(h.a,null,c.a.createElement(de.a,{theme:t},c.a.createElement(O.a,{style:{width:"100%",margin:5,overflowX:"scroll"},icons:oe,title:"\u0e23\u0e32\u0e22\u0e07\u0e32\u0e19\u0e01\u0e32\u0e23\u0e22\u0e49\u0e32\u0e22 Item",columns:[{title:"Doc num",field:"doc_num"},{title:"date",field:"create_date.date",type:"date"},{title:"To location",field:"loc"}],onRowClick:function(t,a){var n;console.log(t),n=a,e.handleDocNum(n.doc_num),e.handleSTS_qty_move_hdr_loc(n.loc),e.handleSTS_qty_move_hdr_date(n.create_date.date),y.get("module/API_QuantityMove/data.php?load=STS_qty_move_line&doc_num=".concat(n.doc_num)).then((function(t){e.handleSTS_qty_move_line(t.data)})),y.get("module/API_QuantityMove/data.php?load=checkItemLotLoc&loc=".concat(n.loc)).then((function(t){console.log(t.data),e.handlecheckItemLotLoc(t.data)}))},data:e.STS_qty_move_hrd,options:{actionsColumnIndex:-1,search:!1,paging:!1,maxBodyHeight:"68vh",minBodyHeight:"68vh",filtering:!0}})))}var De=function(){var e=Object(n.useState)(!1),t=Object(o.a)(e,2),a=t[0],r=t[1],l=Object(n.useState)(""),s=Object(o.a)(l,2),u=s[0],f=s[1],h=Object(n.useState)(""),E=Object(o.a)(h,2),_=E[0],b=E[1],v=Object(n.useState)(""),p=Object(o.a)(v,2),S=p[0],j=p[1],O=Object(n.useState)([]),w=Object(o.a)(O,2),L=w[0],q=w[1],x=Object(n.useState)([]),T=Object(o.a)(x,2),I=T[0],P=T[1],M=Object(n.useState)([]),R=Object(o.a)(M,2),N=R[0],A=R[1],C=Object(g.a)({MainContainer:{padding:5}});Object(n.useEffect)((function(){y.get("module/API_QuantityMove/data.php?load=STS_qty_move_hrd").then((function(e){P(e.data)}))}),[a]);var k=C();return c.a.createElement(i.a,{maxWidth:"lg",className:k.MainContainer},c.a.createElement(d.a,{container:!0,spacing:3},c.a.createElement(d.a,{item:!0,xs:a?2:5,hidden:!!a,style:{textAlign:"center"}},"\u0e22\u0e49\u0e32\u0e22\u0e42\u0e14\u0e22\u0e43\u0e0a\u0e49\u0e23\u0e16 / \u0e22\u0e49\u0e32\u0e22\u0e02\u0e2d\u0e07\u0e1c\u0e25\u0e34\u0e15 / \u0e22\u0e49\u0e32\u0e22\u0e02\u0e2d\u0e07\u0e20\u0e32\u0e22\u0e43\u0e19",c.a.createElement(ke,{STS_qty_move_hrd:I,handleDocNum:function(e){return f(e)},handleSTS_qty_move_hdr_loc:function(e){return b(e)},handleSTS_qty_move_hdr_date:function(e){j(e)},handleSTS_qty_move_line:function(e){return q(e)},handlecheckItemLotLoc:function(e){return A(e)}})),c.a.createElement(d.a,{item:!0,xs:a?12:7},c.a.createElement(m.a,{checked:a,onChange:function(){return r((function(e){return!e}))}}),a?"Create":"View",c.a.createElement(Ce,{PageState:a,DocNum:u,STS_qty_move_hdr_loc:_,STS_qty_move_hdr_date:S,STS_qty_move_line:L,setPageState:function(e){r(e)},ItemLoc:N}))))};Boolean("localhost"===window.location.hostname||"[::1]"===window.location.hostname||window.location.hostname.match(/^127(?:\.(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}$/));l.a.render(c.a.createElement(c.a.StrictMode,null,c.a.createElement(De,null)),document.getElementById("root")),"serviceWorker"in navigator&&navigator.serviceWorker.ready.then((function(e){e.unregister()})).catch((function(e){console.error(e.message)}))}},[[389,1,2]]]);
//# sourceMappingURL=main.4537bea1.chunk.js.map
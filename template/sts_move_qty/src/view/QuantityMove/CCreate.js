import React, { useState, useEffect } from 'react';
import { Container, Button, Modal } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';
import CGroupTextBoxs from './CGroupTextBoxs';
import CMatTable from './CMatTable';
import SaveIcon from '@material-ui/icons/Save';
import { CPrintDocument } from './CPrintDocument';
import API from '../../../../../components/API';

import ModalProgressSaving from './ModalProgressSaving';

function CCreate(props) {
  const [toLocation, setToLocation] = useState()
  const [w_c, setw_c] = useState("")
  const [qtyMoveList, setQtyMoveList] = useState([]);
  const [docNum, setdocNum] = useState("")
  const [openModal, setOpenModal] = useState(false);
  const [ProcessSuccess, setProcessSuccess] = useState(false)
  const handleToLocation = (location) => { setToLocation(location) }
  const handlew_c = (work_center) => {
    setw_c(work_center)
    // console.log(work_center);
    // localStorage.setItem('w_c',work_center) 
    // console.log(localStorage.w_c);

  }
  const handleClose = () => { setOpenModal(false); };
  const handleProcessSuccess = (ProcessSuccess) => {
    setOpenModal(false);
    setProcessSuccess(ProcessSuccess);
    props.setPageState(ProcessSuccess)
  };


  useEffect(() => {
    setOpenModal(false)
  }, [ProcessSuccess])


  const removeDuplicatesFromArrayByProperty = (arr, prop) => arr.reduce((accumulator, currentValue) => {
    if(!accumulator.find(obj => obj[prop] === currentValue[prop])){
      accumulator.push(currentValue);
    }
    return accumulator;
  }, [])

  const handleScanTag = (scanTag) => {
    API.get(`API_QuantityMove/data.php?load=SearchTagDetail&tag_id=${scanTag}`)
      .then(res => {
        const items = res.data
        if (res.data.length > 0) {
          console.log(qtyMoveList)
          
          setQtyMoveList(qtyMoveList => [...qtyMoveList, { id: items[0].id, lot: items[0].lot, loc: items[0].loc, item: items[0].item, qty1: items[0].qty1, u_m: items[0].u_m, }])
          removeDuplicatesFromArrayByProperty(qtyMoveList, 'id');
          setQtyMoveList(qtyMoveList => removeDuplicatesFromArrayByProperty(qtyMoveList, 'id'))

        } else {
          alert("ไม่พบ Tags")
        }
      })
  }

  const handleSubmit = () => {
    if (!toLocation || qtyMoveList.length === 0) {
      alert("กรุณากรอก location ปลายทาง หรือ scan barcode อย่างน้อย 1 lot")
      setOpenModal(false);
    } else {
      setOpenModal(true);
      //Insert QTY MOVE HEARDER
      API.get(`API_QuantityMove/data.php?load=moveqty_create_hdr&toLoc=${toLocation}&w_c=${w_c}`)
        .then(res => {
          const moveqty_hdr = res.data
          setdocNum(moveqty_hdr.doc_num)
          setToLocation(moveqty_hdr.loc)
          if (qtyMoveList.length > 0) {
            let i = 1;
            //Insert QTY LINE 
            const timer = setInterval(() => {
              API.get(`API_QuantityMove/data.php?load=moveqty_create_line&docnum=${moveqty_hdr.doc_num}&docline=${i}&tagnum=${qtyMoveList[i - 1].id}&toLoc=${toLocation}`)
                .then(res => {
                  console.log("Call API moveqty_create_line")
                })
              if (i === qtyMoveList.length) {
                clearInterval(timer)
                setQtyMoveList([])
                //setOpen(false);
              }
              i = i + 1;
            }, 1000);
          }
        })
    }
  }

  const body = (
    <div >
      <ModalProgressSaving
        docNum={docNum}
        toLocation={toLocation}
        qtyMoveList={qtyMoveList}
        handleProcessSuccess={handleProcessSuccess}
      />
    </div >
  );

  return (
    <Container maxWidth="lg" style={{ padding: 5, }}>
      <div>
        <Modal open={openModal} onClose={handleClose} aria-labelledby="simple-modal-title" aria-describedby="simple-modal-description" >
          {body}
        </Modal>
      </div>
      <Grid container spacing={3} style={{ textAlign: "center" }}>
        <CGroupTextBoxs
          handleScanTag={handleScanTag}
          handleToLocation={handleToLocation}
          handlew_c={handlew_c}
          DocNum={props.DocNum}
          STS_qty_move_hdr_loc={props.STS_qty_move_hdr_loc}
          STS_qty_move_hdr_date={props.STS_qty_move_hdr_date}
          PageState={props.PageState}
          qtyMoveList={qtyMoveList}
          ItemLoc={props.ItemLoc}
        />

        <CMatTable qtyMoveList={(props.PageState) ? qtyMoveList : props.STS_qty_move_line} />
        <div style={{ width: "100%", padding: 15 }}>
          {(props.PageState) ?
            <Button variant="contained" color="primary" startIcon={<SaveIcon />} style={{ margin: 10 }} onClick={handleSubmit} >Save  </Button> :
            <>
              <CPrintDocument
                DocNum={props.DocNum}
                toLocation={props.STS_qty_move_hdr_loc}
                qtyMoveList={props.STS_qty_move_line}
                STS_qty_move_hdr_date={props.STS_qty_move_hdr_date}
              />
              {/* <Button variant="contained" color="primary" startIcon={<SaveIcon />} style={{ margin: 10 }}  >รายงานประจำวัน  </Button> */}

            </>
          }
          {/* <Button variant="contained" color="default" startIcon={<DeleteIcon />} style={{ margin: 10 }} > Clear </Button> */}
        </div>
      </Grid>
    </Container>
  );
}

export default CCreate;

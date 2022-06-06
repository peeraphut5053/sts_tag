import React, { useState, useEffect } from 'react';
import './App.css';
import { Container, Switch } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';
import CCreate from './view/QuantityMove/CCreate';
import DocumentHearderList from './view/QuantityMove/DocumentHearderList';
import API from './view/QuantityMove/api';
import { makeStyles } from '@material-ui/core/styles';


function App() {
  const [PageState, setPageState] = useState(false)
  const toggleChecked = () => setPageState((prev) => !prev) //State Page Create or View Document
  const [DocNum, setDocNum] = useState("")
  const [STS_qty_move_hdr_loc, setSTS_qty_move_hdr_loc] = useState("")
  const [STS_qty_move_hdr_date, setSTS_qty_move_hdr_date] = useState("")
  const [STS_qty_move_line, setSTS_qty_move_line] = useState([])
  const [STS_qty_move_hrd, setSTS_qty_move_hrd] = useState([])
  const [ItemLoc, setItemLoc] = useState([])
  const handleDocNum = (DocNum) => setDocNum(DocNum) // Set Document Number
  const handleSTS_qty_move_hdr_loc = (loc) => setSTS_qty_move_hdr_loc(loc) //Set Location
  const handleSTS_qty_move_hdr_date = (date) => { setSTS_qty_move_hdr_date(date) } //Set Location
  const handleSTS_qty_move_line = (STS_qty_move_line) => setSTS_qty_move_line(STS_qty_move_line) //
  const handlecheckItemLotLoc = (ItemLoc) => setItemLoc(ItemLoc)
  const handleSetPageState = (pageState) => { setPageState(pageState)}

  const useStyles = makeStyles({
    MainContainer: {
      padding: 5
    }
  });

  useEffect(() => {
    API.get(`module/API_QuantityMove/data.php?load=STS_qty_move_hrd`)
      .then(res => {
        setSTS_qty_move_hrd(res.data)
      })
      // localStorage.setItem('w_c','') 
      // console.log(localStorage);
      // console.log(localStorage.w_c);
      
  }, [PageState])

  const classes = useStyles();
  return (
    <Container maxWidth="lg" className={classes.MainContainer}>
      <Grid container spacing={3}>
        <Grid item xs={(PageState) ? 2 : 5} hidden={(PageState) ? true : false} style={{ textAlign: "center" }}>
        ย้ายโดยใช้รถ / ย้ายของผลิต / ย้ายของภายใน
          <DocumentHearderList
            STS_qty_move_hrd={STS_qty_move_hrd}
            handleDocNum={handleDocNum}
            handleSTS_qty_move_hdr_loc={handleSTS_qty_move_hdr_loc}
            handleSTS_qty_move_hdr_date={handleSTS_qty_move_hdr_date}
            handleSTS_qty_move_line={handleSTS_qty_move_line}
            handlecheckItemLotLoc={handlecheckItemLotLoc}
          />
        </Grid>
        <Grid item xs={(PageState) ? 12 : 7}>
          {<Switch checked={PageState} onChange={toggleChecked} />}
          {(PageState) ? "Create" : "View"}
          <CCreate
            PageState={PageState}
            DocNum={DocNum}
            STS_qty_move_hdr_loc={STS_qty_move_hdr_loc}
            STS_qty_move_hdr_date={STS_qty_move_hdr_date}
            STS_qty_move_line={STS_qty_move_line}
            setPageState={handleSetPageState}
            ItemLoc={ItemLoc}
          />
        </Grid>
      </Grid>
    </Container>
  );
}
export default App;
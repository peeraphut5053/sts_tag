import React, { useState, useEffect } from 'react';
import { makeStyles } from '@material-ui/core/styles';

import Paper from '@material-ui/core/Paper';
import CardSelectShip from './component/CardSelectShip'
import CardSelectCar from './component/CardSelectCar'
import { Grid, Button } from '@material-ui/core';
import TextSelectDO from './component/TextSelectDO';
import MatTable from './component/MatTable';
import Axios from 'axios';

import SaveIcon from '@material-ui/icons/Save';
import DeleteIcon from '@material-ui/icons/Delete';
import DialogModal from './component/DialogModal'

const useStyles = makeStyles({
  root: {
    padding: 10,
    height: '92vh',
    width: '99%'
  },
});

function CreateNote() {
  const classes = useStyles();
  const [itemsLists, setItemsLists] = useState([])
  const [doNum, setDoNum] = useState("DB19120004") // DO number DB19120004

  

  useEffect(() => {
    Axios.get(`http://localhost/sts_web_center/module/RPT_DO_INVENTORY_DETAIL/data.php?do_num=${doNum}&sts_no=&load=ajax`)
      .then(res => {
        const do_line = res.data;
        const items = res.data
        setItemsLists(items)
        console.log(items)
        console.log(itemsLists)
      })
  }, [doNum])


  const handleSubmit = () => {

  }

  const handleDoNum = (value) => {
    console.log(value)
    setDoNum(value)
  }

  return (
    <Paper className={classes.root} >
      <Grid container alignItems="center" direction="row" justify="space-between" spacing={0} style={{ margin: 10 }}>
        <Grid item md={6} container  >
          {/* <CardSelectShip /> */}
          <DialogModal></DialogModal>
        </Grid>
        <Grid item md={6} container >
        <DialogModal></DialogModal>
          {/* <CardSelectCar /> */}
        </Grid>
        <Grid item md={12} container style={{ margin: 10 }} >
          <TextSelectDO
            handleDoNum={handleDoNum}
          />
        </Grid>
        <Grid item md={12} container style={{ margin: 5 }}  >
          <MatTable
            itemsLists={itemsLists}
          />
        </Grid>
      </Grid>




      <Grid item xs={12} style={{ textAlign: "center" }}>
        <Button
          variant="contained"
          color="primary"
          startIcon={<SaveIcon />}
          onClick={() => { handleSubmit() }}
        >
          Save
                </Button>
        <Button
          variant="contained"
          color="default"
          startIcon={<DeleteIcon />}
        >
          Clear
                </Button>
      </Grid>

      
    </Paper>
  );
}

export default CreateNote
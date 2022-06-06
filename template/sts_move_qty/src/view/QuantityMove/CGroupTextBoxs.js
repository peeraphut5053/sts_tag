import React, { useState, useEffect } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Paper from '@material-ui/core/Paper';
import { Grid, TextField, IconButton, InputBase, Divider, TableRow, TableCell } from '@material-ui/core';
import CAutocomplete from './CAutocomplete';
import API from './api';
import { Container, Button, Modal } from '@material-ui/core';
import SearchIcon from '@material-ui/icons/Search';
import FindInPageIcon from '@material-ui/icons/FindInPage';
import MaterialTable from 'material-table';
import tableIcons from './tableIcons'
import { CPrintDiaryReport } from './CPrintDiaryReport';




const useStyles = makeStyles({
    root: {
        // height: '92vh',
        width: '100%',
        margin: 10
    },
    textField: {
        margin: 5,
        width: "100%",
        padding: 0
    },
    CheckLocationModal: {
        width: '50%',
        margin: 50
    }
});


function CGroupTextBoxs(props) {
    const classes = useStyles();
    const [location, setLocation] = useState([])
    const [w_c, setw_c] = useState([])

    const [DairyReportCountLotByWC, SetDairyReportCountLotByWC] = useState([])
    const [DairyReportCountLotByWCDate, SetDairyReportCountLotByWCDate] = useState([])
    const [DairyReportLine, SetDairyReportLine] = useState([])



    const [openModal, setOpenModal] = useState(false);
    const [OpenDairyReportModal, setOpenDairyReportModal] = useState(false)
    const handleClose = () => { setOpenModal(false); };
    const handleDairyReportModalClose = () => { setOpenDairyReportModal(false); };


    useEffect(() => {
        API.get(`module/API_QuantityMove/data.php?load=location_mst`)
            .then(res => {
                let loc = res.data.map(item => {
                    return { title: item.loc }
                });
                setLocation(loc)
            })

        API.get(`module/API_QuantityMove/data.php?load=wc_mst`)
            .then(res => {

                let w_c = res.data.map(item => {
                    return { title: item.wc }
                });
                console.log(w_c)
                setw_c(w_c)
            })
    }, [])

    const handleScanTag = (event) => {
        if (event.key === 'Enter') {
            props.handleScanTag(event.target.value)
            document.getElementById('tagScan').value = ""
        }
    }


    const body = (
        <div style={{ width: '85%', margin: '5%' }} >
            <Paper >

                <MaterialTable
                    style={{ width: '100%', margin: 5, overflowX: "scroll" }}
                    icons={tableIcons}
                    title={"จำนวน " + props.ItemLoc.length + " รายการ"}
                    columns={[
                        { title: 'item', field: 'item', width: '400' },
                        { title: 'description', field: 'description', width: '400' },
                        { title: 'จำนวนมัด(Lot)', field: 'countlot', type: 'numeric' },
                        { title: 'เส้น/มัด', field: 'Uf_pack', type: 'numeric' },
                        { title: 'รวม', field: 'sumqty', type: 'numeric' },
                    ]}
                    data={props.ItemLoc}
                    options={{
                        search: false,
                        paging: false,
                        maxBodyHeight: '68vh',
                        minBodyHeight: '68vh',
                    }}
                />
            </Paper>
        </div >
    );

    const bodyDairyReport = (
        <div style={{ width: '97%', margin: '1%' }} >
            <Paper >
                <Grid container alignItems="center" direction="row" justify="space-between" spacing={0}>
                    <Grid item xs={3} container >
                        <MaterialTable
                            style={{ width: '100%', margin: 5, overflowX: "scroll" }}
                            icons={tableIcons}
                            title={"เลือก Work Center"}
                            columns={[
                                { title: 'work center', field: 'w_c', width: '400' },
                                { title: 'จำนวนทั้งหมด', field: 'totalLot', width: '400', type: 'numeric' },
                            ]}
                            data={DairyReportCountLotByWC}
                            options={{
                                search: false,
                                paging: false,
                                maxBodyHeight: '68vh',
                                minBodyHeight: '68vh',
                            }}
                            onRowClick={(event, rowData) => {
                                console.log(rowData)
                                API.get(`module/API_QuantityMove/data.php?load=DairyReportCountLotByWCDate&w_c=${rowData.w_c}`)
                                    .then(res => {
                                        let w_c = res.data.map(item => {
                                            return {
                                                w_c: item.w_c,
                                                date: item.date,
                                                totalPerday: item.totalPerday
                                            }
                                        });
                                        SetDairyReportCountLotByWCDate(w_c)
                                    })
                            }}
                        />
                    </Grid>
                    <Grid item xs={3} container >
                        <MaterialTable
                            style={{ width: '100%', margin: 5, overflowX: "scroll" }}
                            icons={tableIcons}
                            title={"เลือกวัน"}
                            columns={[
                                { title: 'work center', field: 'w_c', width: '400' },
                                { title: 'วัน', field: 'date', width: '400', type: "date" },
                                { title: 'total Lot Perday', field: 'totalPerday', type: 'numeric' },
                            ]}
                            data={DairyReportCountLotByWCDate}
                            options={{
                                search: false,
                                paging: false,
                                maxBodyHeight: '68vh',
                                minBodyHeight: '68vh',
                            }}

                            onRowClick={(event, rowData) => {
                                console.log(rowData)
                                API.get(`module/API_QuantityMove/data.php?load=DairyReportLine&w_c=${rowData.w_c}&date=${rowData.date}`)
                                    .then(res => {
                                        SetDairyReportLine(res.data)
                                    })
                            }}

                        />
                    </Grid>
                    <Grid item xs={6} container >
                        <MaterialTable
                            style={{ width: '100%', margin: 5, overflowX: "scroll" }}
                            icons={tableIcons}
                            title={"จำนวน" + DairyReportLine.length + "รายการ"}
                            columns={[
                                { title: 'doc_num', field: 'doc_num', },
                                { title: 'lot', field: 'lot', width: '400' },
                                { title: 'toloc', field: 'toloc', width: '400' },
                            ]}
                            data={DairyReportLine}
                            options={{
                                search: false,
                                paging: false,
                                maxBodyHeight: '68vh',
                                minBodyHeight: '68vh',
                            }}
                        />
                    </Grid>
                    <Grid item xs={12} container style={{ justifyContent: "center" }}>
                        <div style={{ textAlign: "center" }}>
                            <CPrintDiaryReport
                                DairyReportLine={DairyReportLine}
                                DairyReportCountLotByWCDate = {DairyReportCountLotByWCDate}
                            />
                        </div>

                    </Grid>
                </Grid>


            </Paper>
        </div >
    );




    const CheckLocationModal = () => {
        setOpenModal(true)
    }

    const DairyReportModal = () => {
        API.get(`module/API_QuantityMove/data.php?load=DairyReportCountLotByWC`)
            .then(res => {
                let w_c = res.data.map(item => {
                    return { w_c: item.w_c, totalLot: item.totalLot }
                });
                SetDairyReportCountLotByWC(w_c)
            })
        setOpenDairyReportModal(true)
    }


    return (
        <Paper className={classes.root} >
            <div>
                <Modal open={openModal} onClose={handleClose} aria-labelledby="simple-modal-title" aria-describedby="simple-modal-description" >
                    {body}
                </Modal>
                <Modal open={OpenDairyReportModal} onClose={handleDairyReportModalClose} aria-labelledby="simple-modal-title" aria-describedby="simple-modal-description" >
                    {bodyDairyReport}
                </Modal>
            </div>
            <Grid container alignItems="center" direction="row" justify="space-between" spacing={0}>
                {(props.PageState) ?
                    <Grid container alignItems="center" direction="row" justify="space-between" spacing={0}>
                        <Grid item md={2} container >
                            <CAutocomplete label={"Work center"} selectValue={w_c} handleSelectValue={props.handlew_c} />
                        </Grid>
                        <Grid item md={2} container >
                            <CAutocomplete label={"Location ปลายทาง"} selectValue={location} handleSelectValue={props.handleToLocation} />
                        </Grid>
                        <Grid item md={8} container >
                            <TextField size="small" label={"Scan tag"} id={"tagScan"} variant="outlined" className={classes.textField} onKeyUp={handleScanTag} />
                        </Grid>
                    </Grid>
                    :
                    <>
                        <Grid item md={3} container >
                            <TextField size="small" label={"Location ปลายทาง"} variant="outlined" className={classes.textField} value={props.STS_qty_move_hdr_loc} />
                        </Grid>
                        <Grid item md={2} container >
                            <Button variant="contained" color="primary" startIcon={<FindInPageIcon />}
                                style={{ margin: 10, fontSize: 7.8 }} disabled={(props.STS_qty_move_hdr_loc) ? false : true}
                                onClick={CheckLocationModal} > item Location
                            </Button>
                        </Grid>
                        <Grid item md={3} container >
                            <TextField size="small" label={"Document ID"} variant="outlined" className={classes.textField} value={props.DocNum} />
                        </Grid>
                        <Grid item md={4} container >
                            <TextField size="small" label={"Date"} variant="outlined" className={classes.textField} value={props.STS_qty_move_hdr_date} />
                        </Grid>
                        <Button variant="contained" color="primary" startIcon={<FindInPageIcon />}
                            style={{ margin: 10 }}
                            onClick={DairyReportModal} > รายงานประจำวัน
                            </Button>
                    </>
                    // CheckLocationModal
                }
            </Grid>
        </Paper>
    );
}

export default CGroupTextBoxs
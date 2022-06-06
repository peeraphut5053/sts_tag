import React, { useRef } from 'react';
import { useReactToPrint } from 'react-to-print';
import { Container, Button, Box, Table } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';
import SaveIcon from '@material-ui/icons/Save';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

class ComponentToPrint extends React.Component {
    render() {
        // const sumTotal = this.props.qtyMoveList.reduce((sum, number) => { return sum + number.qty1 }, 0)
        return (
            <Container >
                <Grid container >
                    <Grid item xs={12} style={{ textAlign: "center" }}>
                        จำนวนทั้งหมด {this.props.DairyReportLine.length} รายการ
                        <table border={1} width={"100%"}>
                            <tr>
                                <td>doc_num</td>
                                <td > lot</td>
                            </tr>
                            {this.props.DairyReportLine.map((items) =>
                                <tr key={items.lot}>
                                    <td>{items.doc_num}</td>
                                    <td>{items.lot}</td>
                                </tr>
                            )}

                        </table>


                    </Grid>
                </Grid>

                {/* 
                <Container maxWidth="lg" style={{ paddingTop: 50, width: "99%" }}  >
                    <Grid container >
                        <Grid item xs={12} style={{ textAlign: "center" }}>
                            <Box border={1}>
                                <p>
                                    รายงานการย้าย Item Location
                                </p>
                            </Box>
                        </Grid>
                        <Grid item xs={12}>
                            <Box border={1} paddingLeft={2}>
                                <p>Document :  {this.props.DocNum}</p>
                                <p>Location Destination :  {this.props.toLocation}</p>
                                <p>เวลา : {this.props.STS_qty_move_hdr_date}</p>
                            </Box>
                        </Grid>
                        <Grid item xs={12}>
                            <Box border={1} >
                                <TableContainer component={Paper}>
                                    <Table aria-label="simple table" size="small">
                                        <TableHead>
                                            <TableRow>
                                                <TableCell align="right">#</TableCell>
                                                <TableCell align="center">lot</TableCell>
                                                <TableCell align="center">From&nbsp;Location</TableCell>
                                                <TableCell align="center">item</TableCell>
                                                <TableCell align="center">เส้น/มัด</TableCell>
                                            </TableRow>
                                        </TableHead>
                                        <TableBody>
                                            {this.props.qtyMoveList

                                                .filter((row) => {
                                                    return row.qty1 > 1
                                                })
                                                .map((row, index) => (
                                                    <TableRow key={row.id}>
                                                        <TableCell align="right">{index + 1}</TableCell>
                                                        <TableCell align="right">{row.lot}</TableCell>
                                                        <TableCell align="center">{row.fromloc}</TableCell>
                                                        <TableCell align="right">{row.item}</TableCell>
                                                        <TableCell align="right">{row.qty1}</TableCell>
                                                    </TableRow>
                                                ))

                                            }
                                            <TableRow>
                                                <TableCell colSpan={3}></TableCell>
                                                <TableCell >total</TableCell>
                                                <TableCell align="right">{sumTotal}</TableCell>
                                            </TableRow>
                                        </TableBody>
                                    </Table>
                                </TableContainer>
                            </Box>
                        </Grid>
                    </Grid>
                </Container> */}

            </Container >

        );
    }
}

export function CPrintDiaryReport(props) {
    const componentRef = useRef();
    const handlePrint = useReactToPrint({
        content: () => componentRef.current,
    });
    return (
        <>
            <Button variant="contained" color="secondary" startIcon={<SaveIcon />} style={{ margin: 10 }} onClick={handlePrint} >Print  </Button>
            {/* <ComponentToPrint ref={componentRef} /> */}
            <div style={{ textAlign: "center", height: 0, overflowY: "scroll", }}>
                <ComponentToPrint
                    ref={componentRef}
                    DairyReportLine={props.DairyReportLine}
                    DairyReportCountLotByWCDate = {props.DairyReportCountLotByWCDate}
                />


            </div>
        </>
    );
};


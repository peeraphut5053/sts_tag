import React, { useState, useEffect } from 'react'
import { Container,  Box, Table } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';


import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import API from './api';


export default function PagePrintDocument(props) {

    const [DocNum, setDocNum] = useState("")
    const [STS_qty_move_line, setSTS_qty_move_line] = useState([])

    useEffect(() => {
        API.get(`module/API_QuantityMove/data.php?load=STS_qty_move_line&doc_num=${props.DocNum}`)
            .then(res => {
                console.log(0)
                console.log(res.data)
                setDocNum(props.DocNum)
                setSTS_qty_move_line(res.data)
                console.log(props.qtyMoveList)
            })
    }, [DocNum])



    return (
        <Container maxWidth="lg" style={{ paddingTop: 50, width: "99%" }}  >

            {props.DocNum}

            <Grid container >
                <Grid item xs={12} style={{ textAlign: "center" }}>
                    <Box border={1}>

                        **
                        {
                            STS_qty_move_line.map((row, index) => (
                                <p>{row.id}</p>
                            ))
                        }
                        **
                        <p>
                            Move Item QTY
                        </p>
                    </Box>
                </Grid>
                <Grid item xs={6}>
                    <Box border={1} paddingLeft={2}>
                        <p>Document : abc123456789</p>
                        <p>Location Destination : location 123456</p>
                        <p>เวลา : abc123456789</p>
                    </Box>
                </Grid>
                <Grid item xs={6}>
                    <Box border={1} paddingLeft={2}>
                        <p>Document : abc123456789</p>
                        <p>Location Destination : location 123456</p>
                        <p>เวลา : abc123456789</p>
                    </Box>
                </Grid>
                <Grid item xs={12}>
                    <Box border={1} >
                        <TableContainer component={Paper}>
                            <Table aria-label="simple table" size="small">
                                <TableHead>
                                    <TableRow>
                                        <TableCell align="right">#</TableCell>
                                        <TableCell align="right">lot</TableCell>
                                        <TableCell align="right">From&nbsp;Location</TableCell>
                                        <TableCell align="right">item</TableCell>
                                        <TableCell align="right">เส้น/มัด</TableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {STS_qty_move_line.map((row, index) => (
                                        <TableRow key={row.id}>
                                            <TableCell align="right">{index + 1}</TableCell>
                                            <TableCell align="right">{row.lot}</TableCell>
                                            <TableCell align="right">{row.fromloc}</TableCell>
                                            <TableCell align="right">{row.item}</TableCell>
                                            <TableCell align="right">{row.qty1}</TableCell>
                                        </TableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        </TableContainer>
                    </Box>
                </Grid>


            </Grid>
        </Container>
    )
}

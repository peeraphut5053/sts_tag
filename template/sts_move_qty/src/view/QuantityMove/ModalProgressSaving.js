import React from 'react';
import { Container } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';
import { makeStyles } from '@material-ui/core/styles';
import LinearProgressWithLabel from './LinearProgressWithLabel'


export default function ModalProgressSaving(props) {
    const useStyles = makeStyles((theme) => ({
        paper: {
            position: 'absolute',
            width: "80%",
            backgroundColor: theme.palette.background.paper,
            border: '2px solid #000',
            boxShadow: theme.shadows[5],
            padding: theme.spacing(2, 4, 3),
            margin: "5%"
        },
    }));

    const classes = useStyles();
    return (
        <div className={classes.paper}>
            <Container maxWidth="lg" style={{ padding: 5, }}>
                <Grid container spacing={3} style={{ textAlign: "center" }}>
                    <Grid item xs={4} style={{ textAlign: "center" }}>  เลขเอกสาร:{props.docNum}</Grid>
                    <Grid item xs={4} style={{ textAlign: "center" }}>  Location ปลายทาง:{props.toLocation}</Grid>
                    <Grid item xs={4} style={{ textAlign: "center" }}>  ทำการย้าย Location {props.qtyMoveList.length} รายการ</Grid>
                </Grid>
                <Grid container spacing={3} style={{ textAlign: "center" }}>
                    <Grid item xs={12} style={{ textAlign: "center" }}>
                        <LinearProgressWithLabel
                            listLength={props.qtyMoveList.length}
                            handleProcessSuccess={props.handleProcessSuccess}
                        />
                    </Grid>
                </Grid>
                <Grid container spacing={3} style={{ textAlign: "center" }}>
                    <Grid item xs={12} style={{ textAlign: "center" }}>
                        {/* <CPrintDocument /> */}
                    </Grid>
                </Grid>
            </Container >
        </div >
    )
}

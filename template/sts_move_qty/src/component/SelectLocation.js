import React, { useState } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import { Container, TextField, Typography, Button } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';
import AccountCircle from '@material-ui/icons/AccountCircle';

import CardSelect from './CardSelect';

import DirectionsBoatRoundedIcon from '@material-ui/icons/DirectionsBoatRounded';
import LocalShippingIcon from '@material-ui/icons/LocalShipping';


const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
        display: 'flex',
        flexWrap: 'wrap',
    },
    paper: {
        padding: theme.spacing(2),
        textAlign: 'center',
        color: theme.palette.text.secondary,
    },
    textField: {
        marginLeft: theme.spacing(1),
        marginRight: theme.spacing(1),
        width: '25ch',
    },
}));


function SelectLocation() {
    const classes = useStyles();
    const [value1, setValue1] = useState("asdf")
    const [Boat, setBoat] = useState("")
    const [Car, setCar] = useState("")


    const getBoatName = (LocationName) => {
        setBoat(LocationName)
    }
    const getCarName = (LocationName) => {
        setCar(LocationName)
    }



    return (
        <Grid container spacing={3}>
            <Grid item xs={12} style={{ height: "65vh" }}>
                <Grid style={{ textAlign: "Left" }} >
                    เลือก Location
                    </Grid>
                <Grid style={{ textAlign: "Left", height: 'auto' }} >
                    <Grid container spacing={3} style={{ overflow: 'auto', height: "50vh" }}>
                        <Grid item md={4} >
                            <CardSelect getLocationName={getBoatName} IconProps={<DirectionsBoatRoundedIcon style={{ fontSize: 40 }} />} />
                        </Grid>
                        <Grid item md={4} >
                            <CardSelect getLocationName={getCarName} IconProps={<LocalShippingIcon style={{ fontSize: 40 }} />} />
                        </Grid>
                        <Grid item md={4} >
                            <Button variant="contained" color="primary" href="#contained-buttons" onClick={() => { alert(`${Boat},${Car}`) }}>
                                Link
                            </Button>

                        </Grid>
                    </Grid>
                </Grid>
            </Grid>
        </Grid>
    );
}

export default SelectLocation;

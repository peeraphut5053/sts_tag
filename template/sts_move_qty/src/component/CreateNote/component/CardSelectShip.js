import React, { useState } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import Typography from '@material-ui/core/Typography';
import Grid from '@material-ui/core/Grid';
import DirectionsBoatIcon from '@material-ui/icons/DirectionsBoat';

const useStyles = makeStyles({
    root: {
        maxWidth: '100%',
        minWidth: '90%',
        padding: 10
    },
});

export default function CardSelectShip() {
    const classes = useStyles();
    const [OpenModal, setOpenModal] = useState(false)

    const handleOpen = () => {
        setOpenModal(true);
    };
    const handleClose = (value) => {
        setOpenModal(false);
    };


    return (
       

        <Card className={classes.root} onClick={() => handleOpen()}>
            <CardActionArea>
                <Grid container spacing={1}>
                    <Grid item>
                        <DirectionsBoatIcon style={{ fontSize: 30 }} />
                    </Grid>
                    <Grid item xs={12} sm container>
                        <Grid container direction="row" >
                            <Grid item xs={5} container direction="column" alignItems="flex-start" spacing={0}>
                                <Typography variant="body2"> id</Typography>
                            </Grid>
                            <Grid item xs={6} container direction="column" spacing={0}>
                                <Typography variant="subtitle2"> xxx</Typography>
                            </Grid>
                        </Grid>
                        <Grid container direction="row" >
                            <Grid item xs={5} container direction="column" alignItems="flex-start" spacing={0}>
                                <Typography variant="body2"> ทะเบียน</Typography>
                            </Grid>
                            <Grid item xs={6} container direction="column" spacing={0}>
                                <Typography variant="subtitle2"> xxx</Typography>
                            </Grid>
                        </Grid>
                        <Grid container direction="row" >
                            <Grid item xs={5} container direction="column" spacing={0}>
                                <Typography variant="body2"> ชื่อเรือ</Typography>
                            </Grid>
                            <Grid item xs={6} container direction="column" spacing={0}>
                                <Typography variant="subtitle2"> xxx</Typography>
                            </Grid>
                        </Grid>
                        <Grid container direction="row" >
                            <Grid item xs={5} container direction="column" spacing={0}>
                                <Typography variant="body2"> Location</Typography>
                            </Grid>
                            <Grid item xs={6} container direction="column" spacing={0}>
                                <Typography variant="subtitle2"> xxx</Typography>
                            </Grid>
                        </Grid>
                    </Grid>
                </Grid>
            </CardActionArea>

        </Card>
        
    );
}

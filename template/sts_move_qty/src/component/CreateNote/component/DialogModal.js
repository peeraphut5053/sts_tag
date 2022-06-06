import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Modal from '@material-ui/core/Modal';
import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import Typography from '@material-ui/core/Typography';
import Grid from '@material-ui/core/Grid';
import DirectionsBoatIcon from '@material-ui/icons/DirectionsBoat';
import ListItemSelect from './ListItemSelect';

function rand() {
    return Math.round(Math.random() * 20) - 10;
}

function getModalStyle() {
    const top = 50 ;
    const left = 50 ;

    return {
        top: `${top}%`,
        left: `${left}%`,
        transform: `translate(-${top}%, -${left}%)`,
    };
}

const useStyles = makeStyles((theme) => ({
    root: {
        maxWidth: '100%',
        minWidth: '90%',
        padding: 10,
        margin: 5
    },
    paper: {
        borderRadius:10,
        position: 'absolute',
        height:400,
        width: 400,
        overflowY: 'scroll',
        backgroundColor: theme.palette.background.paper,
        padding: theme.spacing(2, 4, 3),
    },
}));

export default function SimpleModal() {
    const classes = useStyles();
    // getModalStyle is not a pure function, we roll the style only on the first render
    const [modalStyle] = React.useState(getModalStyle);
    const [open, setOpen] = React.useState(false);

    const handleOpen = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false);
    };

    const body = (
        <div style={modalStyle} className={classes.paper}>
            <ListItemSelect />
        </div>
    );

    return (
        <div>
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
            <Modal
                open={open}
                onClose={handleClose}
                aria-labelledby="simple-modal-title"
                aria-describedby="simple-modal-description"
            >
                {body}
            </Modal>
        </div>
    );
}

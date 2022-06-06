import React from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Grid from '@material-ui/core/Grid';
import Paper from '@material-ui/core/Paper';
import Typography from '@material-ui/core/Typography';
import ButtonBase from '@material-ui/core/ButtonBase';
import { Avatar, ListItemAvatar } from '@material-ui/core';

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
    },
    paper: {
        padding: theme.spacing(1),
        margin: 'auto',
        maxWidth: 500,
    },
    image: {
        width: 60,
        height: 60,
    },
    img: {
        margin: 'auto',
        display: 'block',
        maxWidth: '100%',
        maxHeight: '100%',
    },
}));

export default function ItemSelect(props) {
    const classes = useStyles();

    return (
        <div className={classes.root}>
            <Paper className={classes.paper}>
                <Grid container spacing={0}>
                    <Grid item>
                        <ButtonBase className={classes.image}>
                            <ListItemAvatar>
                                <Avatar className={classes.avatar}>
                                    {props.SearchIcon}
                                </Avatar>
                            </ListItemAvatar>
                            {/* <img className={classes.img} alt="complex" src="/static/images/grid/complex.jpg" /> */}
                        </ButtonBase>
                    </Grid>
                    <Grid item xs={12} sm container>
                        <Grid item xs container direction="column" spacing={0}>
                            <Grid item xs>
                            <Typography gutterBottom variant="subtitle1"> id : {props.id}</Typography>
                            <Typography gutterBottom variant="subtitle1"> ทะเบียน : {props.license_plate}</Typography>
                                <Typography variant="body2" gutterBottom> ชื่อผู้ขับ : {props.driver_name}</Typography>
                                <Typography variant="body2" color="textSecondary"> Loc: {props.loc} </Typography>
                            </Grid>
                            {/* <Grid item>
                                <Typography variant="body2" style={{ cursor: 'pointer' }}>Remove </Typography>
                            </Grid> */}
                        </Grid>
                        <Grid item>
                            <Typography variant="subtitle1">Status</Typography>
                        </Grid>
                    </Grid>
                </Grid>
            </Paper>
        </div>
    );
}

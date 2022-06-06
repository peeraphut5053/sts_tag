import React, { useState, useEffect, useContext } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Paper from '@material-ui/core/Paper';
import InputBase from '@material-ui/core/InputBase';
import Divider from '@material-ui/core/Divider';
import IconButton from '@material-ui/core/IconButton';
import ClearIcon from '@material-ui/icons/Clear';
import ItemSelectDialog from './ItemSelectDialog';
import { InputContext } from './BoatNoteCreate'
import ComplexGrid from './ComplexGrid';
import { Grid, Typography, ButtonBase, ListItemAvatar, Avatar, Card, CardActionArea } from '@material-ui/core';


const useStyles = makeStyles((theme) => ({
    root: {
        padding: '0px 2px',
        display: 'flex',
        alignItems: 'center',
        // width: 500,
    },
    input: {
        marginLeft: theme.spacing(1),
        flex: 1,
    },
    iconButton: {
        padding: 3,
    },
    divider: {
        height: 20,
        margin: 2,
    },
    textHeader: {
        textAlign: "right"
    },

    fontFam: {
        fontFamily: "monospace"
    }

}));


// pass a function to map

export default function SearchInput(props) {
    const classes = useStyles();

    const [itemData, setitemData] = useState([props.Data])
    const [license_plate, setlicense_plate] = useState([props.Data]) // Item
    const [driver_name, setdriver_name] = useState([props.Data])
    const [loc, setloc] = useState([props.Data])

    return (
        <InputContext.Consumer>
            {
                context =>

                    <Paper className={classes.root}>
                        <Card className={classes.root} onClick={()=>{alert()}}>
                            <CardActionArea>
                                asdf
                            </CardActionArea>
                        </Card>
                        <ButtonBase>
                            <Grid container spacing={0}>
                                <Grid item>
                                    <ButtonBase className={classes.image}>
                                        <ListItemAvatar>
                                            <Avatar className={classes.avatar}>
                                                <ItemSelectDialog
                                                    ItemSelectedIcon={context.SearchIcon}
                                                />
                                            </Avatar>
                                        </ListItemAvatar>
                                        {/* <img className={classes.img} alt="complex" src="/static/images/grid/complex.jpg" /> */}
                                    </ButtonBase>
                                </Grid>
                                <Grid item xs={12} sm container>
                                    <table className={classes.fontFam}>
                                        <tr>
                                            <td className={classes.textHeader}>id :</td>
                                            <td>{props.id}</td>
                                        </tr>
                                        <tr>
                                            <td className={classes.textHeader}>ทะเบียน :</td>
                                            <td>{props.license_plate}</td>
                                        </tr>
                                        <tr>
                                            <td className={classes.textHeader}>ชื่อผู้ขับ :</td>
                                            <td>{props.driver_name}</td>
                                        </tr>
                                        <tr>
                                            <td className={classes.textHeader}>Loc :</td>
                                            <td>{props.loc}</td>
                                        </tr>
                                    </table>


                                </Grid>
                            </Grid>



                            {/* 
                        <ComplexGrid
                            data={props.data}
                            id={props.id}
                            license_plate={props.value}
                            SearchIcon={
                                <ItemSelectDialog
                                    ItemSelectedIcon={context.SearchIcon}
                                />}
                        /> */}



                            {/* <InputBase
                            className={classes.input}
                            placeholder={context.placeholder}
                            value={props.value}
                            size="small"
                        /> */}
                            {/* <Divider className={classes.divider} orientation="vertical" /> */}
                            {/* <IconButton color="primary" className={classes.iconButton} aria-label="directions" onClick={clearItemSelected}>
                            <ClearIcon />
                        </IconButton> */}
                        </ButtonBase>
                    </Paper>

            }

        </InputContext.Consumer >
    );
}
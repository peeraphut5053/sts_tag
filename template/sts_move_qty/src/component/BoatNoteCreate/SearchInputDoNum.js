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
}));


export default function SearchInputDoNum(props) {
    const classes = useStyles();
    const clearItemSelected = () => {
        props.getVal("")
    }
    return (
        <InputContext.Consumer>
            {
                context =>
                    <Paper className={classes.root}>
                        <ItemSelectDialog ItemSelectedIcon={props.SearchIcon} />
                        <InputBase
                            className={classes.input}
                            placeholder={context.placeholder}
                            value={props.value}
                            size="small"
                        />
                        <Divider className={classes.divider} orientation="vertical" />
                        <IconButton color="primary" className={classes.iconButton} aria-label="directions" onClick={clearItemSelected}>
                            <ClearIcon />
                        </IconButton>
                    </Paper>
            }
        </InputContext.Consumer >
    );
}
import React, { useState, useEffect, useContext } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Modal from '@material-ui/core/Modal';
import IconButton from '@material-ui/core/IconButton';
import Box from '@material-ui/core/Box';
import Avatar from '@material-ui/core/Avatar';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemAvatar from '@material-ui/core/ListItemAvatar';
import ListItemText from '@material-ui/core/ListItemText';
import DialogTitle from '@material-ui/core/DialogTitle';
import AddIcon from '@material-ui/icons/Add';
import ViewWeekIcon from '@material-ui/icons/ViewWeek';
import { Input, TextField, Paper, OutlinedInput } from '@material-ui/core';
import axios from 'axios';
import TabsNav from './TabsNav';
import { InputContext } from './BoatNoteCreate'
import ComplexGrid from './ComplexGrid';
import Grid from '@material-ui/core/Grid';

function getModalStyle() {
    const top = 50;
    const left = 50;

    return {
        top: `${top}%`,
        left: `${left}%`,
        transform: `translate(-${top}%, -0%)`,
    };
}

const useStyles = makeStyles((theme) => ({
    root: {
        flexGrow: 1,
    },
    paper: {
        position: 'absolute',
        width: 400,
        backgroundColor: theme.palette.background.paper,
        padding: theme.spacing(2, 4, 3),
        borderRadius: 10
    },
}));



export default function ListItemSelect(props) {

    const classes = useStyles();
    // getModalStyle is not a pure function, we roll the style only on the first render
    const [open, setOpen] = React.useState(false);
    const [itemsLists, setItemsLists] = useState([]) // Item

    const handleSeltedItem = (id, license_plate, driver_name, loc) => {
        props.ItemData(id)
        props.getDataLicense_plate(license_plate)
        props.getDriver_name(driver_name)
        props.getloc(loc)
        props.getDialogState(open)
        setOpen(false);
    }

    const handleKeyPress = (event) => {
        if (event.key === 'Enter') {
            console.log(event.target.value)
            //props.ItemSelected(event.target.value)
            props.ItemSelected(event.target.value)
            props.ItemData(event.target.value)
            props.getDialogState(open)
            setOpen(false);
        }
    }

    // Effect change when doNum change state
    useEffect(() => {
        axios.get(props.ItemsListsAPI)
            .then(res => {
                const items = res.data
                setItemsLists(items)
            })
            .catch(function (res) {
                if (res instanceof Error) {
                    console.log(res.message);
                } else {
                    console.log(res.data);
                }
            });
    }, [])


    return (
        <>
            {/* {props.ItemSelectDialogHeader} */}

            <ListItem >
                <TextField fullWidth size="small" id="outlined-basic" label="barcode" variant="outlined" onKeyUp={handleKeyPress} inputRef={input => input && input.focus()} />
            </ListItem>
            <List style={{ maxHeight: 420, overflow: 'auto' }}>
                {
                    itemsLists.map((item) =>
                        (
                            <ListItem button onClick={() =>
                                handleSeltedItem(item.id, item.license_plate, item.driver_name, item.loc)}
                                //handleSeltedItem(item.id, [{a:item.license_plate}, item.driver_name, item.loc])}
                                key={item.id}>
                                <ComplexGrid
                                    id={item.id}
                                    license_plate={item.license_plate}
                                    driver_name={item.driver_name}
                                    loc={item.loc}
                                    SearchIcon={props.SearchIcon}
                                />
                            </ListItem>
                        ))}
            </List>
            {/*             
            <ListItem style={{ backgroundColor: '#e3f2fd' }}  >
                <ListItemAvatar>
                    <Avatar>
                        <ViewWeekIcon />
                    </Avatar>
                </ListItemAvatar>
                <TextField id="outlined-basic" label="barcode" variant="outlined" onKeyUp={handleKeyPress} />
            </ListItem>
            <List style={{ maxHeight: 400, overflow: 'auto' }}>
                {itemsLists.map((item) => (
                    <ListItem button onClick={() => handleSeltedItem(item.id)} key={item.id}>
                        <ListItemAvatar>
                            <Avatar className={classes.avatar}>
                                {props.ItemSelectedIcon}
                            </Avatar>
                        </ListItemAvatar>
                        <ListItemText primary={item.id} />
                    </ListItem>
                ))}
            </List> */}
        </>
    );
}

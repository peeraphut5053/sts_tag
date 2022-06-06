import React, { useState, useEffect } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Modal from '@material-ui/core/Modal';
import IconButton from '@material-ui/core/IconButton';

import Avatar from '@material-ui/core/Avatar';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemAvatar from '@material-ui/core/ListItemAvatar';
import ListItemText from '@material-ui/core/ListItemText';
import DialogTitle from '@material-ui/core/DialogTitle';
import AddIcon from '@material-ui/icons/Add';
import ViewWeekIcon from '@material-ui/icons/ViewWeek';
import { Input, TextField, Paper } from '@material-ui/core';
import axios from 'axios';

const useStyles = makeStyles((theme) => ({
    paper: {
        position: 'absolute',
        width: 400,
        backgroundColor: theme.palette.background.paper,
        padding: theme.spacing(2, 4, 3),
        borderRadius: 10
    },
}));


export default function SelectItemsPage(props) {
    // const classes = useStyles();
    // // getModalStyle is not a pure function, we roll the style only on the first render
    // const [open, setOpen] = React.useState(false);
    // const [itemsLists, setItemsLists] = useState([]) // Item
    // const [page, setPage] = useState("")

    // const handleOpen = () => {
    //     setOpen(true);
    // };

    // const handleClose = (value) => {
    //     setOpen(false);
    // };

    // const handleSeltedItem = (value) => {
    //     props.ItemSelected(value)
    //     setOpen(false);
    // }

    // const handleKeyPress = (event) => {
    //     if (event.key === 'Enter') {
    //         console.log(event.target.value)
    //         props.ItemSelected(event.target.value)
    //         setOpen(false);
    //     }
    // }



    // // Effect change when doNum change state
    // useEffect(() => {
    //     console.log(123456789)
    //     console.log(props.ItemsListsAPI)
    //     axios.get(props.ItemsListsAPI)
    //         .then(res => {
    //             console.log(res.data)
    //             setItemsLists(res.data)
    //         })
    //         .catch(function (res) {
    //             if (res instanceof Error) {
    //                 console.log(res.message);
    //             } else {
    //                 console.log(res.data);
    //             }
    //         });
    // }, [])


    // const items = itemsLists//['username@gmail.com', 'user02@gmail.com', 1, 2, 3, 4, 5, 6];


    return (
        <div >
            <DialogTitle id="simple-dialog-title">{props.ItemSelectDialogHeader}</DialogTitle>
            <List>

                <ListItem style={{ backgroundColor: '#e3f2fd'}}  >
                    <ListItemAvatar>
                        <Avatar>
                            <ViewWeekIcon />
                        </Avatar>
                    </ListItemAvatar>
                    <TextField id="outlined-basic" label="barcode" variant="outlined" 
                    // onKeyUp={handleKeyPress}  
                    />
                </ListItem>
                <List style={{ maxHeight: 280, overflow: 'auto' }}>
                    {/* {items.map((item) => ( */}
                        <ListItem button 
                        // onClick={() => handleSeltedItem(item.id)} 
                        // key={item.id}
                        >{/*
                            <ListItemAvatar>
                                 <Avatar className={classes.avatar}>
                                    {props.ItemSelectedIcon}
                                </Avatar> 
                            </ListItemAvatar>*/}
                            {/* <ListItemText primary={item.id} /> */}
                        </ListItem>
                    {/* ))} */}
                </List>


                {/* <ListItem autoFocus button onClick={() => handleSeltedItem('addAccount')} >
                    <ListItemAvatar>
                        <Avatar>
                            <AddIcon />
                        </Avatar>
                    </ListItemAvatar>
                    <ListItemText primary="Add account" />
                </ListItem> */}
                
            </List>
        </div>
    );
}

import React, { useState, useEffect } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import Modal from '@material-ui/core/Modal';
import IconButton from '@material-ui/core/IconButton';
import TabsNav from './TabsNav';

import { InputContext } from './BoatNoteCreate'

function getModalStyle() {
    const top = 50;
    const left = 50;

    return {
        top: `${top}%`,
        left: `${left}%`,
        transform: `translate(-${top}%, -${left}%)`,
    };
}

const useStyles = makeStyles((theme) => ({
    paper: {
        position: 'absolute',
        width: 600,
        height: 580,
        backgroundColor: theme.palette.background.paper,
        padding: theme.spacing(2, 1, 3),
        borderRadius: 10
    },
}));

export default function ItemSelectDialog(props) {
    const classes = useStyles();
    // getModalStyle is not a pure function, we roll the style only on the first render
    const [modalStyle] = React.useState(getModalStyle);
    const [open, setOpen] = React.useState(false);

    const handleOpen = () => {
        setOpen(true);
    };
    const handleClose = (value) => {
        setOpen(false);
    };
    const body = (
        <div style={modalStyle} className={classes.paper}>
            <InputContext.Consumer>
                {context => <TabsNav getDialogState={handleClose} />}
            </InputContext.Consumer>
        </div>
    );
    return (
        <div>
            <IconButton className={classes.iconButton} aria-label="menu" onClick={() => handleOpen()}>
                {props.ItemSelectedIcon}
            </IconButton>
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

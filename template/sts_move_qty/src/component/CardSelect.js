import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import { makeStyles } from '@material-ui/core/styles';
import Button from '@material-ui/core/Button';
import Avatar from '@material-ui/core/Avatar';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemAvatar from '@material-ui/core/ListItemAvatar';
import ListItemText from '@material-ui/core/ListItemText';
import DialogTitle from '@material-ui/core/DialogTitle';
import Dialog from '@material-ui/core/Dialog';
import PersonIcon from '@material-ui/icons/Person';
import AddIcon from '@material-ui/icons/Add';
import Typography from '@material-ui/core/Typography';
import { blue } from '@material-ui/core/colors';


import Card from '@material-ui/core/Card';
import CardActionArea from '@material-ui/core/CardActionArea';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import AddCircleIcon from '@material-ui/icons/AddCircle';
import { Grid } from 'react-virtualized';
import { Paper } from '@material-ui/core';

const emails = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15'];
const useStyles = makeStyles({
    avatar: {
        backgroundColor: blue[100],
        color: blue[600],
    },
});






function SimpleDialog(props) {
    SimpleDialog.propTypes = {
        onClose: PropTypes.func.isRequired,
        open: PropTypes.bool.isRequired,
        selectedValue: PropTypes.string.isRequired,
    };
    const classes = useStyles();
    const { onClose, selectedValue, open, getLocationName } = props;
    const handleClose = () => {
        onClose(selectedValue);
    };
    const handleListItemClick = (value) => {
        onClose(value);
    };


    return (



        <Dialog onClose={handleClose} aria-labelledby="simple-dialog-title" open={props.open}>
            <DialogTitle id="simple-dialog-title">เลือก</DialogTitle>
            <List>
                {emails.map((email) => (
                    <ListItem button onClick={() => handleListItemClick(email)} key={email}>
                        <ListItemAvatar>
                            <Avatar className={classes.avatar}>
                                <PersonIcon />
                            </Avatar>
                        </ListItemAvatar>
                        <ListItemText primary={email} />
                    </ListItem>
                ))}

                <ListItem autoFocus button onClick={() => handleListItemClick('addAccount')}>
                    <ListItemAvatar>
                        <Avatar>
                            <AddIcon />
                        </Avatar>
                    </ListItemAvatar>
                    <ListItemText primary="Add account" />
                </ListItem>
            </List>
        </Dialog>
    );
}



export default function SimpleDialogDemo(props) {

    const classes = useStyles();
    const [open, setOpen] = React.useState(false);
    const [selectedValue, setSelectedValue] = React.useState("");

    const handleClickOpen = () => {
        setOpen(true);
    };

    const handleClose = (value) => {
        setOpen(false);
        setSelectedValue(value);
        props.getLocationName(value)

    };


    return (
        <div>

            <Card className={classes.root}>

                <CardActionArea onClick={handleClickOpen}>
                    <CardContent>
                        {/* <Typography gutterBottom variant="h5" component="h2">
                            {props.IconProps}  {selectedValue}
                        </Typography> */}

                        <Typography gutterBottom variant="h5" component="h2" display="inline">{props.IconProps}</Typography>
                        ::
                        <Typography gutterBottom variant="h5" component="h2" display="inline">{selectedValue}</Typography>
                    </CardContent>
                </CardActionArea>
            </Card>
            <SimpleDialog selectedValue={selectedValue} open={open} onClose={handleClose} />


        </div>
    );
}

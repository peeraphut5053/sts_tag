import React from 'react'
import { makeStyles } from '@material-ui/core/styles';
import MaterialTable from 'material-table'
import tableIcons from './tableIcons'
import Paper from '@material-ui/core/Paper';

import { ThemeProvider } from '@material-ui/core'
import { createMuiTheme } from '@material-ui/core/styles';

const useStyles = makeStyles({
    root: {
        padding: 10,
        width: '99%',
        margin: 10
    },
});

function MatTable(props) {
    const classes = useStyles();

    const theme = createMuiTheme({
        overrides: {
            MuiTableCell: {
                root: {
                    padding: '5px 5px',
                },
            },
        },
    });

    return (
        <Paper className={classes.root} >
            <ThemeProvider theme={theme}>
                <MaterialTable
                    style={{ width: '100%', margin: 5, overflowX: "scroll" }}
                    icons={tableIcons}
                    //title={"Quantity Move List :" + (props.qtyMoveList)? 0:props.qtyMoveList.length}
                    title={"Quantity Move List : " + props.qtyMoveList.length + " รายการ"}
                    columns={[
                        { title: 'id', field: 'id' },
                        { title: 'lot', field: 'lot',width: 200 },
                        { title: 'From loc', field: 'loc',width: 100 },
                        { title: 'item', field: 'item', width: 300 },
                        { title: 'qty', field: 'qty1', type: 'numeric' },
                        { title: 'unit', field: 'u_m' },
                    ]}
                    data={props.qtyMoveList}
                    options={{
                        search: false,
                        paging: false,
                        maxBodyHeight: '45vh',
                        minBodyHeight: '45vh',
                    }}
                />
            </ThemeProvider>

        </Paper>

    )
}

export default MatTable;

import React from 'react';
import Paper from '@material-ui/core/Paper';
import MaterialTable from 'material-table'
import tableIcons from './tableIcons'
import API from './api';

import { ThemeProvider } from '@material-ui/core'
import { createMuiTheme } from '@material-ui/core/styles';


export default function DenseTable(props) {

    const theme = createMuiTheme({
        overrides: {
            MuiTableCell: {
                root: {
                    padding: '10px 15px',
                },
            },
        },
    });

    const handleClickSelectDoc = (row) => {
        props.handleDocNum(row.doc_num)
        props.handleSTS_qty_move_hdr_loc(row.loc)
        props.handleSTS_qty_move_hdr_date(row.create_date.date)
        API.get(`module/API_QuantityMove/data.php?load=STS_qty_move_line&doc_num=${row.doc_num}`)
            .then(res => {
                props.handleSTS_qty_move_line(res.data)
            })

        API.get(`module/API_QuantityMove/data.php?load=checkItemLotLoc&loc=${row.loc}`)
            .then(res => {
                console.log(res.data)
                props.handlecheckItemLotLoc(res.data)
            })


    }

    return (
        <Paper>
            <ThemeProvider theme={theme}>
                <MaterialTable
                    style={{ width: '100%', margin: 5, overflowX: "scroll" }}
                    icons={tableIcons}
                    title={"รายงานการย้าย Item"}
                    columns={[
                        { title: 'Doc num', field: 'doc_num' },
                        { title: 'date', field: 'create_date.date', type: 'date' },
                        { title: 'To location', field: 'loc' },
                    ]}
                    onRowClick={(event, rowData) => { 
                        console.log(event)
                        handleClickSelectDoc(rowData) 
                    }}
                    data={props.STS_qty_move_hrd}
                    options={{
                        actionsColumnIndex:-1,
                        search: false,
                        paging: false,
                        maxBodyHeight: '68vh',
                        minBodyHeight: '68vh',
                        filtering: true
                    }}
                />
            </ThemeProvider>
        </Paper>
    );
}

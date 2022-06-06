import React, { Component, useState, useEffect } from 'react'
import MaterialTable from 'material-table'
import tableIcons from './../../tableIcons'
import { Button } from '@material-ui/core'
import ScanTag from './ScanTag'

function MatTable(props) {

    const [rowsSelected, setRowsSelected] = useState([])
    const [checkNow, setCheckNow] = useState()


    const handleTag = (tagId) => {
        props.getbarcode(tagId)
        setRowsSelected(rowsSelected)
    }

    const showTagChecked = (CheckBox) => {
        props.showTagChecked(CheckBox)
        //setCheckNow(CheckBox)
    }

    return (
        <MaterialTable
            style={{width:'100%'}}
            icons={tableIcons}
            title={props.title}
            columns={[
                { title: 'id', field: 'id' },
                { title: 'lot', field: 'lot' },
                { title: 'do_num', field: 'do_num' },
            ]}
            data={props.itemsLists}
            options={{
                selection: true,
                selectionProps: rowData => ({
                    color: 'primary',
                }),
                search: false,
                paging: false,
                maxBodyHeight: 300,
                minBodyHeight: 300
            }}
            onSelectionChange={(rows) => setRowsSelected(rows)}
            components={{ Actions: () => <ScanTag tagId={handleTag} showTagChecked={showTagChecked} /> }}
        />
    )
}

export default MatTable;

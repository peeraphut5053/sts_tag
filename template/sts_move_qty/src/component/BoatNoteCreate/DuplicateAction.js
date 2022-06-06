import React, { Component, useState, useEffect, useRef } from 'react'
import MaterialTable from 'material-table'
import tableIcons from './tableIcons'
import { Button } from '@material-ui/core'
import ScanTag from './ScanTag'

function CustomEditComponent(props) {
    const { useState } = React;
  
    const [columns, setColumns] = useState([
      {
        title: 'Name', field: 'name',
        editComponent: props => (
          <input
            type="text"
            value={props.value}
            onChange={e => props.onChange(e.target.value)}
          />
        )
      },
      { title: 'Surname', field: 'surname' },
      { title: 'Birth Year', field: 'birthYear', type: 'numeric' },
      {
        title: 'Birth Place',
        field: 'birthCity',
        lookup: { 34: 'İstanbul', 63: 'Şanlıurfa' },
      },
    ]);
  
    const [data, setData] = useState([
      { name: 'Mehmet', surname: 'Baran', birthYear: 1987, birthCity: 63 },
      { name: 'Zerya Betül', surname: 'Baran', birthYear: 2017, birthCity: 34 },
    ]);
  
    return (
      <MaterialTable
        icons = {tableIcons}
        title="Custom Edit Component Preview"
        columns={columns}
        data={data}
        editable={{
          onRowAdd: newData =>
            new Promise((resolve, reject) => {
              setTimeout(() => {
                setData([...data, newData]);
                console.log("onRowAdd")
                console.log(newData)
                resolve();
              }, 1000)
            }),
          onRowUpdate: (newData, oldData) =>
            new Promise((resolve, reject) => {
              setTimeout(() => {
                const dataUpdate = [...data];
                const index = oldData.tableData.id;
                dataUpdate[index] = newData;
                setData([...dataUpdate]);
                console.log("onRowUpdate")
                console.log(newData)
                resolve();
              }, 1000)
            }),
          onRowDelete: oldData =>
            new Promise((resolve, reject) => {
              setTimeout(() => {
                const dataDelete = [...data];
                const index = oldData.tableData.id;
                dataDelete.splice(index, 1);
                setData([...dataDelete]);
                console.log("onRowDelete")
                console.log(oldData.tableData.id)
                resolve();
              }, 1000)
            }),
        }}
      />
    )
  }
  
export default CustomEditComponent;
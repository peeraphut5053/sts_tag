import React, { useState, useEffect } from 'react';
import { makeStyles } from '@material-ui/core/styles';
import SearchInput from './SearchInput';
import { Box, GridList, Button, Container, } from '@material-ui/core';
import Grid from '@material-ui/core/Grid';

import MatTable from './MatTable';

import DirectionsBoatRoundedIcon from '@material-ui/icons/DirectionsBoatRounded';
import LocalShippingIcon from '@material-ui/icons/LocalShipping';
import AssignmentIcon from '@material-ui/icons/Assignment';
import Axios from 'axios';
import SaveIcon from '@material-ui/icons/Save';
import DeleteIcon from '@material-ui/icons/Delete';
import SearchInputDoNum from './SearchInputDoNum';

export const InputContext = React.createContext();

export default function CustomizedInputBase() {

    const [doLine, setdoLine] = useState([]) // Do line
    const [shipNum, setShipNum] = useState("") // Ship number
    const [license_plate, setlicense_plate] = useState("") // Item
    const [driver_name, setdriver_name] = useState("")
    const [loc, setloc] = useState("")


    const [shipData, setShipData] = useState([]) // Ship Data
    const [doData, setDoData] = useState() // Ship Data
    const [carNum, setCarNum] = useState("") // Car number

    const [doNum, setDoNum] = useState("") // DO number DB19120004
    const [barcode, setBarcode] = useState("") // Tag barcode scan
    const [check, setCheck] = useState("")


    const handleShipNum = (value) => { setShipNum(value) } //get value from Ship text box to setstate ShipNum
    const handleShipData = (value) => { setShipData(value) } //get value from Ship text box to setstate ShipNum
    const handleLicense_plate = (value) => { setlicense_plate(value) } //get value from Ship text box to setstate ShipNum
    const handleDriver_name = (value) => { setdriver_name(value) } //get value from Ship text box to setstate ShipNum
    const handleloc = (value) => { setloc(value) } //get value from Ship text box to setstate ShipNum


    const handleDoData = (value) => { setDoData(value) } //get value from Ship text box to setstate ShipNum
    const handleCarNum = (value) => setCarNum(value) //get value from Ship text box to setstate CarNum
    const handleDoNum = (value) => setDoNum(value) //get value from Ship text box to setstate DoNum

    const getbarcode = (value) => {
        barcodeValidator(value) // Validate barcode 
        setBarcode(value) // get value from Ship text box to setstate barcode
    }

    const barcodeValidator = (tagid) => {
        const result = doLine.filter((x) => {
            return x.id === tagid
        })
        if (result.length == 0) {
            alert("ไม่พบ Tag ")
        }
    }

    // Effect change when doNum change state
    useEffect(() => {
        Axios.get(`http://localhost/sts_web_center/module/RPT_DO_INVENTORY_DETAIL/data.php?do_num=${doNum}&sts_no=&load=ajax`)
            .then(res => {
                const do_line = res.data;
                setdoLine(do_line)
            })
    }, [doNum])

    // Effect change when barcode change state
    useEffect(() => {
        const doLineItem = doLine.map((tbData) => {
            let tbDataArray = tbData;
            if (tbDataArray.id === barcode) {
                tbDataArray.tableData = { id: tbData.tableData.id, checked: true }
            }
            return tbDataArray
        })
        setdoLine(doLineItem)
        console.log("effect change")
        console.log(shipNum)
    }, [shipNum, barcode, check])



    useEffect(() => {
        console.log("When shipData Change")
        console.log(shipData)
    }, [shipData])

    const showTagChecked = (checkState) => {
        console.log("showTagChecked" + checkState);
    }

    const handleSubmit = () => {
        const doLineSelected = doLine.filter((member) => {
            return member.tableData.checked === true
        })
        const dataSend = []
        dataSend.push(shipNum);
        dataSend.push(carNum);
        dataSend.push(doNum);
        dataSend.push(doLineSelected);
        console.log(dataSend)

        console.log(shipData)
    }


    return (
        <div>
            <Grid container spacing={1}>
                <Grid item xs={6}>
                    <InputContext.Provider
                        value={{
                            ListsAPI: 'http://localhost/sts_web_center/module/RPT_DO_INVENTORY_DETAIL/data.php?do_num=DB19120004&sts_no=&load=GetCarSelect',
                            ItemSelectDialogHeader: 'เลือกเรือส่งสินค้า',
                            placeholder: 'Ship ID',
                            getVal: handleShipNum,
                            getData: handleShipData,
                            getDataLicense_plate: handleLicense_plate,
                            getDriver_name: handleDriver_name,
                            getloc: handleloc,
                            SearchIcon: <DirectionsBoatRoundedIcon />
                        }}>
                        <SearchInput
                            value={shipNum}
                            Data={shipData}
                            license_plate={license_plate}
                            driver_name={driver_name}
                            loc={loc}
                            SearchIcon={<DirectionsBoatRoundedIcon />}
                            getVal={handleShipNum}
                        />
                    </InputContext.Provider>
                </Grid>
                <Grid item xs={6}>
                    <InputContext.Provider
                        value={{
                            ListsAPI: 'http://localhost/sts_web_center/module/RPT_DO_INVENTORY_DETAIL/data.php?do_num=DB19120004&sts_no=&load=GetShipSelect',
                            ItemSelectDialogHeader: 'เลือกรถส่งสินค้า',
                            placeholder: 'Car ID',
                            getVal: handleCarNum,
                            getData: handleShipData,
                            SearchIcon: <LocalShippingIcon />
                        }}>
                        <SearchInput
                            value={carNum}
                            Data={shipData}
                            SearchIcon={<LocalShippingIcon />}
                            getVal={handleCarNum}
                        />
                    </InputContext.Provider>
                </Grid>
                <Grid item xs={12}>
                    <InputContext.Provider
                        value={{
                            ListsAPI: 'http://localhost/sts_web_center/module/RPT_DO_INVENTORY_DETAIL/data.php?do_num=DB19120004&sts_no=&load=GetDOSelect',
                            ItemSelectDialogHeader: 'เลือกรถส่งสินค้า',
                            placeholder: 'DO Number',
                            getVal: handleDoNum,
                            getData: handleShipData,
                        }}>
                        <SearchInputDoNum
                            value={doNum}
                            SearchIcon={<AssignmentIcon />}
                            getVal={handleDoNum}
                        />
                    </InputContext.Provider>
                </Grid>
                <Grid item xs={12}>
                    <MatTable
                        doLine={doLine}
                        getbarcode={getbarcode}
                        showTagChecked={showTagChecked}
                        title={doNum}
                    />
                </Grid>
                <Grid item xs={12} style={{ textAlign: "center" }}>
                    <Button
                        variant="contained"
                        color="primary"
                        startIcon={<SaveIcon />}
                        onClick={() => { handleSubmit() }}
                    >
                        Save
                </Button>
                    <Button
                        variant="contained"
                        color="default"
                        startIcon={<DeleteIcon />}
                    >
                        Clear
                </Button>
                </Grid>
            </Grid>



            {/* <Box p={1} >
                <SearchInput
                    SearchIcon={<LocalShippingIcon />}
                    placeholder={"Car ID"}
                    getVal={handleCarNum}
                    ItemSelectDialogHeader={"เลือกรถส่งสินค้า"}
                    value={carNum}
                />
            </Box>
            <Box p={1} >
                <SearchInput
                    SearchIcon={<AssignmentIcon />}
                    placeholder={"Delivery Order Number"}
                    getVal={handleDoNum}
                    ItemSelectDialogHeader={"เลือกใบส่งสินค้า"}
                />
            </Box> */}

        </div>
    );
}

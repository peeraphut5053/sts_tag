import React, { useState } from 'react'
import { TextField, Button } from '@material-ui/core'
import Checkbox from '@material-ui/core/Checkbox';


export default function ScanTag(props) {
    const [tagId, settagId] = useState("")
    const [checked, setChecked] = React.useState(true);


    const handleTag = (event) => {
        settagId(event.target.value)
        if (event.key === 'Enter') {
            props.tagId(tagId)
            settagId("")
        }
    }

    const handleCheckBox = (event) => {
        setChecked(event.target.checked);
        props.showTagChecked(event.target.checked)
    };

    return (
        <div >
            {/* <div>
                <Checkbox
                    checked={checked}
                    onChange={handleCheckBox}
                    inputProps={{ 'aria-label': 'primary checkbox' }}
                /> แสดง Tag ที่แสกน
            </div> */}
            <div>
                <TextField
                    id="outlined-basic"
                    // autoFocus={true}
                    label="Barcode Tag"
                    size="small"
                    variant="outlined"
                    onKeyUp={handleTag} 
                    inputRef={input => input && input.focus()}

                    />
            </div>
        </div>
    )
}

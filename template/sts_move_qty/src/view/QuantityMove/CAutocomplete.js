/* eslint-disable no-use-before-define */
import React from 'react';
import TextField from '@material-ui/core/TextField';
import Autocomplete from '@material-ui/lab/Autocomplete';

export default function CAutocomplete(props) {
    const onSelectChange = (event, values) => {
        //(values.title=="")? " ":values.title
        console.log(values)
        if (values.title.length > 0) {
            props.handleSelectValue(values.title)
        }

    }
    return (
        <Autocomplete
            id="combo-box-demo"
            options={props.selectValue}
            getOptionLabel={(option) => option.title}
            style={{ width: "100%", margin: 10 }}
            onChange={onSelectChange}
            renderInput={(params) =>
                <TextField
                    {...params}
                    label={props.label}
                    variant="outlined"
                />}
            size="small"
        />
    );
}

import React from 'react';
import InputLabel from '@mui/material/InputLabel';
import MenuItem from '@mui/material/MenuItem';
import FormControl from '@mui/material/FormControl';
import Select from '@mui/material/Select';

export default function SelectField({
  settings,
  selectHandler,
  slug,
  label = 'Popis',
}) {
  return (
    <FormControl fullWidth>
      <InputLabel id={`${slug}-label`}>{label}</InputLabel>
      <Select
        name={slug}
        labelId={`${slug}-label`}
        id={`${slug}-select`}
        value={settings[slug] ? settings[slug] : ''}
        label={label}
        onChange={selectHandler}
      >
        <MenuItem value="">None</MenuItem>
        <MenuItem value={10}>Ten</MenuItem>
        <MenuItem value={20}>Twenty</MenuItem>
        <MenuItem value={30}>Thirty</MenuItem>
      </Select>
    </FormControl>
  );
}

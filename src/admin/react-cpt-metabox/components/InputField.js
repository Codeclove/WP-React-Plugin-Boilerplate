import React, { useContext } from 'react';
import TextField from '@mui/material/TextField';

export default function InputField({
  settings,
  inputHandler,
  slug,
  label = 'Popis',
}) {
  return (
    <TextField
      required
      id="outlined-required"
      name={slug}
      label={label}
      onKeyUp={inputHandler}
      defaultValue={settings[slug] ? settings[slug] : ''}
      margin="normal"
      fullWidth
    />
  );
}

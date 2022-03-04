import React from 'react';
import Switch from '@mui/material/Switch';
import FormControlLabel from '@mui/material/FormControlLabel';

export default function SwitchField({
  settings,
  switchHandler,
  slug,
  label = 'Popis',
}) {
  return (
    <FormControlLabel
      control={
        <Switch
          name={slug}
          checked={settings[slug] ? settings[slug] : false}
          onChange={switchHandler}
          inputProps={{ 'aria-label': 'controlled' }}
        />
      }
      label={label}
    />
  );
}

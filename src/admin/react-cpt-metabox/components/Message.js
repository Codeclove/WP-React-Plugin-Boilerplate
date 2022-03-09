import React, { useEffect, useState } from 'react';
import { Alert } from '@mui/material';

export default function Message({ message }) {
  const [alert, setAlert] = useState(true);
  useEffect(() => {
    const timer = setTimeout(() => {
      setAlert(false);
    }, 3000);

    if (alert === false) {
      setAlert(true);
    }
    // To clear or cancel a timer, you call the clearTimeout(); method,
    // passing in the timer object that you created into clearTimeout().

    return () => clearTimeout(timer);
  }, [message]);

  return message
    ? alert && <Alert severity={message.type}>{message.text}</Alert>
    : null;
}

import React from 'react';
import { Alert } from '@mui/material';

export default function NotificationMessage({ message }) {
  return <Alert severity={message.type}>{message.text}</Alert>;
}

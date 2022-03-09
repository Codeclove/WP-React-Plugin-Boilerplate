import React, { useState, useEffect } from 'react';
import LoadingButton from '@mui/lab/LoadingButton';
import SaveIcon from '@mui/icons-material/Save';
import Box from '@mui/material/Box';
import LinearProgress from '@mui/material/LinearProgress';
import useFetch from '../hooks/useFetch';
import InputField from './InputField';
import SelectField from './SelectField';
import SwitchField from './SwitchField';
import Message from './Message';

import headers from '../../../services/headers';

export default function SettingsPage() {
  const [message, setMessage] = useState(null);
  const [data, fetchData] = useFetch(
    'test-plugin/v1/admin-settings',
    'get',
    { headers: headers() },
  );
  const [settings, setSettings] = useState(null);

  useEffect(() => {
    if (data.data) {
      setSettings(() => data.data);
    }
  }, [data]);

  const selectHandler = (e) => {
    setSettings((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const inputHandler = (e) => {
    setSettings((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const switchHandler = (e) => {
    setSettings((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.checked,
    }));
  };

  const submitHandler = async () => {
    const submitResponse = await fetchData(
      'test-plugin/v1/admin-settings',
      'post',
      settings,
      {
        headers: headers(),
      },
    );

    if (submitResponse.error) {
      setMessage({ type: 'error', text: submitResponse.error });
    } else {
      setMessage({
        type: 'success',
        text: 'Data has been sucessfully saved.',
      });
    }
  };

  return (
    <div id="admin-settings-form">
      {message && <Message message={message}>{message.text}</Message>}

      {!settings && (
        <Box sx={{ width: '100%' }}>
          <LinearProgress />
        </Box>
      )}
      {settings && (
        <>
          <div className="form-row">
            <InputField
              slug="test-input"
              settings={settings}
              inputHandler={inputHandler}
              label="Test input"
            />
          </div>
          <div className="form-row">
            <SelectField
              slug="test-select"
              settings={settings}
              selectHandler={selectHandler}
              label="Select input"
            />
          </div>

          <div className="form-row">
            <SwitchField
              slug="test-switch"
              settings={settings}
              switchHandler={switchHandler}
              label="Test switch"
            />
          </div>

          <LoadingButton
            color="primary"
            onClick={submitHandler}
            loading={data.loading}
            loadingPosition="start"
            startIcon={<SaveIcon />}
            variant="contained"
          >
            Uložiť
          </LoadingButton>
        </>
      )}
    </div>
  );
}

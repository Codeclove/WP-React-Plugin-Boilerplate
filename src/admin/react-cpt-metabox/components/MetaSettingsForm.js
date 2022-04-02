import React, { useState, useEffect, useRef } from 'react';
import LoadingButton from '@mui/lab/LoadingButton';
import SaveIcon from '@mui/icons-material/Save';
import { TextField } from '@mui/material';
import useFetch from '../hooks/useFetch';

const ID = wpApiSettings.post_id;

export default function MetaSettingsForm({ setMessage }) {
  const submit = useRef(false);
  const [meta, setMeta] = useState(null);
  const [data, error, loading, fetchData] = useFetch(
    `wp/v2/custom-posts/${ID}`,
    'get',
  );

  useEffect(() => {
    if (!data) {
      return;
    }

    if (submit.current === false) {
      setMeta(data.meta);
    }

    if (submit.current === true) {
      setMeta(() => data.meta);
      setMessage({ type: 'success', text: 'Dáta boli uložené!' });
    }
  }, [data]);

  useEffect(() => {
    if (error) {
      setMessage({ type: 'error', text: error.data.message });
    }
  }, [error]);

  const inputHandler = (e) => {
    setMeta((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const submitHandler = () => {
    setMessage(null);
    submit.current = true;

    fetchData(`wp/v2/custom-posts/${ID}`, 'post', {
      meta,
    });
  };
  return (
    <div id="meta-settings-form">
      <TextField
        required
        id="outlined-required"
        name="meta-text"
        label="Meta label"
        onKeyUp={inputHandler}
        defaultValue=""
        margin="normal"
        fullWidth
      />
      <LoadingButton
        color="primary"
        onClick={submitHandler}
        loading={loading}
        loadingPosition="start"
        startIcon={<SaveIcon />}
        variant="contained"
      >
        Uložiť
      </LoadingButton>
    </div>
  );
}

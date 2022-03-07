import React, { useState, useEffect } from 'react';
import LoadingButton from '@mui/lab/LoadingButton';
import SaveIcon from '@mui/icons-material/Save';
import useFetch from './hooks/useFetch';
import './scss/react-cpt-metabox.scss';
import InputField from './components/InputField';
import Box from '@mui/material/Box';
import LinearProgress from '@mui/material/LinearProgress';
import headers from '../../services/headers';
import UploadField from './components/UploadField';

const ID = wpApiSettings.post_id;

export default function App() {
  const [data, fetchData] = useFetch(
    `wp/v2/custom-posts/${ID}`,
    'get',
    {
      headers: headers(),
    },
  );

  const [metaData, setMetaData] = useState(null);

  useEffect(() => {
    if (data.data) {
      setMetaData(() => data.data.meta);
    }
  }, [data]);

  console.log(metaData);

  const inputHandler = (e) => {
    setMetaData((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const submitHandler = () => {
    const data = {
      meta: metaData,
    };
    fetchData(`wp/v2/custom-posts/${ID}`, 'post', data, {
      headers: headers(),
    });
  };

  return (
    <div id="admin-settings-form">
      {!metaData && (
        <Box sx={{ width: '100%' }}>
          <LinearProgress />
        </Box>
      )}
      {metaData && (
        <>
          <div className="form-row">
            <InputField
              slug="new_meta"
              settings={metaData}
              inputHandler={inputHandler}
              label="New Meta"
            />
          </div>
          <div className="form-row">
            <UploadField />
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

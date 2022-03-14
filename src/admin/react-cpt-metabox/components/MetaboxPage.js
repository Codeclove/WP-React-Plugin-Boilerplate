import React, { useState, useEffect, useRef } from 'react';
import LoadingButton from '@mui/lab/LoadingButton';
import SaveIcon from '@mui/icons-material/Save';
import headers from '../../../services/headers';
import InputField from './InputField';
import useFetch from '../hooks/useFetch';
import LinerProgressBar from './LinerProgressBar';
import Message from './Message';
import MediaGallery from './MediaGallery';

const ID = wpApiSettings.post_id;
const config = {
  headers: headers(),
};

export default function MetaboxPage() {
  const [message, setMessage] = useState(null);

  const [metaData, setMetaData] = useState(null);
  const [data, fetchData] = useFetch(
    `wp/v2/custom-posts/${ID}`,
    'get',
    config,
  );

  useEffect(() => {
    if (data.data) {
      setMetaData(() => data.data.meta);
    }
  }, [data]);

  const inputHandler = (e) => {
    setMetaData((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const submitHandler = async () => {
    setMessage(null);

    const res = await fetchData(
      `wp/v2/custom-posts/${ID}`,
      'post',
      { meta: metaData },
      config,
    );

    if (res.error) {
      setMessage({ type: 'error', text: res.error });
    }
    if (!res.error) {
      setMessage({
        type: 'success',
        text: 'Data has been sucessfully saved.',
      });
    }
  };

  return (
    <div className="admin-post-settings">
      <div id="admin-settings-form">
        <Message message={message} />
        {!metaData && <LinerProgressBar />}
        {metaData && (
          <>
            <div className="form-row">
              <InputField
                slug="new_meta"
                settings={metaData}
                inputHandler={inputHandler}
                label="New meta"
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

      <MediaGallery setMessage={setMessage} />
    </div>
  );
}

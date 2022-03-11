import React, { useState, useEffect, useRef } from 'react';
import LoadingButton from '@mui/lab/LoadingButton';
import SaveIcon from '@mui/icons-material/Save';
import headers from '../../../services/headers';
import UploadField from './UploadField';
import InputField from './InputField';
import useFetch from '../hooks/useFetch';
import LinerProgressBar from './LinerProgressBar';
import Message from './Message';
import MediaGallery from './MediaGallery';

const ID = wpApiSettings.post_id;

export default function MetaboxPage() {
  const [message, setMessage] = useState(null);
  const [selectedMedia, setSelectedMedia] = useState([]);
  const [uploadedMedia, uploadMedia] = useFetch();
  const [media, getMedia] = useFetch(
    `wp/v2/media?parent=${ID}&per_page=100`,
    'get',
    {
      headers: headers(),
    },
  );
  const [metaData, setMetaData] = useState(null);
  const [data, fetchData] = useFetch(
    `wp/v2/custom-posts/${ID}`,
    'get',
    {
      headers: headers(),
    },
  );

  const inputEl = useRef(null);

  useEffect(() => {
    if (data.data) {
      setMetaData(() => data.data.meta);
    }
  }, [data]);

  const fileHandler = (e) => {
    const { files } = e.target;
    const filesArray = [];
    for (let i = 0; i < files.length; i++) {
      filesArray.push(files[i]);
    }
    setSelectedMedia(filesArray);
  };

  const inputHandler = (e) => {
    setMetaData((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  function resetHandler() {
    if (inputEl.current.value) {
      setSelectedMedia([]);
      inputEl.current.value = null;
    }
  }

  const submitMedia = async () => {
    const files = selectedMedia;

    if (selectedMedia.length === 0) {
      return null;
    }
    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
      formData.append(`file_${i}`, files[i]);
    }

    formData.append(`post_id`, ID);
    const response = await uploadMedia(
      `test-plugin/v1/media`,
      'post',
      formData,
      {
        headers: headers(),
      },
    );

    if (response.error) {
      setMessage({ type: 'error', text: uplodedResponse.error });
      return false;
    }

    const media = await getMedia(
      `wp/v2/media?parent=${ID}&per_page=100`,
      'get',
      {
        headers: headers(),
      },
    );

    if (media.error) {
      setMessage({ type: 'error', text: media.error });
      return false;
    }

    return response;
  };

  const submitData = async () =>
    await fetchData(
      `wp/v2/custom-posts/${ID}`,
      'post',
      { meta: metaData },
      {
        headers: headers(),
      },
    );

  const submitHandler = async () => {
    setMessage(null);

    const uplodedResponse = await submitMedia();

    if (uplodedResponse === false) {
      return;
    }

    const submitResponse = await submitData(uplodedResponse);

    if (submitResponse.error) {
      setMessage({ type: 'error', text: submitResponse.error });
    } else {
      setMessage({
        type: 'success',
        text: 'Data has been sucessfully saved.',
      });
      resetHandler();
    }
  };

  return (
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
          <div className="form-row">
            <UploadField
              fileHandler={fileHandler}
              selectedFiles={selectedMedia}
              resetHandler={resetHandler}
              inputEl={inputEl}
            />
          </div>
          <MediaGallery media={media} />
          <LoadingButton
            color="primary"
            onClick={submitHandler}
            loading={data.loading || uploadedMedia.loading}
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

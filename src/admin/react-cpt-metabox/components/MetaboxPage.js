import React, { useState, useEffect, useRef } from 'react';
import LoadingButton from '@mui/lab/LoadingButton';
import SaveIcon from '@mui/icons-material/Save';
import headers from '../../../services/headers';
import NotificationMessage from './NotificationMessage';
import UploadField from './UploadField';
import InputField from './InputField';
import useFetch from '../hooks/useFetch';
import LinerProgressBar from './LinerProgressBar';

const ID = wpApiSettings.post_id;

export default function MetaboxPage() {
  const [message, setMessage] = useState(null);
  const [selectedFiles, setSelectedFiles] = useState([]);
  const [files, uploadFiles] = useFetch(null);
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
    setSelectedFiles(filesArray);
  };

  const inputHandler = (e) => {
    setMetaData((prevState) => ({
      ...prevState,
      [e.target.name]: e.target.value,
    }));
  };

  const submitFiles = async () => {
    const files = selectedFiles;
    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
      formData.append(`file_${i}`, files[i]);
    }
    return await uploadFiles(
      'test-plugin/v1/media',
      'post',
      formData,
      {
        headers: headers(),
      },
    );
  };

  function resetHandler() {
    if (inputEl.current.value) {
      setSelectedFiles([]);
      inputEl.current.value = null;
    }
  }

  const submitData = async () => {
    const data = {
      meta: metaData,
    };
    return await fetchData(`wp/v2/custom-posts/${ID}`, 'post', data, {
      headers: headers(),
    });
  };

  const submitHandler = async () => {
    setMessage(null);
    if (selectedFiles.length !== 0) {
      const uplodedResponse = await submitFiles();
      if (uplodedResponse.error) {
        setMessage({ type: 'error', text: uplodedResponse.error });
        return;
      }
    }

    const submitResponse = await submitData();

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
      {message && <NotificationMessage message={message} />}
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
              selectedFiles={selectedFiles}
              resetHandler={resetHandler}
              inputEl={inputEl}
            />
          </div>
          <LoadingButton
            color="primary"
            onClick={submitHandler}
            loading={data.loading || files.loading}
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

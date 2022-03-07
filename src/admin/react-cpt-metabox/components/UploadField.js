import React from 'react';
import { styled } from '@mui/material/styles';
import Button from '@mui/material/Button';
import AttachFileIcon from '@mui/icons-material/AttachFile';
import useFetch from '../hooks/useFetch';
import headers from '../../../services/headers';

const Input = styled('input')({
  display: 'none',
});

export default function UploadField() {
  const [files, uploadFiles] = useFetch(null);
  function fileHandler(e) {
    const { files } = e.target;

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
      formData.append(`file_${i}`, files[i]);
    }

    uploadFiles('test-plugin/v1/media', 'post', formData, {
      headers: headers(),
    });
  }

  console.log(files);

  return (
    <label htmlFor="contained-button-file">
      <Input
        accept="image/*"
        id="contained-button-file"
        multiple
        type="file"
        onChange={fileHandler}
      />
      <Button
        startIcon={<AttachFileIcon />}
        variant="contained"
        component="span"
      >
        Select file
      </Button>
    </label>
  );
}

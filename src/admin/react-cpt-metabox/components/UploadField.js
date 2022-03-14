import React from 'react';
import { styled } from '@mui/material/styles';
import LoadingButton from '@mui/lab/LoadingButton';
import AttachFileIcon from '@mui/icons-material/AttachFile';

const Input = styled('input')({
  display: 'none',
});

export default function UploadField({ fileHandler, uploadedMedia }) {
  return (
    <label htmlFor="upload-button-file">
      <Input
        accept="image/*, application/pdf"
        id="upload-button-file"
        multiple
        type="file"
        onChange={fileHandler}
      />
      <LoadingButton
        startIcon={<AttachFileIcon />}
        variant="contained"
        component="span"
        loading={uploadedMedia.loading}
        loadingPosition="start"
      >
        Upload file
      </LoadingButton>
    </label>
  );
}

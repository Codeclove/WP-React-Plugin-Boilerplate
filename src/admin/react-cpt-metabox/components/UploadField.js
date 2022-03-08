import React, { useRef } from 'react';
import { styled } from '@mui/material/styles';
import Button from '@mui/material/Button';
import AttachFileIcon from '@mui/icons-material/AttachFile';
import IconButton from '@mui/material/IconButton';
import HighlightOffIcon from '@mui/icons-material/HighlightOff';

const Input = styled('input')({
  display: 'none',
});

export default function UploadField({
  fileHandler,
  selectedFiles,
  resetHandler,
  inputEl,
}) {
  return (
    <>
      <label htmlFor="upload-button-file">
        <Input
          ref={inputEl}
          accept="image/*, application/pdf"
          id="upload-button-file"
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

      {selectedFiles.length !== 0 ? (
        <>
          <IconButton
            color="error"
            aria-label="Clear files"
            onClick={resetHandler}
          >
            <HighlightOffIcon />
          </IconButton>
          <div className="selected-files">
            {selectedFiles.map((file, i) => (
              <div key={i}>{file.name}</div>
            ))}
          </div>
        </>
      ) : null}
    </>
  );
}

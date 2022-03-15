import React, { useEffect } from 'react';
import MediaItem from './MediaItem';
import UploadField from './UploadField';
import useFetch from '../hooks/useFetch';
import headers from '../../../services/headers';

const ID = wpApiSettings.post_id;
const config = {
  headers: headers(),
};

export default function MediaUploader({ setMessage }) {
  const [uploadedMedia, uploadMedia] = useFetch();
  const [media, getMedia] = useFetch(
    `wp/v2/media?parent=${ID}&per_page=100`,
    'get',
    config,
  );

  useEffect(() => {
    if (uploadedMedia.data) {
      // Run when media upload finished
      getMedia(
        `wp/v2/media?parent=${ID}&per_page=100`,
        'get',
        config,
      );
    }
  }, [uploadedMedia]);

  const fileHandler = (e) => {
    const { files } = e.target;
    const filesArray = [];
    for (let i = 0; i < files.length; i++) {
      filesArray.push(files[i]);
    }

    submitMedia(filesArray);
  };

  const submitMedia = async (filesArray) => {
    const files = filesArray;

    if (files.length === 0) {
      return null;
    }
    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
      formData.append(`file_${i}`, files[i]);
    }

    formData.append(`post_id`, ID);
    const res = await uploadMedia(
      `test-plugin/v1/media`,
      'post',
      formData,
      config,
    );

    if (res.error) {
      setMessage({ type: 'error', text: res.error });
      return false;
    }

    if (!res.error) {
      setMessage({
        type: 'success',
        text: 'Files has been sucessfully uploaded.',
      });
    }
  };
  return (
    <>
      <UploadField
        fileHandler={fileHandler}
        uploadedMedia={uploadedMedia}
      />
      <div className="media-gallery">
        {media.data && (
          <>
            {media.data.map((m, i) => (
              <MediaItem key={i} mediaData={m} />
            ))}
          </>
        )}
      </div>
    </>
  );
}

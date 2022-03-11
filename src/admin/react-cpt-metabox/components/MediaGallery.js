import React from 'react';
import MediaItem from './MediaItem';

export default function MediaGallery({ media }) {
  return (
    <div>
      {media.data.map((m, i) => (
        <MediaItem key={i} mediaData={m} />
      ))}
    </div>
  );
}

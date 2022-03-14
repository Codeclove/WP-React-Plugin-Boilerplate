import React from 'react';

export default function MediaItem({ mediaData }) {
  console.log(mediaData);
  return (
    <div className="media-item">
      <a href={mediaData.source_url} target="_blank" rel="noreferrer">
        <img
          src={mediaData.media_details.sizes.thumbnail.source_url}
        />
      </a>
    </div>
  );
}

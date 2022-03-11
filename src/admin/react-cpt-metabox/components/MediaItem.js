import React from 'react';

export default function MediaItem({ mediaData }) {
  console.log(mediaData);
  return <div>{mediaData.id}</div>;
}

import React, { useState } from 'react';

import MediaUploader from './MediaUploader';
import MetaSettingsForm from './MetaSettingsForm';
import Message from './Message';

export default function MetaboxPage() {
  const [message, setMessage] = useState(null);
  return (
    <div className="admin-post-settings">
      <Message message={message} />
      <MetaSettingsForm setMessage={setMessage} />
      <MediaUploader setMessage={setMessage} />
    </div>
  );
}

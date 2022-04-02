import { useEffect, useState } from 'react';
import RestApi from '../../../services/api';
import headers from '../../../services/headers';

const axiosConfig = {
  headers: headers(),
};

function useFetch(url, method, body) {
  const [response, setResponse] = useState(null);
  const [error, setError] = useState(false);
  const [loading, setLoading] = useState(false);

  const fetchData = async (fetchUrl, fetchMethod, fetchBody) => {
    const fBody = fetchMethod === 'get' ? axiosConfig : fetchBody;
    const fConfig = fetchMethod === 'get' ? '' : axiosConfig;
    try {
      setLoading(true);

      const { data } = await RestApi[method](
        fetchUrl,
        fBody,
        fConfig,
      );
      setResponse(data);
    } catch (err) {
      // err.response.data.message
      setError(err.response);
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    if (url) {
      fetchData(url, method, body);
    }
  }, [url]);

  return [response, error, loading, fetchData];
}

export default useFetch;

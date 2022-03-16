import { useEffect, useState } from 'react';
import RestApi from '../../../services/api';

function useFetch(url, method, bodyData, config) {
  const [response, setResponse] = useState({
    data: '',
    error: '',
    loading: false,
  });

  const fetchData = async (
    fetchUrl,
    fetchMethod = 'get',
    fetchBody = '',
    fetchConfig = {},
  ) => {
    try {
      setResponse((prevState) => ({
        ...prevState,
        loading: true,
        error: '',
      }));

      const { data } = await RestApi[fetchMethod](
        fetchUrl,
        fetchBody,
        fetchConfig,
      );
      setResponse({ data, loading: false, error: false });
      return { data, loading: false, error: false };
    } catch (err) {
      setResponse({
        data: '',
        loading: false,
        error: err,
      });
      return {
        data: '',
        loading: false,
        error: err.response.data.message,
      };
    }
  };

  useEffect(() => {
    if (url) {
      fetchData(url, method, bodyData, config);
    }
  }, [url]);

  return [response, fetchData];
}

export default useFetch;

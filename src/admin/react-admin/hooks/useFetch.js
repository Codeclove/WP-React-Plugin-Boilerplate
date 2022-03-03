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

      // FOR TESTING PURPOSES
      await new Promise((r) => setTimeout(r, 2000));
      const { data } = await RestApi[fetchMethod](
        fetchUrl,
        fetchBody,
        fetchConfig,
      );
      setResponse({ data, loading: false, error: '' });
    } catch (err) {
      setResponse({
        data: '',
        loading: false,
        error: err,
      });
    }
  };

  useEffect(() => {
    if (url) {
      fetchData(url, method, bodyData, config);
    }
  }, [url]);

  return [response, fetchData];
}

function sleep(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

export default useFetch;

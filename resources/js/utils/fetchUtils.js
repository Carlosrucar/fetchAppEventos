const handleResponse = async (response) => {
  if (!response.ok) {
    const error = await response.json();
    throw new Error(error.message || 'Ocurrió un error');
  }
  return response.json();
};

export const fetchWithConfig = async (url, options = {}) => {
  const defaultOptions = {
    headers: {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    credentials: 'same-origin'
  };

  return fetch(url, { ...defaultOptions, ...options })
    .then(handleResponse);
};
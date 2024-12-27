import React, { useState, useEffect, useCallback } from "react";
import axios from "axios";

function BBJSearchBar({ handleSearch }) {
  const [inputValue, setInputValue] = useState("");
  const [searchResults, setSearchResults] = useState([]);
  const [isLoading, setIsLoading] = useState(false);

  const debounce = (func, wait) => {
    let timeout;
    return function (...args) {
      const context = this;
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(context, args), wait);
    };
  };

  const fetchSearchResults = useCallback(
    debounce(value => {
      setIsLoading(true);
      axios.get(`/wp-json/bbj/v1/search?q=${value}`).then(response => {
        setSearchResults(response.data);
        setIsLoading(false);
      });
    }, 300),
    []
  );

  useEffect(() => {
    if (inputValue === "") {
      return;
    }

    fetchSearchResults(inputValue);
  }, [inputValue, fetchSearchResults]);

  const handleInputChange = event => {
    setInputValue(event.target.value);
    handleSearch(event); // Call the callback function from the parent component

    
  };

  return (
    <div className="col-span-2">
      <div className="relative">
        <input type="text" className="w-full rounded-lg border border-gray-300 bg-white py-1 px-1.5 focus:border-second500" id="bbj-search" placeholder="Search Here..." value={inputValue} onChange={handleInputChange} />
        {isLoading && <div className="spinner absolute top-0 right-0 mr-3 mt-1"></div>}
      </div>
      {Array.isArray(searchResults) && searchResults.map(result => <div key={result.id}>{result.title}</div>)}
    </div>
  );
}

export default BBJSearchBar;

import React, { useEffect } from "react";

function NewPostAlert({ countResult }) {
  console.log("NEW POST");
  return (
    <div id="new-post-message" class="mb-4 flex border-t-4 border-sky-300 bg-sky-50 p-4 text-primary500 dark:border-blue-800 dark:bg-gray-800 dark:text-blue-400" role="alert">
      <svg class="h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
      </svg>
      <div class="ml-3 text-sm font-medium">
        <p>
          You have {countResult} new {countResult === 1 ? "post" : "posts"} since you last viewed this page.
        </p>
        <p>Please refresh to see the latest {countResult === 1 ? "post" : "posts"}!</p>
      </div>
      <button type="button" class="-mx-1.5 -my-1.5 ml-auto inline-flex h-8 w-8 rounded-lg bg-blue-50 p-1.5 text-primary500 hover:bg-blue-200 focus:ring-2 focus:ring-blue-400 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#new-post-message" aria-label="Close">
        <span class="sr-only">Dismiss</span>
        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
  );
}

export default NewPostAlert;

import React from "react";

const GenderInput = ({ handleGender }) => {
  return (
    <div class="">
      <select id="playerGender" class="mr-2 block w-full rounded-lg border border-gray-300 bg-white py-1 px-1.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 dark:focus:border-slate-500 dark:focus:ring-slate-500" onChange={handleGender}>
        <option selected>Gender</option>
        <option value="both">Both</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </div>
  );
};

export default GenderInput;

import React, { useState } from "react";

const SelectSeason = ({ players, setFilteredPlayers }) => {
  const [selectedSeason, setSelectedSeason] = useState("");

  const handleSeasonChange = event => {
    setSelectedSeason(event.target.value);
    setFilteredPlayers(players.filter(player => player.season === event.target.value));
  };
  // Extract unique seasons from players
  const seasons = Array.from(new Set(players.map(player => player.season)));

  return (
    <select onChange={handleSeasonChange} value={selectedSeason} class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 dark:focus:border-slate-500 dark:focus:ring-slate-500">
      <option value="">All Seasons</option>
      {seasons.map(season => (
        <option key={season} value={season}>
          {season}
        </option>
      ))}
    </select>
  );
};

export default SelectSeason;

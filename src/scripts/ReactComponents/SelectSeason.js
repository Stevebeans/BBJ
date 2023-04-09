import React, { useState } from "react";

const SelectSeason = ({ seasons, handleSeason, players }) => {
  const [selectedSeason, setSelectedSeason] = useState("all seasons");

  const getSeasonAbbrById = id => {
    const playerWithSeason = players.find(player => player.seasons.hasOwnProperty(id));
    if (playerWithSeason) {
      return playerWithSeason.seasons[id].abbr;
    }
    return "";
  };

  return (
    <div class="w-full md:flex-shrink-0">
      <select
        onChange={e => {
          handleSeason(e);
          setSelectedSeason(e.target.value);
        }}
        value={selectedSeason}
        class="block w-full rounded-lg border border-gray-300 bg-white py-1 px-1.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 dark:focus:border-slate-500 dark:focus:ring-slate-500"
      >
        <option value="all seasons">All Seasons</option>
        {seasons.map(season => (
          <option key={season} value={season}>
            {getSeasonAbbrById(season)}
          </option>
        ))}
      </select>
    </div>
  );
};

export default SelectSeason;

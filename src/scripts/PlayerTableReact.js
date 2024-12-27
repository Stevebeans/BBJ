import React, { useState, useEffect, Fragment, useRef } from "react";
import axios from "axios";
import Loading from "./ReactComponents/Loading";
import PlayerCard from "./ReactComponents/PlayerCard";
import BBJSearchBar from "./ReactComponents/SearchInput";
import GenderInput from "./ReactComponents/GenderInput";
import SelectSeason from "./ReactComponents/SelectSeason";
import Pagination from "./ReactComponents/Pagination";
import Masonry from "masonry-layout";
import AdditionalFilters from "./ReactComponents/AdditionalFilters";

const PlayerTableReact = () => {
  const [players, setPlayers] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [searchQuery, setSearchQuery] = useState("");
  const [filteredPlayers, setFilteredPlayers] = useState([]);
  const [genderFilter, setGenderFilter] = useState("both");
  const [filteredByGenderPlayers, setFilteredByGenderPlayers] = useState(players);
  const [seasons, setSeasons] = useState([]);
  const [selectedSeason, setSelectedSeason] = useState("all seasons");
  const [currentPage, setCurrentPage] = useState(1);
  const [playersPerPage, setPlayersPerPage] = useState(16);
  const [sortOption, setSortOption] = useState("name_asc");
  const masonryRef = useRef();
  const [additionalFilters, setAdditionalFilters] = useState({
    winners: false,
    americasFavorite: false,
    runnerUp: false
  });

  useEffect(() => {
    axios
      .get(playerData.root_url + "/wp-json/bbj/v1/player_info/")
      .then(res => {
        const sortedPlayers = res.data.sort((a, b) => {
          return a.last_name.localeCompare(b.last_name);
        });

        setPlayers(sortedPlayers);
        setFilteredPlayers(sortedPlayers);
        setIsLoading(false);
        console.log(sortedPlayers);
      })
      .catch(err => {
        console.log(err);
      });
  }, []);

  // Pull the seasons from the DB and put it into an array to be passed
  useEffect(() => {
    if (players.length > 0) {
      const extractedSeasons = Array.from(new Set(players.flatMap(player => Object.keys(player.seasons))));
      setSeasons(extractedSeasons);
    }
  }, [players]);

  const handleSearch = event => {
    setSearchQuery(event.target.value);
  };

  const handleGender = event => {
    setGenderFilter(event.target.value);
  };

  const handleSeason = event => {
    setSelectedSeason(event.target.value);
  };

  const handlePageChange = newPage => {
    setCurrentPage(newPage);
  };

  const handleSortOption = event => {
    setSortOption(event.target.value);
  };

  const handleAdditionalFilters = (filterName, checked) => {
    setAdditionalFilters(prevFilters => ({
      ...prevFilters,
      [filterName]: checked
    }));
  };

  const handlePlayersPerPage = event => {
    setPlayersPerPage(parseInt(event.target.value, 10));
  };

  useEffect(() => {
    let filtered = players
      .filter(player => {
        if (genderFilter === "both" || genderFilter === "Choose Gender") {
          return true;
        } else {
          return player.gender === genderFilter;
        }
      })
      .filter(player => {
        if (selectedSeason === "all seasons" || selectedSeason === "") {
          return true;
        } else {
          return player.seasons.hasOwnProperty(selectedSeason);
        }
      })
      .filter(player => {
        return player.first_name.toLowerCase().includes(searchQuery.toLowerCase()) || player.last_name.toLowerCase().includes(searchQuery.toLowerCase()) || Object.values(player.seasons).some(season => season.abbr.toLowerCase().includes(searchQuery.toLowerCase()));
      })
      .filter(player => {
        const seasonIds = Object.keys(player.seasons);
        const filterConditions = [];

        if (additionalFilters.winners) {
          filterConditions.push(seasonIds.some(id => player.seasons[id].winner === "1"));
        }

        if (additionalFilters.americasFavorite) {
          filterConditions.push(seasonIds.some(id => player.seasons[id].afp === "1"));
        }

        if (additionalFilters.runnerUp) {
          filterConditions.push(seasonIds.some(id => player.seasons[id].runner_up === "1"));
        }

        return filterConditions.length > 0 ? filterConditions.some(condition => condition) : true;
      });

    // Add sorting logic
    console.log(sortOption);
    switch (sortOption) {
      case "name_asc":
        filtered.sort((a, b) => a.last_name.localeCompare(b.last_name));
        break;
      case "name_desc":
        filtered.sort((a, b) => b.last_name.localeCompare(a.last_name));
        break;
      case "hoh_wins":
      case "veto_wins":
      case "noms":
        const sortKey = sortOption === "hoh_wins" ? "hoh_wins" : sortOption === "veto_wins" ? "pov_wins" : "nom";
        filtered.sort((a, b) => {
          const aSum = Object.values(a.seasons).reduce((sum, season) => sum + parseInt(season[sortKey], 10), 0);
          const bSum = Object.values(b.seasons).reduce((sum, season) => sum + parseInt(season[sortKey], 10), 0);
          return bSum - aSum;
        });
        break;
      default:
        break;
    }

    setFilteredByGenderPlayers(filtered);
  }, [genderFilter, players, searchQuery, selectedSeason, additionalFilters, sortOption]);

  const totalPages = Math.ceil(filteredByGenderPlayers.length / playersPerPage);
  const startIndex = (currentPage - 1) * playersPerPage;
  const endIndex = Math.min(startIndex + playersPerPage, filteredByGenderPlayers.length);
  const playersToDisplay = filteredByGenderPlayers.slice(startIndex, endIndex);

  useEffect(() => {
    if (masonryRef.current) {
      const msnry = new Masonry(masonryRef.current, {
        itemSelector: ".player-card",
        columnWidth: 295,
        gutter: 16,
        fitWidth: false,
        horizontalOrder: true
      });

      return () => {
        msnry.destroy();
      };
    }
  }, [playersToDisplay]);

  return (
    <Fragment>
      {isLoading ? (
        <Loading />
      ) : (
        <div>
          <div className="mb-2 grid grid-cols-2 grid-rows-3 gap-1 sm:grid-cols-4 sm:grid-rows-1">
            <BBJSearchBar handleSearch={handleSearch} />
            <div className="flex justify-end"></div>
            <div className="flex flex-row justify-end">
              <div className="mr-2 flex items-center self-center text-sm">
                View:
                <select name="player_page" id="player_page" onChange={handlePlayersPerPage} className="ml-1 block rounded-lg border border-gray-300 bg-white py-1 px-1.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 dark:focus:border-slate-500 dark:focus:ring-slate-500">
                  <option value="16">16</option>
                  <option value="32">32</option>
                  <option value="48">48</option>
                  <option value="64">64</option>
                </select>
              </div>
              <div className="flex items-center self-center text-sm">
                Sort:
                <select name="player_sort" id="player_sort" onChange={handleSortOption} className="ml-1 block rounded-lg border border-gray-300 bg-white py-1 px-1.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400 dark:focus:border-slate-500 dark:focus:ring-slate-500">
                  <option value="name_asc">Name A-Z</option>
                  <option value="name_desc">Name Z-A</option>
                  <option value="hoh_wins">HOH Wins</option>
                  <option value="veto_wins">Veto Wins</option>
                  <option value="noms">Nominations</option>
                </select>
              </div>
            </div>
          </div>
          <AdditionalFilters handleAdditionalFilters={handleAdditionalFilters} selectedFilters={additionalFilters} seasons={seasons} handleSeason={handleSeason} players={players} handleGender={handleGender} />

          <div ref={masonryRef} className="masonry.custom-masonry">
            {playersToDisplay.length > 0 ? playersToDisplay.map(player => <PlayerCard key={player.id} player={player} />) : <div>No Results Found</div>}
          </div>

          <Pagination totalPages={totalPages} currentPage={currentPage} onPageChange={handlePageChange} />
        </div>
      )}
    </Fragment>
  );
};

export default PlayerTableReact;

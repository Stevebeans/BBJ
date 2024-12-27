import React from "react";

const PlayerCard = ({ player }) => {
  const seasonsArray = Object.values(player.seasons);

  const winnerCheck = info => {
    return info.some(season => season.winner === "1");
  };

  const runnerUpCheck = info => {
    return info.some(season => season.runner_up === "1");
  };

  const afpCheck = info => {
    return info.some(season => season.afp === "1");
  };

  const isWinner = winnerCheck(seasonsArray);
  const isRunnerUp = runnerUpCheck(seasonsArray);
  const isAfp = afpCheck(seasonsArray);

  return (
    <div className="player-card group overflow-hidden rounded bg-slate-200 shadow-deep hover:shadow-deepHover">
      <div className="flex w-full">
        <div className="h-28 w-40">
          <a href={player.player_link}>
            <img src={player.profile} className="h-full w-40" alt={`${player.first_name} ${player.last_name}`} />
          </a>
        </div>
        <div className="relative flex w-full flex-col justify-between py-1 px-2">
          <div className="absolute top-0 right-0 mr-3 mt-1">
            {isWinner ? <i className="fa-solid fa-trophy mr-1 text-amber-300"></i> : ""}
            {isRunnerUp ? <i className="fa-solid fa-medal mr-1 text-gray-400"></i> : ""}
            {isAfp ? <i className="fa-solid fa-award text-violet-300"></i> : ""}
          </div>
          <div>
            <h3 className="font-ibm text-sm text-primary500 group-hover:text-secondHard">
              <a href={player.player_link}>{player.first_name}</a>
            </h3>
            <h2 className="font-ibm text-base font-semibold leading-4 text-primary500 group-hover:text-secondHard">
              <a href={player.player_link}>{player.last_name}</a>
            </h2>
            <div className="font-hand">{player.nickname}</div>
          </div>
          <div className="mt-2 grid grid-cols-2 align-bottom text-xs text-primary500" style={{ gridTemplateColumns: "0.5fr 1.5fr" }}>
            <div>Age</div>
            <div className="group-hover:font-bold">{player.current_age}</div>
            <div>Gender</div>
            <div className="capitalize group-hover:font-bold">{player.gender}</div>
            <div>Loc</div>
            <div className="group-hover:font-bold">{player.location}</div>
          </div>
        </div>
      </div>

      <div className="px-2 py-1">
        <div className="overflow-hidden  rounded-xl">
          <div className="bg-primary500 text-center text-white">Season Stats</div>
          <div className="bg-white">
            <div className="grid w-full grid-cols-[1fr,auto,auto,auto] gap-0.5 ">
              <div className="bg-secondSoft p-1 text-xs font-bold">SEASON</div>
              <div className="bg-secondSoft p-1 text-xs font-bold">HOH</div>
              <div className="bg-secondSoft p-1 text-xs font-bold">POV</div>
              <div className="bg-secondSoft p-1 text-xs font-bold">NOM</div>

              {seasonsArray.map((season, index) => (
                <React.Fragment key={index}>
                  <div className="border-r border-b border-slate-200 p-0.5 px-2 text-sm">
                    <a href={season.link}>{season.abbr}</a>
                  </div>
                  <div className="border-r border-b border-slate-200 p-0.5 px-1 text-center text-sm">{season.hoh_wins}</div>
                  <div className="border-r border-b border-slate-200 p-0.5 px-1 text-center text-sm">{season.pov_wins}</div>
                  <div className=" border-b border-slate-200 p-0.5 px-1 text-center text-sm">{season.nom}</div>
                </React.Fragment>
              ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default PlayerCard;

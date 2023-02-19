import React, { useState, useEffect } from "react";
import axios from "axios";
import PostList from "./PostList";

const FeedUpdatesPage = () => {
  const [posts, setPosts] = useState([]);
  const [lastViewedIDfromStorage, setLastViewedIDfromStorage] = useState(localStorage.getItem("lastViewedPostId"));
  const [lastViewedPostID, setLastViewedPostID] = useState([]);
  const [lastViewedTimestamp, setLastViewedTimestamp] = useState(localStorage.getItem("lastViewedTimestamp"));

  useEffect(() => {
    const fetchData = async () => {
      const result = await axios.get("/wp-json/bbj/v1/feed-updates", {
        params: {
          mode: "getInitial"
        }
      });
      setPosts(result.data);

      console.log("update");
      console.log(result.data);
    };
    fetchData();

    const checkLatest = async () => {
      const result = await axios.get("/wp-json/bbj/v1/feed-updates", {
        params: {
          mode: "checkLatest"
        }
      });

      const lastPostID = result.data;
      const lastViewedID = parseInt(lastViewedIDfromStorage);

      console.log("check");
      console.log(lastPostID);
      console.log("this is the last viewed post id: " + lastViewedIDfromStorage);

      setLastViewedPostID(result.data);

      if (lastPostID !== lastViewedID) {
        const countResult = await axios.get("/wp-json/bbj/v1/feed-updates", {
          params: {
            mode: "getCount",
            originalPost: lastViewedIDfromStorage,
            latestPost: lastPostID
          }
        });

        const count = countResult.data;

        console.log("You have " + count + " new posts");
      }
    };

    const interval = setInterval(() => {
      checkLatest();
    }, 4500);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="mt-6">
      <PostList posts={posts} lastViewedPostID={lastViewedPostID} />
    </div>
  );
};

export default FeedUpdatesPage;

import { useEffect } from "react";

const Redirect = () => {
  useEffect(() => {
    window.location.replace("http://localhost/sets/");
  }, []);

  return null; 
};

export default Redirect;

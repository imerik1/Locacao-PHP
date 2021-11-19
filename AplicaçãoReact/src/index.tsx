/* eslint-disable no-restricted-globals */
import React from "react";
import ReactDOM from "react-dom";
import reportWebVitals from "./reportWebVitals";
import "semantic-ui-css/semantic.min.css";
import Header from "./components/Header";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import "./styles/Global.css";
import Footer from "./components/Footer";
import Home from "./pages/Home";
import Vehicles from "./pages/Vehicles";
import NewVehicles from "./pages/NewVehicles";

ReactDOM.render(
  <React.StrictMode>
    <Router>
      <Header />
      <Switch>
        <Route path="/new-vehicle" component={NewVehicles} />
        <Route path="/table-vehicles" component={Vehicles} />
        <Route path="/" component={Home} />
      </Switch>
      <Footer />
    </Router>
  </React.StrictMode>,
  document.getElementById("root")
);

reportWebVitals();

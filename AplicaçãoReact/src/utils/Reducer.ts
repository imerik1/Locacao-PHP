import _ from "lodash";
import { IData } from "./Data";

export type State = {
  column: string;
  data: IData[];
  direction: any;
};

const Reducer = (state: any, action: any) => {
  switch (action.type) {
    case "CHANGE_SORT":
      if (state.column === action.column) {
        return {
          ...state,
          data: state.data.slice().reverse(),
          direction:
            state.direction === "ascending" ? "descending" : "ascending",
        };
      }

      return {
        column: action.column,
        data: _.sortBy(state.data, [action.column]),
        direction: "ascending",
      };
    default:
      throw new Error();
  }
};

export default Reducer;

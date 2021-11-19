import { FC } from "react";
import { Table } from "semantic-ui-react";

type Props = {
  dispatch: React.Dispatch<any>;
  direction: any;
  title: any;
  column: string;
};

const ListHeader: FC<Props> = ({ dispatch, direction, title, column }) => {
  return (
    <Table.HeaderCell
      sorted={column === title.object ? direction : null}
      onClick={() => dispatch({ type: "CHANGE_SORT", column: title.object })}
    >
      {title.title}
    </Table.HeaderCell>
  );
};

export default ListHeader;

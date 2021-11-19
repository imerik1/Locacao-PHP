/* eslint-disable no-restricted-globals */
import { FC, useState } from "react";
import { Link } from "react-router-dom";
import { Menu } from "semantic-ui-react";

const Header: FC = () => {
  const [useActive, setActive] = useState<string>(location.pathname);
  return (
    <header>
      <Menu as="nav">
        <Menu.Item
          as="div"
          name="/"
          active={useActive === "/"}
          onClick={(e) => setActive("/")}
        >
          <Link to="/">Página Inicial</Link>
        </Menu.Item>
        <Menu.Item
          as="div"
          name="/table-vehicles"
          active={useActive === "/table-vehicles"}
          onClick={(e) => setActive("/table-vehicles")}
        >
          <Link to="/table-vehicles">Tabela de veículos</Link>
        </Menu.Item>
        {/* <Menu.Item
          name="upload"
          active={useActive === "upload"}
          onClick={(e) => setActive("upload")}
        >
          <Link to="/upload-files">Upload de arquivos</Link>
        </Menu.Item> */}
      </Menu>
    </header>
  );
};

export default Header;

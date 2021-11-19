import { FC } from "react";

const Footer: FC = () => {
  return (
    <footer className="ui inverted vertical footer segment form-page">
      <div
        className="container-footer"
        style={{ maxWidth: "fit-content", margin: "0 auto" }}
      >
        <p>Criado por </p>
        <p>
          <b>Davidson di David</b>,
        </p>
        <p>
          <b>Erik Santana</b>,
        </p>
        <p>
          <b>Jefferson Leonardo</b>,
        </p>
        <p>
          <b>Maithê de Souza</b>
        </p>
      </div>
      <div style={{ maxWidth: "fit-content", margin: "0 auto" }}>
        <a
          style={{ maxWidth: "fit-content", margin: "0 auto" }}
          target="_blank"
          rel="noreferrer"
          href="https://github.com/imerik1/Locacao-PHP"
        >
          Link do repositório
        </a>
      </div>
    </footer>
  );
};

export default Footer;

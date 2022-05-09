# [![WordPressify](https://wordpressify.s3-eu-west-1.amazonaws.com/img/wordpressify-repository-logo.svg#3)](https://www.wordpressify.co/)

[![Version](https://img.shields.io/github/package-json/v/luangjokaj/wordpressify)](https://www.wordpressify.co/)

Automate your WordPress development workflow.

---

## Documentation

For full documentation, visit https://www.wordpressify.co.

### v0.4.0 Changes

v0.4.0 moves NodeJS and all its dependencies into a container to keep your local development environment cleaner and to simplify Wordpressify even more.

1. `npm run dev` replaced with `docker compose up`
1. `npm run env:rebuild` replaced with `docker compose down -v`, then `docker compose build`
1. `npm run prod` replaced with `docker compose run --rm nodejs npm run prod`
1. `npm run backup` replaced with `docker compose run --rm nodejs npm run backup`
1. `npm run lint:css` replaced with `docker compose run --rm nodejs npm run lint:css`

## Community

For help, discussion about best practices, or any other conversation that would benefit from being searchable:

[Discuss WordPressify on GitHub](https://github.com/luangjokaj/wordpressify/discussions)

For casual chit-chat with others using WordPressify:

[Join the Discord Server](https://discord.com/invite/uQFdMddMZw)

# Core Team

<table>
  <tbody>
    <tr>
      <td align="center" valign="top">
        <a href="https://github.com/luangjokaj">
            <img width="150" height="150" src="https://github.com/luangjokaj.png?s=1150">
        </a>
        <br>
        <a href="https://github.com/luangjokaj">Luan Gjokaj</a><br />
      </td>
      <td align="center" valign="top">
        <a href="https://github.com/ribaricplusplus">
            <img width="150" height="150" src="https://github.com/ribaricplusplus.png?s=1150">
        </a>
        <br>
        <a href="https://github.com/ribaricplusplus">Bruno Ribarić</a>
      </td>
     </tr>
  </tbody>
</table>

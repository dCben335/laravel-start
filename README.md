# IUT Docker starter

## Launch environment
From your OS terminal, in the app directory launch.

You can use the VSCode integrated terminal or any external one (macOS Terminal, [iTerm](https://iterm2.com), [Windows Terminal](https://apps.microsoft.com/store/detail/windows-terminal/9N0DX20HK701?hl=fr-fr&gl=fr&icid=CNavAppsWindowsApps) ...) and launch the following command:

```shell
docker compose down && docker compose up -d
```

## Create Laravel app
Open a [container terminal](#container-terminal) in the `app-iut` container and use the following command to create a Laravel project in the `app` directory.

```shell
composer create-project laravel/laravel .
```

> The . indicate to create in the current folder which is `app`

## Git && SSH
To make your project as portable as possible, everything you need is in the `app-iut` container.

### First installation
- Open a [container terminal](#container-terminal) in `app-iut`
- Replace <EMAIL> by your own email and launch: `ssh-keygen -t ed25519 -C "<EMAIL>"`
	- Press **ENTER** three times
- Launch: `eval "$(ssh-agent -s)"`
- Launch: `ssh-add ~/.ssh/id_ed25519`
- Backup the `.docker/ssh` content wherever you want
- Open the `.docker/ssh/id_ed25519.pub` file and copy the content
- On Github > Avatar > Settings > SSH and GPG keys
	- Click on Add SSH key
	- Set `IUT` in **Title** field
	- Paste the `.docker/ssh/id_ed25519.pub` content in **Key** field
- Congratulations 🎉
- Your application can be seen at [localhost:8051](http://localhost:8051)

> Ensure you have correctly save the `.docker/ssh` content in case of someone's dog eat your computer

### Lost previous installation || changed computer || destroyed container
- Keep calm ⚠️
- Clone your repository
- Copy the previously back upped `.docker/ssh` content to the same directory
	- Create it if necessary
- Open a [container terminal](#container-terminal) in `app-iut`
- Launch: `chmod 600 /home/www/.ssh/id_ed25519`
- Launch: `eval "$(ssh-agent -s)"`
- Launch: `ssh-add ~/.ssh/id_ed25519`
- Start a coding session ☕️

## Container terminal
To open this kind of terminal, two possibilities:

### Using Docker Desktop app
- Open dashboard window
- Find the `app-iut` line under **starter** stack
- Click on the three dots action button
- Select `Open in terminal`

### Using VSCode Docker extension
- Open the [command palette](https://docs.github.com/en/codespaces/codespaces-reference/using-the-vs-code-command-palette-in-codespaces#)
- Search `Docker Containers: Attach Shell`
- Select `starter`
- Select `dhonnabhainb/iut-laravel app-iut`

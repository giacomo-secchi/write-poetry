# Write Poetry WordPress Plugin

![Banner](assets/banner-772x250.png)

![Release](https://github.com/giacomo-secchi/write-poetry/actions/workflows/release.yml/badge.svg)
[![WordPress Plugin Download](https://img.shields.io/badge/Download-write--poetry.zip-FA6900)](https://github.com/giacomo-secchi/write-poetry/releases/latest/download/write-poetry.zip)


Welcome to the WritePoetry Repo on GitHub. Here you can find the source code used in the development of the WritePoetry plugin. You can browse the source, look at open issues, contribute code, and keep tracking of ongoing development.

## Getting Started

To get up and running within the WritePoetry Repo, you will need to make sure that you have installed all of the prerequisites.

### Prerequisites

-   [NVM](https://github.com/nvm-sh/nvm#installing-and-updating): While you can always install Node through other means, we recommend using NVM to ensure you're aligned with the version used by our development teams. The repository contains [an `.nvmrc` file](.nvmrc) which helps ensure you are using the correct version of Node.
-   [Docker](https://docs.docker.com/get-docker/):     `wp-env` is powered by Docker. There are instructions available for installing Docker on [Windows](https://docs.docker.com/desktop/install/windows-install/) (we recommend the WSL2 backend), [macOS](https://docs.docker.com/docker-for-mac/install/), and [Linux](https://docs.docker.com/desktop/install/linux-install/).


> NOTE: If Docker Desktop application slows down your local machine, you could consider using [Local WP](https://localwp.com/) as an alternative.
>
> The steps are:
> - Install [Local WP](https://localwp.com/help-docs/getting-started/installing-local/).
> - Create a new website project in Local.
> - Clone the Write Poetry Plugin from GitHub directly into the `wp-content/plugins/` folder of the newly created project.
> - Click on 'Start site' button and you are ready to go!

Once you've installed all of the prerequisites, you can run the following commands to get everything working.

```bash
# Ensure that you're using the correct version of Node
nvm use
# Install the Node.js packages and dependencies
npm install
# Start the local environment
npm run env:start
```

If no `vendor` folder is present, you have to install composer dependencies using this command:

```bash
npm run composer install -- --no-dev --no-interaction --prefer-dist --optimize-autoloader
```


Finally, navigate to http://localhost:8888 in your web browser to see WordPress running with the local WritePietry plugin and Twenty Twenty-Child theme running and activated. Default login credentials are username: admin password: password.

## Debugging
Read the [official `wp-env` documentation](https://github.com/WordPress/gutenberg/tree/trunk/packages/env#using-xdebug) to enable Xdebug when working on this project.

### Xdebug VS Code support

Read the section of the guide that explain [how to enable Xdebug in VS Code](https://github.com/WordPress/gutenberg/blob/trunk/packages/env/README.md#xdebug-ide-support)

Remember that the `pathMappings` inside `.vscode/launch.json` file should be as the following
```json
{
	"pathMappings": {
		"/var/www/html/wp-content/plugins/write-poetry": "${workspaceFolder}/",
		"/var/www/html/wp-content/themes/twentytwenty-child": "${workspaceFolder}/themes/twentytwenty-child/",
		"/var/www/html/wp-content/mu-plugins": "${workspaceFolder}/mu-plugins/"
	}
}
```

## Coding Standard


Run the following command from the root directory to check the code for "sniffs".
```bash
npm run composer run-script check-cs
```

If you were unable to install the Docker program, as an alternative, you can [install composer the traditional way](https://getcomposer.org/download/) and run this command to check for "sniffs".

```bash
vendor/bin/phpcs -ps
```


## Creating a stable release

Contributors who want to make a new release, follow these steps:

1. Change the plugin `version` header field in the [main plugin file](write-poetry.php) and the `Stable tag` field in the Header informations of [readme.txt](readme.txt) file following the [WordPress versioning scheme](https://make.wordpress.org/core/handbook/about/release-cycle/version-numbering/)

**N.B.: Don't forget to update the changelog with the details of the changes made in the new version.**


2. Add a git tag to the last commit with the same number of the plugin version, like this:
```bash
git tag -a 0.2.1 HEAD -m "Release 0.2.1"
```
3. To trigger the release GitHub Action run:
```bash
git push --tags
```

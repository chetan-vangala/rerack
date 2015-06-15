## Development
### Getting Started
[Fork](https://help.github.com/articles/fork-a-repo/#fork-an-example-repository) this repository, and [clone](https://help.github.com/articles/fork-a-repo/#step-2-create-a-local-clone-of-your-fork) it to the dev machine on which you have installed [Node](https://nodejs.org/download/) and [Meteor](https://www.meteor.com/install). Then add the main repository as an upstream remote:

    git remote add upstream git@github.com:platformthirteen/rerack.git

### Install my fork of iron-cli (iron-meteor)
Iron is a command line scaffolding tool for Meteor applications. It generates project structure, files and boilerplate code. It also serves as a proxy for Meteor commands (e.g. `iron run` -> `meteor run`).

    sudo npm install -g https://github.com/chrisbutler/iron-cli/tarball/37d8cf6aa29569a49f6678dabab48fb475b15191

### Run the app
Running the app with Iron will automatically load development environment files on startup (see `config/development`).

    iron run -p 3000

***

## Screenshots

### Landing Page
![landing page screenshot](https://cdn.rerackapp.com/screenshots/rr-landing.jpg)

# ENSIIE Web Project Skeleton

## Install your application
This tutorial will guide you through the installation procedure of the Web Project Skeleton.

The only packages you need to install right now are **docker** and **docker-compose**
* [Install Docker](https://docs.docker.com/install/) :
    * [(Optional: docker w/o sudo on linux)](https://docs.docker.com/install/linux/linux-postinstall/)
* [Install Docker Compose](https://docs.docker.com/compose/install/)

Then, clone the Web Project skeleton on your machine:
* `git clone https://github.com/Kirouane/ensiie-project.git`
* `cd ensiie-project`

The next step is to set some environment variables in the `.env` file
* Open this Skeleton on your favorite IDE : PHPStorm or VSCode.
* Open the file .env
    * DOCKER_USER_ID: to obtain the value of this variable you need to execute this command `$(echo id -u $USER)` on a Terminal. Copy and past the output.
    * REMOTE_HOST: For those who want to use the PHPStorm Debugger, put your IP address. Otherwise, skip this step.

Now, let's begin the installation :
* `make install`. This command may take time.
* That's it! Your website is running [http:localhost:8080](http:localhost:8080)

Below are some useful commands :
* `make stop` Stop the containers
* `make start` Start the containers
* `make db.connect` Connect to th database
* `make phpunit.run` Run the PHPUnit tests
* `make install` Reinstall all containers

## 'version-perso' version
Some issues occured with Docker and the latest working version of the website currently only is available at the following location : https://hovi.iiens.net/MyNewLiife/jeu.php. Please use this version for any further tests.

## How to make your own story
Using the csv to create scenarios actually is pretty simple, but some things can be tricky.

First, requirements for a choice to appear must be specified in the **final node**. A choice leading to this node will only appear if you satisfy the requirements.

Modifiers can be positive or negative. 

Join-X modifiers have the following effect : if 1, join the club, if -1, leave the club, else, do nothing.

If your story doesn't have an end corresponding to the node it ends on, you will not really be able to finish it and to start another one.

## Adding stories to the database easily

In the `csv/` directory you will find a parser. Its use is simple: `cd csv && python3 parser.py *.csv`. The output is by default printed on `stdout`, to allow for easier validation by a human. This output can be redirected or copied at the end of the file `data/db.sql` (be sure to delete any previous version of this output to avoid errors).

The formats for the `.csv` files (content and naming) are given in the documentation of the parser itself (one information per line, one file per node/achievement/end). Any optional information is preceded with `<opt>` and lines numbers are given to help you write them easily.

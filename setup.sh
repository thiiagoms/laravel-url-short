#!/bin/bash

clear

RED="\e[31m"
GREEN="\e[32m"
WHITE="\e[97m"
ENDCOLOR="\e[0m"

echo -e "
${RED}
██╗   ██╗██████╗ ██╗         ███████╗██╗  ██╗ ██████╗ ██████╗ ████████╗
██║   ██║██╔══██╗██║         ██╔════╝██║  ██║██╔═══██╗██╔══██╗╚══██╔══╝
██║   ██║██████╔╝██║         ███████╗███████║██║   ██║██████╔╝   ██║
██║   ██║██╔══██╗██║         ╚════██║██╔══██║██║   ██║██╔══██╗   ██║
╚██████╔╝██║  ██║███████╗    ███████║██║  ██║╚██████╔╝██║  ██║   ██║
 ╚═════╝ ╚═╝  ╚═╝╚══════╝    ╚══════╝╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═╝   ╚═╝
${ENDCOLOR}
${RED}
    [*] Author: Thiago Silva AKA thiiagoms
    [*] E-mail: thiagom.devsec@gmail.com
${ENDCOLOR}
\n";

echo -e "=> SetUp containers\n"

{
    docker-compose up -d
} &> /dev/null

echo -e "\n=> Install app dependencies\n"

{
    docker-compose exec app composer install
} &> /dev/null

echo -e "\n=> Running migrations\n"

{
    docker-compose exec app cp .env.example .env
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate
}  &> /dev/null


echo -e "\n[*] Listening application on ${GREEN}http://localhost:8000\n${ENDCOLOR}"

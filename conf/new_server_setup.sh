#!/bin/bash
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"

apt update

apt upgrade -y

apt install docker-ce git phpunit

usermod -aG docker ${USER}

git clone https://github.com/ras536/DevOpsTeam3.git

cd DevOpsTeam3

curl -L https://github.com/docker/compose/releases/download/1.15.0-rc1/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose

chmod +x /usr/local/bin/docker-compose

docker-compose up

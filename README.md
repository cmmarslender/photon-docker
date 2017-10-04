# Photon Docker

Docker images that contain photon. Primary point of the repo is to have a place for storing the Dockerfiles, but also includes an example docker-compose.yml that shows how the containers can be used together.

### Usage
Run both containers. Name the photon-php container `phpfpm` so nginx can proxy to it correctly, and send traffic to the nginx container.

- [Nginx Container](https://hub.docker.com/r/cmmarslender/photon-nginx/)
- [PHP Container](https://hub.docker.com/r/cmmarslender/photon-php/)

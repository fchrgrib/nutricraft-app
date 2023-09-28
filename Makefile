up:
	- docker compose build
	- docker compose up -d
	- docker image prune

down:
	- docker compose down
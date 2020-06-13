docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphas

docker-build:
	docker-compose up --build -d

install:
	docker exec order_list_php-fpm_1 php composer.phar install

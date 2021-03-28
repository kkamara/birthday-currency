docker-setup:
	docker-compose build # let's build our services
	docker-compose up -d # get services running

backend-install:
	@docker exec bc-app composer i

backend-setup:
	make backend-install
	@docker exec bc-app php artisan key:generate
	@docker exec bc-app php artisan migrate

make backend-seed:
	@docker exec bc-app php artisan db:seed

clean-js-dep:
	@docker exec bc-app bash -c "\
		rm -rf node_modules;\
		rm packagbc-lock.json;\
		npm cache clean --force"

install-js-dep:
	make clean-js-dep
	@docker exec bc-app npm i
	@docker exec bc-app npm run dev

dev:
	make docker-setup
	sleep 30
	make backend-setup
	make backend-seed
	make install-js-dep

watch:
	@docker exec bc-app npm run watch

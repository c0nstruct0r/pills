UID=`id -u`
API_SPEC=backend/spec/spec.yaml
API_OUTPUT=vendor/openapi
DB=check

codegen-back: swagger
	swagger-codegen generate -i public/docs/swagger.json -DmodelDocs=false -DmodelTests=false \
	-l php -o ../api/php

swagger:
	php artisan l5-swagger:generate

migrate:
	php artisan migrate

fresh:
	php artisan migrate:fresh --seed

migrate/redo:
	php artisan migrate:rollback
	php artisan migrate

redo: migrate/redo

seed:
	php artisan db:seed

test:
	./vendor/bin/codecept run

log:
	tail -f -n100 storage/logs/laravel.log

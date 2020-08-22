<?php
/**
 * 提交后，自动部署
 * 需要在项目里设置 WebHook
 **/

chdir(dirname(dirname(dirname(__DIR__))));
passthru('git pull --stat');

//composer
if(trim(`git log --oneline -p -1 --name-status|grep -E '^(M|A)\s+composer'|wc -l`) >= 1){
    passthru('composer install --no-dev');
}

passthru('php artisan config:cache');
passthru('php artisan route:cache');
passthru('php artisan queue:restart');

//migration
if(trim(`git log --oneline -p -1 --name-status|grep -E '^(M|A)\s+database/migrations/'|wc -l`) >= 1){
    passthru('php artisan migrate --force');
}

//icon
if(trim(`git log --oneline -p -1 --name-status|grep -E '^(M|A)\s+icon/'|wc -l`) >= 1){
    passthru('php artisan icon:refresh');
    passthru('php artisan config:cache');
}
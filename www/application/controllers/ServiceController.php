<?php

namespace application\controllers;


class ServiceController
{
    public function db()
    {
        exec('cd .. && vendor/bin/doctrine orm:schema-tool:update --force');

        header("Location: /");
    }
}
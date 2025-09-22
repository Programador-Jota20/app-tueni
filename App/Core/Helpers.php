<?php
use Config\Config;

function asset($path) {
    return Config::BASE_URL . 'assets/' . ltrim($path, '/');
}
function inicio() {
    return Config::BASE_URL;
}
function app() {
    return Config::APP_NAME;
}
function autor() {
    return Config::APP_AUTHOR;
}
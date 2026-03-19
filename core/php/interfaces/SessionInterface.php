<?php
interface SessionInterface {
    public function set(string $key, $value): void;
    public function get(string $key);
}
<?php
interface DatabaseInterface {
    public function realizeQuery(string $query): array;
}
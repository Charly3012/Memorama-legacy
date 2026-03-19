<?php
class DatabaseAdapter implements DatabaseInterface {
    public function realizeQuery(string $query): array
    {
        return DataBaseManager::getInstance() -> realizeQuery($query);
    }
}
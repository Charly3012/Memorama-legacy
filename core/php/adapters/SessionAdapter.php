<?php
class SessionAdapter implements SessionInterface {
    private $oldSession;

    public function __construct() {

        $this->oldSession = new session();
    }

    public function set(string $key, $value): void {
        $this->oldSession->set($key, $value);
    }

    public function get(string $key) {
        return $this->oldSession->get($key);
    }
}
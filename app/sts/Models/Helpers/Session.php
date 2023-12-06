<?php

namespace Sts\Models\Helpers;

class Session {

    private ?array $data;

    public function create(): bool {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
            return true;
        }
        return false;
    }

    public function insert(?string $name = null, $data): void {
        if($this->create()) {
            if(!is_null($name)) {
                $_SESSION[$name] = $data;
            } else {
                $_SESSION = $data;
            }
        }
    }

    public function delete(): void {
        $this->create();
        $_SESSION = [];
        // session_abort();
        session_destroy();

    }

    public function update(?string $name = null, mixed $new): void {
        if(!is_null($name)) {
            $_SESSION[$name] = $new;
        } else {
            $_SESSION = $new;
        }
    }

}
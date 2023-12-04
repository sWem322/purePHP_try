<?php

namespace spaceWeb;

use SessionHandlerInterface;

class Session implements SessionHandlerInterface
{

    function __construct($model)
    {
        $this->model = $model;
    }

    public function open($savePath, $sessionName): bool
    {
        return true;
    }
    public function close(): bool
    {
        return true;
    }

    public function read($id): string
    {
        return $this->model->session_read($id);
    }

    public function write($id, $data): bool
    {
        return $this->model->session_write($id, $data);
    }

    public function destroy($id): bool
    {
        return $this->model->session_destroy($id);
    }

    public function gc($lifetime): bool
    {
        return $this->model->session_gc($lifetime);
    }
}

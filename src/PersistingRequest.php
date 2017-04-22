<?php

namespace dees040\PersistingRequests;

use ReflectionClass;
use Illuminate\Foundation\Http\FormRequest;

class PersistingRequest extends FormRequest
{
    /**
     * Start persisting the current request.
     *
     * @return mixed
     */
    public function persist()
    {
        $reflection = new ReflectionClass($this);

        if ($reflection->hasMethod('persisting')) {
            return $this->container->call($reflection->getName() . '@persisting');
        }

        return null;
    }
}
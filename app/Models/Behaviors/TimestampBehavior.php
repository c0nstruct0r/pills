<?php

namespace App\Models\Behaviors;

trait TimestampBehavior
{
    public function save(array $options = []): bool
    {
        $this->created_at = $this->created_at ?? time();
        $this->updated_at = time();

        return parent::save($options);
    }
}
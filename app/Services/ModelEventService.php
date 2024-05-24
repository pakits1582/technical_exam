<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ModelEventService
{
    public function handleCreated($model)
    {
        $this->logEvent('created', $model);
    }

    public function handleUpdated($model)
    {
        $changes = [
            'old' => $model->getOriginal(),
            'new' => $model->getChanges(),
        ];
        $this->logEvent('updated', $model, $changes);
    }

    public function handleDeleted($model)
    {
        $this->logEvent('deleted', $model);
    }

    protected function logEvent($event, $model, $changes = null)
    {
        $userId = Auth::check() ? Auth::id() : 'guest';
        $logData = [
            'event' => $event,
            'model' => get_class($model),
            'record_id' => $model->getKey(),
            'user_id' => $userId,
        ];

        if ($changes) {
            $logData['changes'] = $changes;
        }

        Log::info('Model event:', $logData);
    }
}

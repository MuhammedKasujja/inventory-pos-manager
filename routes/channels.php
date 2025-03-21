<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('sync_local_data', function () {
    return true;
});

Broadcast::channel('sent-messages', function () {
    return true;
});

<?php

Route::get('fontawesome', function() {
    $icons = file(__DIR__.'/../fontawesome-icons.txt', FILE_IGNORE_NEW_LINES);

    return View::make('fontawesome::home')
        ->with('icons', $icons);
});

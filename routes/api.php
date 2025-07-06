<?php

$apis = [

    '/insert_profile'    => ['controller' => 'add_user_preferences', 'method' => 'insertUserPreference'],
    '/update_profile'    => ['controller' => 'add_user_preferences', 'method' => 'updateUserPreference'],
    '/save_profile'    => ['controller' => 'add_user_preferences', 'method' => 'saveUserPreference'],


    '/seaget_movies_detailsts'=> ['controller' => 'get_movies_details', 'method' => 'getMovieDetails'],
    '/get_reserved_seats' => ['controller' => 'get_reserved_seats', 'method' => 'getReservedSeats'],


    '/login'             => ['controller' => 'login', 'method' => 'login'],
    '/register'          => ['controller' => 'register', 'method' => 'register']

];


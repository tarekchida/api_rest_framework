<?php

/*
 * Add routes to your app here 
 *
 */

$router->get('/', 'IndexController#home');

$router->get('/get-user', 'UsersController#get');

$router->get('/get-song', 'SongsController#get');

$router->get('/get-user-playlist', 'PlaylistsController#getByUser');

$router->post('/add-song', 'PlaylistsController#addSong');

$router->post('/remove-song', 'PlaylistsController#removeSong');

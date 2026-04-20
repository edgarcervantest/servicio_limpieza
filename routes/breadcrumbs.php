<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('home'));
});

Breadcrumbs::for('create', function (BreadcrumbTrail $trail) {
    $trail->parent('home'); //padre de la breadcrumb
    $trail->push('Crear nueva orden', route('orders.create'));
});

Breadcrumbs::for('welcome', function (BreadcrumbTrail $trail) {
    $trail->push('Inicio', route('welcome'));
});

Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('welcome'); //padre de la breadcrumb
    $trail->push('Iniciar sesión', route('login'));
});

Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('welcome'); //padre de la breadcrumb
    $trail->push('Registrarse', route('register'));
});
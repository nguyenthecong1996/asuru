<?php 
use Diglactic\Breadcrumbs\Breadcrumbs;


Breadcrumbs::for('customers', function ($trail) {
    // $trail->parent('dashboard');
    $trail->push('Customers Management', route('customers.index'));
});

Breadcrumbs::for('create-customer', function ($trail) {
    $trail->parent('customers');
    $trail->push('Add customer', route('customers.create'));
});

Breadcrumbs::for('edit-customer', function ($trail, $id) {
    $trail->parent('customers');
    $trail->push('Edit customer', route('customers.edit', ['id' => $id]));
});
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            [
                'id' => 1,
                'controller' => 'ApiController',
                'method' => 'products'
            ],
            [
                'id' => 2,
                'controller' => 'ApiController',
                'method' => 'users'
            ],
            [
                'id' => 3,
                'controller' => 'ApiController',
                'method' => 'categories'
            ],
            [
                'id' => 4,
                'controller' => 'ApiController',
                'method' => 'stores'
            ],
            [
                'id' => 5,
                'controller' => 'ApiController',
                'method' => 'checkConnection'
            ],
            [
                'id' => 6,
                'controller' => 'ApiController',
                'method' => 'getProduct'
            ],
            [
                'id' => 7,
                'controller' => 'ApiController',
                'method' => 'getUser'
            ],
            [
                'id' => 8,
                'controller' => 'ApiController',
                'method' => 'getCategory'
            ],
            [
                'id' => 9,
                'controller' => 'ApiController',
                'method' => 'getStore'
            ],
            [
                'id' => 10,
                'controller' => 'ApiKeyController',
                'method' => 'generateApiKey'
            ],
            [
                'id' => 11,
                'controller' => 'HomeController',
                'method' => 'index'
            ],
            [
                'id' => 12,
                'controller' => 'HomeController',
                'method' => 'about'
            ],
            [
                'id' => 13,
                'controller' => 'HomeController',
                'method' => 'contact'
            ],
            [
                'id' => 14,
                'controller' => 'HomeController',
                'method' => 'stores'
            ],
            [
                'id' => 15,
                'controller' => 'MenuController',
                'method' => 'menu'
            ],
            [
                'id' => 16,
                'controller' => 'MenuController',
                'method' => 'category'
            ],
            [
                'id' => 17,
                'controller' => 'MenuController',
                'method' => 'detail'
            ],
            [
                'id' => 18,
                'controller' => 'MenuController',
                'method' => 'search'
            ],
            [
                'id' => 19,
                'controller' => 'CartController',
                'method' => 'show'
            ],
            [
                'id' => 20,
                'controller' => 'CartController',
                'method' => 'placeOrder'
            ],
            [
                'id' => 21,
                'controller' => 'CartController',
                'method' => 'add'
            ],
            [
                'id' => 22,
                'controller' => 'CartController',
                'method' => 'remove'
            ],
            [
                'id' => 23,
                'controller' => 'CartController',
                'method' => 'edit'
            ],
            [
                'id' => 24,
                'controller' => 'ProfileController',
                'method' => 'profile'
            ],
            [
                'id' => 25,
                'controller' => 'CartController',
                'method' => 'notice'
            ],
            [
                'id' => 26,
                'controller' => 'OrderController',
                'method' => 'orders'
            ],
            [
                'id' => 27,
                'controller' => 'OrderController',
                'method' => 'orderDetail'
            ],
            [
                'id' => 28,
                'controller' => 'AdminController',
                'method' => 'index'
            ],
            [
                'id' => 29,
                'controller' => 'ProductController',
                'method' => 'index'
            ],
            [
                'id' => 30,
                'controller' => 'ProductController',
                'method' => 'delete'
            ],
            [
                'id' => 31,
                'controller' => 'ProductController',
                'method' => 'update'
            ],
            [
                'id' => 32,
                'controller' => 'ProductController',
                'method' => 'create'
            ],
            [
                'id' => 33,
                'controller' => 'ProductController',
                'method' => 'detail'
            ],
            [
                'id' => 34,
                'controller' => 'CategoryController',
                'method' => 'index'
            ],
            [
                'id' => 35,
                'controller' => 'CategoryController',
                'method' => 'delete'
            ],
            [
                'id' => 36,
                'controller' => 'CategoryController',
                'method' => 'update'
            ],
            [
                'id' => 37,
                'controller' => 'CategoryController',
                'method' => 'create'
            ],
            [
                'id' => 38,
                'controller' => 'CategoryController',
                'method' => 'detail'
            ],
            [
                'id' => 39,
                'controller' => 'UserController',
                'method' => 'index'
            ],
            [
                'id' => 40,
                'controller' => 'UserController',
                'method' => 'delete'
            ],
            [
                'id' => 41,
                'controller' => 'UserController',
                'method' => 'update'
            ],
            [
                'id' => 42,
                'controller' => 'UserController',
                'method' => 'create'
            ],
            [
                'id' => 43,
                'controller' => 'UserController',
                'method' => 'detail'
            ],
            [
                'id' => 44,
                'controller' => 'StoreController',
                'method' => 'index'
            ],
            [
                'id' => 45,
                'controller' => 'StoreController',
                'method' => 'delete'
            ],
            [
                'id' => 46,
                'controller' => 'StoreController',
                'method' => 'update'
            ],
            [
                'id' => 47,
                'controller' => 'StoreController',
                'method' => 'create'
            ],
            [
                'id' => 48,
                'controller' => 'StoreController',
                'method' => 'detail'
            ],
            [
                'id' => 49,
                'controller' => 'InvoiceController',
                'method' => 'index'
            ],
            [
                'id' => 50,
                'controller' => 'InvoiceController',
                'method' => 'delete'
            ],
            [
                'id' => 51,
                'controller' => 'OrderController',
                'method' => 'acceptOrder'
            ],
            [
                'id' => 52,
                'controller' => 'OrderController',
                'method' => 'rejectOrder'
            ],
            [
                'id' => 53,
                'controller' => 'InvoiceController',
                'method' => 'invoiceDetail'
            ],
            [
                'id' => 54,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderIndex'
            ],
            [
                'id' => 55,
                'controller' => 'OrderController',
                'method' => 'rejectedOrderIndex'
            ],
            [
                'id' => 56,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail'
            ],
            [
                'id' => 57,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail'
            ],
            [
                'id' => 58,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail'
            ],
            [
                'id' => 59,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail'
            ],
            [
                'id' => 60,
                'controller' => 'InvoiceController',
                'method' => 'invoiceForm'
            ],
            [
                'id' => 61,
                'controller' => 'ApiKeyController',
                'method' => 'index'
            ],
            [
                'id' => 62,
                'controller' => 'ApiKeyController',
                'method' => 'delete'
            ],
            [
                'id' => 63,
                'controller' => 'ApiKeyController',
                'method' => 'update'
            ],
            [
                'id' => 64,
                'controller' => 'ApiKeyController',
                'method' => 'create'
            ],
            [
                'id' => 65,
                'controller' => 'ApiKeyController',
                'method' => 'detail'
            ],
            [
                'id' => 66,
                'controller' => 'UserGroupController',
                'method' => 'index'
            ],
            [
                'id' => 67,
                'controller' => 'UserGroupController',
                'method' => 'delete'
            ],
            [
                'id' => 68,
                'controller' => 'UserGroupController',
                'method' => 'update'
            ],
            [
                'id' => 69,
                'controller' => 'UserGroupController',
                'method' => 'create'
            ],
            [
                'id' => 70,
                'controller' => 'UserGroupController',
                'method' => 'detail'
            ],
            [
                'id' => 71,
                'controller' => 'UserRoleController',
                'method' => 'index'
            ],
            [
                'id' => 72,
                'controller' => 'UserRoleController',
                'method' => 'delete'
            ],
            [
                'id' => 73,
                'controller' => 'UserRoleController',
                'method' => 'update'
            ],
            [
                'id' => 74,
                'controller' => 'UserRoleController',
                'method' => 'create'
            ],
            [
                'id' => 75,
                'controller' => 'UserRoleController',
                'method' => 'detail'
            ],
            [
                'id' => 76,
                'controller' => 'RoleGroupController',
                'method' => 'index'
            ],
            [
                'id' => 77,
                'controller' => 'RoleGroupController',
                'method' => 'delete'
            ],
            [
                'id' => 78,
                'controller' => 'RoleGroupController',
                'method' => 'update'
            ],
            [
                'id' => 79,
                'controller' => 'RoleGroupController',
                'method' => 'create'
            ],
            [
                'id' => 80,
                'controller' => 'RoleGroupController',
                'method' => 'detail'
            ],
            [
                'id' => 81,
                'controller' => 'ActionController',
                'method' => 'index'
            ],
            [
                'id' => 82,
                'controller' => 'ActionController',
                'method' => 'delete'
            ],
            [
                'id' => 83,
                'controller' => 'ActionController',
                'method' => 'update'
            ],
            [
                'id' => 84,
                'controller' => 'ActionController',
                'method' => 'create'
            ],
            [
                'id' => 85,
                'controller' => 'ActionController',
                'method' => 'detail'
            ],
        ];

        DB::table('actions')->insert($actions);
    }
}

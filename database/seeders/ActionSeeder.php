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
                'method' => 'products',
                'resource_id' => 1,
                'permission_id' => 3
            ],
            [
                'id' => 2,
                'controller' => 'ApiController',
                'method' => 'users',
                'resource_id' => 3,
                'permission_id' => 3
            ],
            [
                'id' => 3,
                'controller' => 'ApiController',
                'method' => 'categories',
                'resource_id' => 2,
                'permission_id' => 3
            ],
            [
                'id' => 4,
                'controller' => 'ApiController',
                'method' => 'stores',
                'resource_id' => 7,
                'permission_id' => 3
            ],
            [
                'id' => 5,
                'controller' => 'ApiController',
                'method' => 'checkConnection',
                'resource_id' => 8,
                'permission_id' => 3 
            ],
            [
                'id' => 6,
                'controller' => 'ApiController',
                'method' => 'getProduct',
                'resource_id' => 1,
                'permission_id' => 3 
            ],
            [
                'id' => 7,
                'controller' => 'ApiController',
                'method' => 'getUser',
                'resource_id' => 3,
                'permission_id' => 3 
            ],
            [
                'id' => 8,
                'controller' => 'ApiController',
                'method' => 'getCategory',
                'resource_id' => 2,
                'permission_id' => 3 
            ],
            [
                'id' => 9,
                'controller' => 'ApiController',
                'method' => 'getStore',
                'resource_id' => 7,
                'permission_id' => 3 
            ],
            [
                'id' => 10,
                'controller' => 'ApiKeyController',
                'method' => 'generateApiKey',
                'resource_id' => 8,
                'permission_id' => 1 
            ],
            [
                'id' => 11,
                'controller' => 'HomeController',
                'method' => 'index',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 12,
                'controller' => 'HomeController',
                'method' => 'about',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 13,
                'controller' => 'HomeController',
                'method' => 'contact',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 14,
                'controller' => 'HomeController',
                'method' => 'stores',
                'resource_id' => 7,
                'permission_id' => 3 
            ],
            [
                'id' => 15,
                'controller' => 'MenuController',
                'method' => 'menu',
                'resource_id' => 1,
                'permission_id' => 3 
            ],
            [
                'id' => 16,
                'controller' => 'MenuController',
                'method' => 'category',
                'resource_id' => 2,
                'permission_id' => 3 
            ],
            [
                'id' => 17,
                'controller' => 'MenuController',
                'method' => 'detail',
                'resource_id' => 1,
                'permission_id' => 3 
            ],
            [
                'id' => 18,
                'controller' => 'MenuController',
                'method' => 'search',
                'resource_id' => 1,
                'permission_id' => 3 
            ],
            [
                'id' => 19,
                'controller' => 'CartController',
                'method' => 'showCart',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 20,
                'controller' => 'CartController',
                'method' => 'placeOrderCart',
                'resource_id' => 4,
                'permission_id' => 1  
            ],
            [
                'id' => 21,
                'controller' => 'CartController',
                'method' => 'addCartItem',
                'resource_id' => 10,
                'permission_id' => 1
            ],
            [
                'id' => 22,
                'controller' => 'CartController',
                'method' => 'removeCartItem',
                'resource_id' => 10,
                'permission_id' => 4
            ],
            [
                'id' => 23,
                'controller' => 'CartController',
                'method' => 'editCartItem',
                'resource_id' => 10,
                'permission_id' => 2
            ],
            [
                'id' => 24,
                'controller' => 'ProfileController',
                'method' => 'profile',
                'resource_id' => 12,
                'permission_id' => 1
            ],
            [
                'id' => 25,
                'controller' => 'CartController',
                'method' => 'notice',
                'resource_id' => 9,
                'permission_id' => 1 
            ],
            [
                'id' => 26,
                'controller' => 'OrderController',
                'method' => 'orders',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 27,
                'controller' => 'OrderController',
                'method' => 'orderDetail',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 28,
                'controller' => 'AdminController',
                'method' => 'index',
                'resource_id' => 9,
                'permission_id' => 3 
            ],
            [
                'id' => 29,
                'controller' => 'ProductController',
                'method' => 'index',
                'resource_id' => 1,
                'permission_id' => 3 
            ],
            [
                'id' => 30,
                'controller' => 'ProductController',
                'method' => 'deleteProduct',
                'resource_id' => 1,
                'permission_id' => 4 
            ],
            [
                'id' => 31,
                'controller' => 'ProductController',
                'method' => 'updateProduct',
                'resource_id' => 1,
                'permission_id' => 2 
            ],
            [
                'id' => 32,
                'controller' => 'ProductController',
                'method' => 'createProduct',
                'resource_id' => 1,
                'permission_id' => 1 
            ],
            [
                'id' => 33,
                'controller' => 'ProductController',
                'method' => 'detailProduct',
                'resource_id' => 1,
                'permission_id' => 3 
            ],
            [
                'id' => 34,
                'controller' => 'CategoryController',
                'method' => 'index',
                'resource_id' => 2,
                'permission_id' => 3 
            ],
            [
                'id' => 35,
                'controller' => 'CategoryController',
                'method' => 'deleteCategory',
                'resource_id' => 2,
                'permission_id' => 4 
            ],
            [
                'id' => 36,
                'controller' => 'CategoryController',
                'method' => 'updateCategory',
                'resource_id' => 2,
                'permission_id' => 2 
            ],
            [
                'id' => 37,
                'controller' => 'CategoryController',
                'method' => 'createCategory',
                'resource_id' => 2,
                'permission_id' => 1 
            ],
            [
                'id' => 38,
                'controller' => 'CategoryController',
                'method' => 'detailCategory',
                'resource_id' => 2,
                'permission_id' => 3 
            ],
            [
                'id' => 39,
                'controller' => 'UserController',
                'method' => 'index',
                'resource_id' => 3,
                'permission_id' => 3 
            ],
            [
                'id' => 40,
                'controller' => 'UserController',
                'method' => 'deleteUser',
                'resource_id' => 3,
                'permission_id' => 4 
            ],
            [
                'id' => 41,
                'controller' => 'UserController',
                'method' => 'updateUser',
                'resource_id' => 3,
                'permission_id' => 2 
            ],
            [
                'id' => 42,
                'controller' => 'UserController',
                'method' => 'createUser',
                'resource_id' => 3,
                'permission_id' => 1 
            ],
            [
                'id' => 43,
                'controller' => 'UserController',
                'method' => 'detailUser',
                'resource_id' => 3,
                'permission_id' => 3 
            ],
            [
                'id' => 44,
                'controller' => 'StoreController',
                'method' => 'index',
                'resource_id' => 7,
                'permission_id' => 1 
            ],
            [
                'id' => 45,
                'controller' => 'StoreController',
                'method' => 'deleteStore',
                'resource_id' => 7,
                'permission_id' => 4 
            ],
            [
                'id' => 46,
                'controller' => 'StoreController',
                'method' => 'updateStore',
                'resource_id' => 7,
                'permission_id' => 2 
            ],
            [
                'id' => 47,
                'controller' => 'StoreController',
                'method' => 'createStore',
                'resource_id' => 7,
                'permission_id' => 1 
            ],
            [
                'id' => 48,
                'controller' => 'StoreController',
                'method' => 'detailStore',
                'resource_id' => 7,
                'permission_id' => 3 
            ],
            [
                'id' => 49,
                'controller' => 'InvoiceController',
                'method' => 'index',
                'resource_id' => 5,
                'permission_id' => 3 
            ],
            [
                'id' => 50,
                'controller' => 'InvoiceController',
                'method' => 'deleteInvoice',
                'resource_id' => 5,
                'permission_id' => 4 
            ],
            [
                'id' => 51,
                'controller' => 'OrderController',
                'method' => 'acceptOrder',
                'resource_id' => 3,
                'permission_id' => 2 
            ],
            [
                'id' => 52,
                'controller' => 'OrderController',
                'method' => 'rejectOrder',
                'resource_id' => 4,
                'permission_id' => 2 
            ],
            [
                'id' => 53,
                'controller' => 'InvoiceController',
                'method' => 'invoiceDetail',
                'resource_id' => 5,
                'permission_id' => 3 
            ],
            [
                'id' => 54,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderIndex',
                'resource_id' => 4,
                'permission_id' => 3  
            ],
            [
                'id' => 55,
                'controller' => 'OrderController',
                'method' => 'rejectedOrderIndex',
                'resource_id' => 4,
                'permission_id' => 3 
            ],
            [
                'id' => 56,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail',
                'resource_id' => 4,
                'permission_id' => 3 
            ],
            [
                'id' => 57,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail',
                'resource_id' => 4,
                'permission_id' => 3 
            ],
            [
                'id' => 58,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail',
                'resource_id' => 4,
                'permission_id' => 3 
            ],
            [
                'id' => 59,
                'controller' => 'OrderController',
                'method' => 'acceptedOrderDetail',
                'resource_id' => 4,
                'permission_id' => 3 
            ],
            [
                'id' => 60,
                'controller' => 'InvoiceController',
                'method' => 'invoiceForm',
                'resource_id' => 5,
                'permission_id' => 3 
            ],
            [
                'id' => 61,
                'controller' => 'ApiKeyController',
                'method' => 'index',
                'resource_id' => 8,
                'permission_id' => 3 
            ],
            [
                'id' => 62,
                'controller' => 'ApiKeyController',
                'method' => 'deleteApiKey',
                'resource_id' => 8,
                'permission_id' => 4 
            ],
            [
                'id' => 63,
                'controller' => 'ApiKeyController',
                'method' => 'updateApiKey',
                'resource_id' => 8,
                'permission_id' => 2 
            ],
            [
                'id' => 64,
                'controller' => 'ApiKeyController',
                'method' => 'createApiKey',
                'resource_id' => 8,
                'permission_id' => 1 
            ],
            [
                'id' => 65,
                'controller' => 'ApiKeyController',
                'method' => 'detailApiKey',
                'resource_id' => 8,
                'permission_id' => 3 
            ],
            [
                'id' => 66,
                'controller' => 'UserGroupController',
                'method' => 'index',
                'resource_id' => 13,
                'permission_id' => 3
            ],
            [
                'id' => 67,
                'controller' => 'UserGroupController',
                'method' => 'deleteUserGroup',
                'resource_id' => 13,
                'permission_id' => 4
            ],
            [
                'id' => 68,
                'controller' => 'UserGroupController',
                'method' => 'updateUserGroup',
                'resource_id' => 13,
                'permission_id' => 2
            ],
            [
                'id' => 69,
                'controller' => 'UserGroupController',
                'method' => 'createUserGroup',
                'resource_id' => 13,
                'permission_id' => 1
            ],
            [
                'id' => 70,
                'controller' => 'UserGroupController',
                'method' => 'detailUserGroup',
                'resource_id' => 13,
                'permission_id' => 3
            ],
            [
                'id' => 71,
                'controller' => 'UserRoleController',
                'method' => 'index',
                'resource_id' => 14,
                'permission_id' => 3
            ],
            [
                'id' => 72,
                'controller' => 'UserRoleController',
                'method' => 'deleteUserRole',
                'resource_id' => 14,
                'permission_id' => 4
            ],
            [
                'id' => 73,
                'controller' => 'UserRoleController',
                'method' => 'updateUserRole',
                'resource_id' => 14,
                'permission_id' => 2
            ],
            [
                'id' => 74,
                'controller' => 'UserRoleController',
                'method' => 'createUserRole',
                'resource_id' => 14,
                'permission_id' => 1
            ],
            [
                'id' => 75,
                'controller' => 'UserRoleController',
                'method' => 'detailUserRole',
                'resource_id' => 14,
                'permission_id' => 3
            ],
            [
                'id' => 76,
                'controller' => 'RoleGroupController',
                'method' => 'index',
                'resource_id' => 15,
                'permission_id' => 3
            ],
            [
                'id' => 77,
                'controller' => 'RoleGroupController',
                'method' => 'deleteRoleGroup',
                'resource_id' => 15,
                'permission_id' => 4
            ],
            [
                'id' => 78,
                'controller' => 'RoleGroupController',
                'method' => 'updateRoleGroup',
                'resource_id' => 15,
                'permission_id' => 2
            ],
            [
                'id' => 79,
                'controller' => 'RoleGroupController',
                'method' => 'createRoleGroup',
                'resource_id' => 15,
                'permission_id' => 1
            ],
            [
                'id' => 80,
                'controller' => 'RoleGroupController',
                'method' => 'detailRoleGroup',
                'resource_id' => 15,
                'permission_id' => 3
            ],
            [
                'id' => 81,
                'controller' => 'ActionController',
                'method' => 'index',
                'resource_id' => 16,
                'permission_id' => 3
            ],
            [
                'id' => 82,
                'controller' => 'ActionController',
                'method' => 'deleteAction',
                'resource_id' => 16,
                'permission_id' => 4
            ],
            [
                'id' => 83,
                'controller' => 'ActionController',
                'method' => 'updateAction',
                'resource_id' => 16,
                'permission_id' => 2
            ],
            [
                'id' => 84,
                'controller' => 'ActionController',
                'method' => 'createAction',
                'resource_id' => 16,
                'permission_id' => 1
            ],
            [
                'id' => 85,
                'controller' => 'ActionController',
                'method' => 'detailAction',
                'resource_id' => 16,
                'permission_id' => 3
            ],
            [
                'id' => 86,
                'controller' => 'ApiController',
                'method' => 'updateProduct',
                'resource_id' => 1,
                'permission_id' => 2
            ],
        ];

        DB::table('actions')->insert($actions);
    }
}

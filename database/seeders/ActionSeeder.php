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
                'method' => 'showCart'
            ],
            [
                'id' => 20,
                'controller' => 'CartController',
                'method' => 'placeOrderCart'
            ],
            [
                'id' => 21,
                'controller' => 'CartController',
                'method' => 'addCartItem'
            ],
            [
                'id' => 22,
                'controller' => 'CartController',
                'method' => 'removeCartItem'
            ],
            [
                'id' => 23,
                'controller' => 'CartController',
                'method' => 'editCartItem'
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
                'method' => 'deleteProduct'
            ],
            [
                'id' => 31,
                'controller' => 'ProductController',
                'method' => 'updateProduct'
            ],
            [
                'id' => 32,
                'controller' => 'ProductController',
                'method' => 'createProduct'
            ],
            [
                'id' => 33,
                'controller' => 'ProductController',
                'method' => 'detailProduct'
            ],
            [
                'id' => 34,
                'controller' => 'CategoryController',
                'method' => 'index'
            ],
            [
                'id' => 35,
                'controller' => 'CategoryController',
                'method' => 'deleteCategory'
            ],
            [
                'id' => 36,
                'controller' => 'CategoryController',
                'method' => 'updateCategory'
            ],
            [
                'id' => 37,
                'controller' => 'CategoryController',
                'method' => 'createCategory'
            ],
            [
                'id' => 38,
                'controller' => 'CategoryController',
                'method' => 'detailCategory'
            ],
            [
                'id' => 39,
                'controller' => 'UserController',
                'method' => 'index'
            ],
            [
                'id' => 40,
                'controller' => 'UserController',
                'method' => 'deleteUser'
            ],
            [
                'id' => 41,
                'controller' => 'UserController',
                'method' => 'updateUser'
            ],
            [
                'id' => 42,
                'controller' => 'UserController',
                'method' => 'createUser'
            ],
            [
                'id' => 43,
                'controller' => 'UserController',
                'method' => 'detailUser'
            ],
            [
                'id' => 44,
                'controller' => 'StoreController',
                'method' => 'index'
            ],
            [
                'id' => 45,
                'controller' => 'StoreController',
                'method' => 'deleteStore'
            ],
            [
                'id' => 46,
                'controller' => 'StoreController',
                'method' => 'updateStore'
            ],
            [
                'id' => 47,
                'controller' => 'StoreController',
                'method' => 'createStore'
            ],
            [
                'id' => 48,
                'controller' => 'StoreController',
                'method' => 'detailStore'
            ],
            [
                'id' => 49,
                'controller' => 'InvoiceController',
                'method' => 'index'
            ],
            [
                'id' => 50,
                'controller' => 'InvoiceController',
                'method' => 'deleteInvoice'
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
                'method' => 'deleteApiKey'
            ],
            [
                'id' => 63,
                'controller' => 'ApiKeyController',
                'method' => 'updateApiKey'
            ],
            [
                'id' => 64,
                'controller' => 'ApiKeyController',
                'method' => 'createApiKey'
            ],
            [
                'id' => 65,
                'controller' => 'ApiKeyController',
                'method' => 'detailApiKey'
            ],
            [
                'id' => 66,
                'controller' => 'UserGroupController',
                'method' => 'index'
            ],
            [
                'id' => 67,
                'controller' => 'UserGroupController',
                'method' => 'deleteUserGroup'
            ],
            [
                'id' => 68,
                'controller' => 'UserGroupController',
                'method' => 'updateUserGroup'
            ],
            [
                'id' => 69,
                'controller' => 'UserGroupController',
                'method' => 'createUserGroup'
            ],
            [
                'id' => 70,
                'controller' => 'UserGroupController',
                'method' => 'detailUserGroup'
            ],
            [
                'id' => 71,
                'controller' => 'UserRoleController',
                'method' => 'index'
            ],
            [
                'id' => 72,
                'controller' => 'UserRoleController',
                'method' => 'deleteUserRole'
            ],
            [
                'id' => 73,
                'controller' => 'UserRoleController',
                'method' => 'updateUserRole'
            ],
            [
                'id' => 74,
                'controller' => 'UserRoleController',
                'method' => 'createUserRole'
            ],
            [
                'id' => 75,
                'controller' => 'UserRoleController',
                'method' => 'detailUserRole'
            ],
            [
                'id' => 76,
                'controller' => 'RoleGroupController',
                'method' => 'index'
            ],
            [
                'id' => 77,
                'controller' => 'RoleGroupController',
                'method' => 'deleteRoleGroup'
            ],
            [
                'id' => 78,
                'controller' => 'RoleGroupController',
                'method' => 'updateRoleGroup'
            ],
            [
                'id' => 79,
                'controller' => 'RoleGroupController',
                'method' => 'createRoleGroup'
            ],
            [
                'id' => 80,
                'controller' => 'RoleGroupController',
                'method' => 'detailRoleGroup'
            ],
            [
                'id' => 81,
                'controller' => 'ActionController',
                'method' => 'index'
            ],
            [
                'id' => 82,
                'controller' => 'ActionController',
                'method' => 'deleteAction'
            ],
            [
                'id' => 83,
                'controller' => 'ActionController',
                'method' => 'updateAction'
            ],
            [
                'id' => 84,
                'controller' => 'ActionController',
                'method' => 'createAction'
            ],
            [
                'id' => 85,
                'controller' => 'ActionController',
                'method' => 'detailAction'
            ],
        ];

        DB::table('actions')->insert($actions);
    }
}

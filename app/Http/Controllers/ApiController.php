<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Store;
use App\Exceptions\InvalidApiKeyException;
use App\Exceptions\InvalidParameterException;
use App\Exceptions\NotFoundException;
use App\Exceptions\DeleteFailedException;
use App\Exceptions\UpdateFailedException;
use App\Exceptions\NotEnoughStockException;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\UserService;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\StoreService;
use App\Services\ApiService;
use App\Services\TaxService;
use App\Http\Requests\QueryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProductVariantRequest;
use App\Models\PaymentMode;
use App\Models\Tax;

class ApiController extends Controller
{
    private $cartService;
    private $orderService;
    private $userService;
    private $productService;
    private $categoryService;
    private $storeService;
    private $apiService;
    private $taxService;

    public function __construct(
        CartService $cartService,
        OrderService $orderService,
        UserService $userService,
        ProductService $productService,
        CategoryService $categoryService,
        StoreService $storeService,
        ApiService $apiService,
        TaxService $taxService
    )
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->userService = $userService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->storeService = $storeService;
        $this->apiService = $apiService;
        $this->taxService = $taxService;
    }

    private function errorResponse(\Exception $exception, int $statusCode = 400, string $data = null): JsonResponse
    {
        $message = 'Failed';
        $responseData = $data ?? $exception->getMessage();
        $responseCode = $statusCode ?? $exception->getCode();

        if ($exception instanceof InvalidParameterException) {
            $message = 'Validation parameters errors';
        } elseif ($exception instanceof NotFoundException) {
            $message = 'Not found errors';
        } elseif ($exception instanceof InvalidApiKeyException) {
            $message = 'Validation api key errors';
        } elseif ($exception instanceof DeleteFailedException) {
            $message = 'Delete record failed';
        } elseif ($exception instanceof UpdateFailedException) {
            $message = 'Update record failed';
        } elseif ($exception instanceof NotEnoughStockException) {
            $message = 'Insufficient stock for product variant';
        } else {
            $message = 'Runtime errors';
            $data = "An error occurred: " . $responseData;
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $responseData,
        ], $responseCode);
    }


    private function successResponse($data, string $message = "success", int $statusCode = 200): JsonResponse
    {
        if (isset($data['pagination'])) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data['data'],
                'pagination' => $data['pagination']
            ], $statusCode);
        } else {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], $statusCode);
        }

    }

    public function resourceList(QueryRequest $request, string $modelClass) : JsonResponse
    {
        $data = $request->validated();
        $resources = $this->apiService->query($data, $modelClass);

        return $this->successResponse($resources);
    }

    public function OrderResourceList(QueryRequest $request, string $modelClass) : JsonResponse
    {
        $data = $request->validated();
        $resources = $this->apiService->orderQuery($data, $modelClass);

        return $this->successResponse($resources);
    }

    public function resourceSearch(QueryRequest $request, string $modelClass) : JsonResponse
    {
        $data = $request->validated();
        $resources = $this->apiService->search($data, $modelClass);

        return $this->successResponse($resources);
    }

    public function checkConnection(Request $request) : JsonResponse
    {
        try {
            $apiKey = $request->header("X-API-Key");
            $this->apiService->checkConnection($apiKey);
            return $this->successResponse("Connection successful");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function orderItems(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, OrderItem::class);
    }

    public function searchOrderItems(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, OrderItem::class);
    }

    public function searchCartItems(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, CartItem::class);
    }

    public function searchProducts(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, Product::class);
    }

    public function products(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, Product::class);
    }

    public function getProduct(Request $request) : JsonResponse
    {
        try {
            $product = $this->productService->findById($request->input('id'));
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getProductById(Request $request, $id) : JsonResponse
    {
        try {
            $product = $this->productService->findById($id);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateProduct(UpdateProductRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->updateProduct($data);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateProductById(UpdateProductRequest $request, $id) : JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->updateProduct($data);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function createProduct(CreateProductRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->createProduct($data);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteProductById(Request $request, $id) : JsonResponse
    {
        try {
            $this->productService->deleteProduct($id);
            return $this->successResponse("Product with ID $id has been deleted");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteProduct(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $this->productService->deleteProduct($id);
            return $this->successResponse("Product with ID $id has been deleted");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function productVariants(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, ProductVariant::class);
    }

    public function searchProductVariants(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, ProductVariant::class);
    }

    public function getProductVariant(Request $request) : JsonResponse
    {
        try {
            $product = $this->productService->getProductVariant($request->input('id'));
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getProductVariantById(Request $request, $id) : JsonResponse
    {
        try {
            $product = $this->productService->getProductVariant($id);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateProductVariant(UpdateProductVariantRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->updateProductVariant($data);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function createProductVariant(CreateProductRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->createProductVariant($data);
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteProductVariantById(Request $request, $id) : JsonResponse
    {
        try {
            $this->productService->deleteProductVariant($id);
            return $this->successResponse("Product with ID $id has been deleted");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteProductVariant(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $this->productService->deleteProductVariant($id);
            return $this->successResponse("Product with ID $id has been deleted");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function categories(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, Category::class);
    }

    public function searchCategories(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, Category::class);
    }

    public function createCategory(CreateCategoryRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $category = $this->categoryService->createCategory($data);
            return $this->successResponse($category);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCategoryById(Request $request, $id) : JsonResponse
    {
        try {
            $category = $this->categoryService->findById($id);
            return $this->successResponse($category);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCategory(Request $request) : JsonResponse
    {
        try {
            $category = $this->categoryService->findById($request->input('id'));
            return $this->successResponse($category);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateCategory(UpdateCategoryRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $category = $this->categoryService->updateCategory($data);
            return $this->successResponse($category);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteCategory(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $this->categoryService->deleteCategory($id);
            return $this->successResponse("Category with ID $id has been deleted");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteCategoryById(Request $request, $id) : JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($id);
            return $this->successResponse("Category with ID $id has been deleted");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function createUser(CreateUserRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $this->userService->createUser($data);
            return $this->successResponse($user);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function users(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, User::class);
    }

    public function searchUsers(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, User::class);
    }

    public function getUserById(Request $request, $id) : JsonResponse
    {
        try {
            $user = $this->userService->findById($id);
            return $this->successResponse($user);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getUser(Request $request) : JsonResponse
    {
        try {
            $user = $this->userService->findById($request->input('id'));
            return $this->successResponse($user);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateUser(UpdateUserRequest $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $user = $this->userService->updateUser($data);
            return $this->successResponse($user);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteUser(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('user');
            $this->userService->deleteUser($id);
            return $this->successResponse("User has ID $id deleted successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteUserById(Request $request, $id) : JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
            return $this->successResponse("User has ID $id deleted successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function stores(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, Store::class);
    }

    public function searchStores(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, Store::class);
    }

    public function getStore(Request $request) : JsonResponse
    {
        try {
            $store = $this->storeService->findById($request->input('id'));
            return $this->successResponse($store);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getStoreById(Request $request, $id) : JsonResponse
    {
        try {
            $store = $this->storeService->findById($id);
            return $this->successResponse($store);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateStore(Request $request, $id) : JsonResponse
    {
        try {
            $data = $request->validated();
            $store = $this->storeService->updateStore($data);
            return $this->successResponse($store);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateStoreById(Request $request, $id) : JsonResponse
    {
        try {
            $data = $request->validated();
            $store = $this->storeService->updateStore($data);
            return $this->successResponse($store);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function createStore(Request $request) : JsonResponse
    {
        try {
            $data = $request->validated();
            $store = $this->storeService->createStore($data);
            return $this->successResponse($store);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteStore(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $this->storeService->deleteStore($id);
            return $this->successResponse("Store has ID $id deleted successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteStoreById(Request $request, $id) : JsonResponse
    {
        try {
            $this->storeService->deleteStore($id);
            return $this->successResponse("Store has ID $id deleted successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCartItemsById(Request $request, $id) : JsonResponse
    {
        try {
            $cartItems = $this->cartService->getCartItems($id);
            return $this->successResponse($cartItems);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCartItems(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $cartItems = $this->cartService->getCartItems($id);
            return $this->successResponse($cartItems);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getCartItem(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $cartItems = $this->cartService->getCartItem($id);
            return $this->successResponse($cartItems);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function orders(QueryRequest $request) : JsonResponse
    {
        return $this->OrderResourceList($request, Order::class);
    }

    public function searchOrders(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, Order::class);
    }

    public function getOrderDetail(Request $request) : JsonResponse
    {
        try {
            $order = $this->orderService->getOrderDetail($request->input('id'));
            return $this->successResponse($order);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getOrder(Request $request) : JsonResponse
    {
        try {
            $order = $this->orderService->findById($request->input('id'));
            return $this->successResponse($order);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getOrderById(Request $request, $id) : JsonResponse
    {
        try {
            $order = $this->orderService->findById($id);
            return $this->successResponse($order);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function acceptOrder(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $this->orderService->transformOrder($id, 'done');
            return $this->successResponse("Order has ID $id processed successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function acceptOrderById(Request $request, $id) : JsonResponse
    {
        try {
            $this->orderService->transformOrder($id, 'done');
            return $this->successResponse("Order has ID $id processed successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function rejectOrder(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $this->orderService->rejectOrder($id);
            return $this->successResponse("Order has ID $id rejected successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function rejectOrderById(Request $request, $id) : JsonResponse
    {
        try {
            $this->orderService->rejectOrder($id);
            return $this->successResponse("Order has ID $id rejected successfully");
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function rejectedOrders(Request $request) : JsonResponse
    {
        try {
            $perPage = $request->query('per_page');
            $page = $request->query('page');
            $rejectedOrders = $this->orderService->pagination(['status' => 'cancel'], $perPage, $page);
            return $this->successResponse($rejectedOrders);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function acceptedOrders(Request $request) : JsonResponse
    {
        try {
            $perPage = $request->query('per_page');
            $page = $request->query('page');
            $acceptedOrders = $this->orderService->pagination(['status' => 'done'], $perPage, $page);
            return $this->successResponse($acceptedOrders);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getOrderItems(Request $request) : JsonResponse
    {
        try {
            $id = $request->input('id');
            $rejectedOrders = $this->orderService->getOrderItems($id);
            return $this->successResponse($rejectedOrders);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getOrderItemsById(Request $request, $id) : JsonResponse
    {
        try {
            $rejectedOrders = $this->orderService->getOrderItems($id);
            return $this->successResponse($rejectedOrders);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getOrderItem(Request $request) : JsonResponse
    {
        try {
            $rejectedOrders = $this->orderService->getOrderItem($request->input('id'));
            return $this->successResponse($rejectedOrders);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getUserAddressById(Request $request, $id) : JsonResponse
    {
        try {
            $order = $this->userService->getUserAddress($id);
            return $this->successResponse($order);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getUserAddress(Request $request) : JsonResponse
    {
        try {
            $order = $this->userService->getUserAddress($request->input('id'));
            return $this->successResponse($order);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function searchPaymentModes(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, PaymentMode::class);
    }

    public function paymentModes(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, PaymentMode::class);
    }

    public function getPaymentModeById(Request $request, $id)
    {
        try {
            $paymentMode =$this->orderService->getPaymentModeById($id);
            return $this->successResponse($paymentMode);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getPaymentMode(Request $request)
    {
        try {
            $paymentMode =$this->orderService->getPaymentModeById($request->input('id'));
            return $this->successResponse($paymentMode);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getPaymentModeByName(Request $request)
    {
        try {
            $paymentMode =$this->orderService->getPaymentModeByName($request->input('name'));
            return $this->successResponse($paymentMode);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function searchTaxes(QueryRequest $request) : JsonResponse
    {
        return $this->resourceSearch($request, Tax::class);
    }

    public function taxes(QueryRequest $request) : JsonResponse
    {
        return $this->resourceList($request, Tax::class);
    }

    public function getTax(Request $request) : JsonResponse
    {
        try {
            $tax = $this->taxService->findById($request->input('id'));
            return $this->successResponse($tax);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function getTaxById(Request $request, $id) : JsonResponse
    {
        try {
            $tax = $this->taxService->findById($id);
            return $this->successResponse($tax);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}

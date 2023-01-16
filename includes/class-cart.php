<?php

class Cart
{
    public function __construct()
    {
        // constructor method, nothing to do here
    }

    /**
     * Retrieve and iterate through products in the cart
     *
     * @return array $list - an array of product data
     */
    public function getCartProducts()
    {
        $list = [];
        if (isset($_SESSION['cart'])) {
            $products_obj = new Products();
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $product = $products_obj->findProduct($product_id);
                $list[] = [
                    'id' => $product_id,
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'total' => $product['price'] * $quantity,
                    'quantity' => $quantity
                ];
            }
        }
        return $list;
    }

    /**
     * List all products in the cart
     *
     * @return array $list - an array of product data
     */
    public function listAllProductsinCart()
    {
        return $this->getCartProducts();
    }

    /**
     * Calculate the total value of products in the cart
     *
     * @return int $cart_total - the total value of products in the cart
     */
    public function total()
    {
        $cart_total = 0;
        foreach ($this->getCartProducts() as $product) {
            $cart_total += $product['total'];
        }
        return $cart_total;
    }

    /**
     * Add a product to the cart
     *
     * @param int $product_id - the ID of the product to add
     */
    public function add($product_id)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] += 1;
        } else {
            $_SESSION['cart'][$product_id] = 1;
        }
    }

    /**
     * Remove a product from the cart
     *
     * @param int $product_id - the ID of the product to remove
     */
    public function removeProductFromCart($product_id)
    {
        if (isset($_SESSION['cart'][$product_id])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    /**
     * Empty the cart
     */
    public function emptyCart()
    {
        unset($_SESSION['cart']);
    }
}

<?php

use App\Models\Product;

//Price To Tax or VAT Function
if (!function_exists('calculateTaxFromPrice')) {
  function calculateTaxFromPrice($price, $taxValue)
  {
    $tax = $price * ($taxValue / 100);
    return $tax;
  }
}
//Price To Tax or VAT Function

// Tax or VAT to Price Function
if (!function_exists('calculatePriceFromTax')) {
  function calculatePriceFromTax($price, $taxValue)
  {
    if ($price != 0) {
      $priceBeforeTax = ($taxValue * 100) / $price;
    } else {
      $priceBeforeTax = 0;
    }
    return $priceBeforeTax;
  }
}
// Tax or VAT to Price Function



// Percentage to Price Function
if (!function_exists('discountToProduct')) {
  function discountToProduct($price, $discountValue)
  {
    $discount = $discountValue / 100 * $price;
    return $discount;
  }
}
// Percentage to Price Function

// Price to Percentage Function
if (!function_exists('productToDiscount')) {
  function productToDiscount($price, $discountValue)
  {
    if ($price != 0) {
      $discountPercent = ($discountValue * 100) / $price;
    } else {
      $discountPercent = 0;
    }
    return $discountPercent;
  }
}

// Price to Percentage Function



// Product Code Generate Function
if (!function_exists('getProductCode')) {
  function getProductCode()
  {
    $code = rand(1000000000, 9999999999);
    // Ensure uniqueness
    while (Product::where('product_code', $code)->exists()) {
      $code = rand(1000000000, 9999999999);
    }
    return $code;
  }
}
// Product Code Generate Function


// Product Count with Category Function
if (!function_exists('getProductCategory')) {
  function getProductCategory($categoryID)
  {
    $productWithCategory = Product::where('category_id', $categoryID)->count();
    return $productWithCategory;
  }
}
// Product Count with Category Function



// Product Count with Brand Function
if (!function_exists('getProductBrand')) {
  function getProductBrand($brandID)
  {
    $productWithBrand = Product::where('brand_id', $brandID)->count();
    return $productWithBrand;
  }
}
// Product Count with Brand Function


// Order Number Generate Function
if (!function_exists('getOrderCode')) {
  function getOrderCode()
  {
    $latestOrder = \App\Models\Order::orderBy('id', 'desc')->first();
    $orderID = $latestOrder ? $latestOrder->id + 1 : 1;
    return str_pad($orderID, 5, '0', STR_PAD_LEFT);
  }
}
// Order Number Generate Function

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $fillable = ['title', 'slug', 'summary', 'description', 'cat_id', 'cat_name', 'child_cat_id', 'child_cat_name', 'price', 'brand_id', 'brand_name', 'discount', 'status', 'photo', 'size', 'stock', 'is_featured', 'is_trending', 'condition'];

    public function cat_info()
    {
        return $this->hasOne('App\Models\Category', 'id', 'cat_id');
    }
    public function sub_cat_info()
    {
        return $this->hasOne('App\Models\Category', 'id', 'child_cat_id');
    }
    public static function getAllProduct()
    {
        return Product::with(['cat_info', 'sub_cat_info'])->orderBy('id', 'desc')->paginate(10);
    }
    public function rel_prods()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status', 'active')->orderBy('id', 'DESC')->limit(8);
    }
    public function getReview()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')->with('user_info')->where('status', 'active')->orderBy('id', 'DESC');
    }
    public static function getProductBySlug($slug)
    {
        return Product::with(['cat_info', 'rel_prods', 'getReview'])->where('slug', $slug)->first();
    }
    public static function countActiveProduct()
    {
        $data = Product::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    // In Product.php model
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            // Set category name
            if ($product->cat_id) {
                $category = Category::find($product->cat_id);
                $product->cat_name = $category ? $category->title : null;
            }

            // Set child category name
            if ($product->child_cat_id) {
                $childCategory = Category::find($product->child_cat_id);
                $product->child_cat_name = $childCategory ? $childCategory->title : null;
            }

            // Set brand name
            if ($product->brand_id) {
                $brand = Brand::find($product->brand_id);
                $product->brand_name = $brand ? $brand->title : null;
            }
        });

        static::saving(function ($product) {
            // ALWAYS update category name (even if cat_id hasn't changed)
            // This ensures the name stays in sync if the category title changes
            if ($product->cat_id) {
                $category = Category::find($product->cat_id);
                $product->cat_name = $category ? $category->title : null;
            } else {
                $product->cat_name = null;
            }

            // ALWAYS update child category name
            if ($product->child_cat_id) {
                $childCategory = Category::find($product->child_cat_id);
                $product->child_cat_name = $childCategory ? $childCategory->title : null;
            } else {
                $product->child_cat_name = null;
            }

            // ALWAYS update brand name
            if ($product->brand_id) {
                $brand = Brand::find($product->brand_id);
                $product->brand_name = $brand ? $brand->title : null;
            } else {
                $product->brand_name = null;
            }
        });
    }
}

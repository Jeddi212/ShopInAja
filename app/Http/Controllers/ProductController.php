<?php  
  
namespace App\Http\Controllers;  
  
use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Redis;  
  
class ProductController extends Controller  
{  
    // public function __construct()  
    // {  
    //     $this->middleware('auth');  
    // }
    
    public function create()  
    {  
        return view('products.create');
    }

    public function detailProduct(Request $req)
    {  

        // Get product, terus redirect ke viewnya
        $product = Redis::hgetall('product:'.$req['product_id']);
        $tags = Redis::sMembers('product:'.$req['product_id'].':tags');
        
        return view('products.detail')->with(['product' => $product, 'tags' => $tags]);

    }

    public function editProduct(Request $req)
    {  

        // Get product, terus redirect ke viewnya
        $product = Redis::hgetall('product:'.$req['product_id']);
        $getTags = Redis::sMembers('product:'.$req['product_id'].':tags');
        $tags = implode(',', $getTags);
        
        return view('products.edit')->with(['product' => $product, 'tags' => $tags]);

    }

    public function saveChanges(Request $request)
    {  
        
        $keys= $request->keys;
        $values= $request->values;
        $tags = explode(',',$request->get('tags'));
        $productId = $request['product_id'];

        $data = array();
        $data+=array('name' => $request->get('product_name'));
        $data+=array('image' => $request->get('product_image'));
        $data+=array('date_from' => $request->get('date_from'));
        $data+=array('product_id' => $productId);
        $data+=array('price' => $request->get('price'));

        // Untuk spesifikasi tambahan, namun yang dahulu kala
        foreach($request['productField'] as $key => $value) {
            if($keys != 'name' && $keys != 'image' && $keys != 'date_from' && $keys != 'product_id' && $keys != 'price'){
                $data+=array($key => $request->get($key));
            }
        }

        // Untuk spesifikasi baru
        $i=0;
        if(!empty($keys)) {
            foreach($keys as $key) {
                $data+=array($keys[$i] => $values[$i]);
                $i++;
            }
        }
        
        // Ambil tag yang baru dan unik
        $tagsBefore = explode(',',$request['tagsBefore']);
        $newTags = array_diff($tags, $tagsBefore);
    
        if(self::newProduct($productId, $data)){
            self::addToTags($newTags);
            self::addToProductTags($productId, $newTags);
            self::addProductToTags($productId, $newTags);
        }  

        return redirect()->route('product.details', ['product_id' => $productId]);

    }
      
    public function store(Request $request)  
    {  
        $keys= $request->keys;
        $values= $request->values;
        $tags = explode(',',$request->get('tags'));  
        $productId = self::getProductId();  

        $data = array();
        $data+=array('name' => $request->get('product_name'));
        $data+=array('image' => $request->get('product_image'));
        $data+=array('date_from' => $request->get('date_from'));
        $data+=array('product_id' => $productId);
        $data+=array('price' => $request->get('price'));
        $i=0;
        if(!empty($keys)) {
            foreach($keys as $key) {
                $data+=array($keys[$i] => $values[$i]);
                $i++;
            }
        }
    
        if(self::newProduct($productId, $data)){
            self::addToTags($tags);
            self::addToProductTags($productId, $tags);
            self::addProductToTags($productId, $tags);
        }  
        
        return redirect()->route('product.all');
    } 

    public function viewProducts(Request $request)  
    {  
        if($request->has('tag')){  
            $products = self::getProductByTags(($request->get('tag'))); 
            $status = "!home";
        } else {  
            $products = self::getProducts();  
            $status = "home";
        }  
        $tags = Redis::sMembers('tags');  
        
        return view('products.browse')->with(['products' => $products, 'tags' => $tags, 'status' => $status]);
    }

    public function delete($product_id)
    {
        // remove 1 value in products (zset) => zrem
        $is_success = Redis::zRem('products', $product_id);
        //remove 1 value in tags (set) =>srem
        $del_prod = 'product:'.$product_id;
        $del_tag = 'product:'.$product_id.':tags';
        Redis::del($del_prod);
        Redis::del($del_tag);

        return redirect()->route('product.all');
    }

    /*
    * Increment product ID every time
    * a new product is added, and return
    * the ID to be used in product object
    */
    static function getProductId()  
    {  
        if(!Redis::exists('product_count')) {
            Redis::set('product_count',0);
        }
        
        return Redis::incr('product_count');  
    }  
    
    /*
    * Create a hash map to hold a project object
    * e.g HMSET product:1 product "men jean" id 1 image "img-url.jpg" 
    * Then add the product ID to a list hold all products ID's
    */
    static function newProduct($productId, $data) : bool  
    {  
        self::addToProducts($productId);  
    
        return Redis::hMset("product:$productId", $data);  
    }  
    
    /*
    * A Ordered Set holding all products ID with the
    * PHP time() when the product was added as the score
    * This ensures products are listed in DESC when fetched
    */
    static function addToProducts($productId) : void  
    {  
        Redis::zAdd('products', time(), $productId);  
    } 
    
    /*
    * A unique Sets of tags
    */
    static function addToTags(array $tags)  
    {  
        Redis::sAddArray('tags',$tags);  
    }  
    
    /*
    * A unique set of tags for a particular product
    * eg SADD product:1:tags jean men pants 
    */
    static function addToProductTags($productId, $tags)  
    {  
        Redis::sAddArray("product:$productId:tags",$tags);  
    }  
    
    /*
    * A List of products carry this particular tag
    * ex1 RPUSH men 1 3
    * ex2 RPUSH women 2 4 
    */
    static function addProductToTags($productId, $tags)  
    {  
        foreach ($tags as $tag){  
            Redis::rPush($tag,$productId);  
        } 
    }  
    
/*  
* In a real live example, we will be returning 
* paginated data by calling the lRange command 
* lRange start end 
*/  
    static function getProducts($start = 0, $end = -1) : array  
    {  
        $productIds = Redis::zRange('products', $start, $end, true);  
        $products = [];  
    
        foreach ($productIds as $productId => $score) 
        {  
            $products[$score]= Redis::hGetAll("product:$productId");  
        } 
        
        return $products;  
    }

    static function getProductByTags($tag, $start = 0, $end = -1) : array  
    {  
        $productIds = Redis::lRange($tag, $start, $end);  
        $products = [];  

        foreach ($productIds as $productId) {  
            $products[] = Redis::hGetAll("product:$productId");  
        }  
        return $products;  
    }

}

<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryList = json_decode(file_get_contents("category.json"), true);

        // $parent = 1;
       
       


        foreach ($categoryList as $key => $category) {
            // echo $subCategory->sub . "\n";
            // echo $category["name"] . "\n";
            //  echo "$key \n";
             $categoryNew = new Category();

             $categoryNew->name =  $category["name"];
             $categoryNew->slug =  Str::slug($category["name"]); 
             $categoryNew->description =  "alabala";
             $categoryNew->save();
        
            if (isset($category["sub"])) {
                foreach ($category["sub"] as  $subCat) {
                    // echo $subCategory . "\n";
                    // echo "$key \n";

                    $subCategory = new Category();
                    $subCategory->name =  $subCat;
                    $subCategory->slug =  Str::slug($subCat); 
                    $subCategory->description =  "subCategory";
                    $subCategory->parent =  $categoryNew->id;
                    $subCategory->save();

                    
                }
            }
        }

        // print_r(glob("*"));
 
        // Category::factory()->count(10)->create(); 
    }
}

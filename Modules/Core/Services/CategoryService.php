<?php
namespace Modules\Core\Services;
// models
use Modules\Core\Models\Category;
use Modules\Core\Models\SubCategory;
use Modules\Core\Models\Skill;
// transformers
use Modules\Core\Transformers\CategoryTransformer;
use Modules\Core\Transformers\SubCategoryTransformer;
use Modules\Core\Transformers\SkillTransformer;

class CategoryService 
{

    public function getCategoryForDropdown(){
        $categories = Category::where('enable',1)->orderBy('name')->get();
        $categories->load('subCategory');
        return fractal($categories, new CategoryTransformer())->toArray();
    }

    public function getSubCategoryForDropdown(Array $categories){
        $categories = SubCategory::whereIn('category_id', $categories)->orderBy('name')->get();
        return fractal($categories, new SubCategoryTransformer())->toArray();
    }
}
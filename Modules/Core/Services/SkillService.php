<?php
namespace Modules\Core\Services;
// models
use Modules\Core\Models\Category;
use Modules\Core\Models\SubCategory;
use Modules\Core\Models\Skill;
use Modules\Core\Models\JobSkill;
// transformers
use Modules\Core\Transformers\CategoryTransformer;
use Modules\Core\Transformers\SubCategoryTransformer;
use Modules\Core\Transformers\SkillTransformer;

class SkillService 
{

    public function getSkillForDropdown(Array $categories){
        $skills = JobSkill::whereIn('sub_category_id', $categories)->get()->load('skill');
        return fractal($skills, new SkillTransformer())->toArray();
    }
}
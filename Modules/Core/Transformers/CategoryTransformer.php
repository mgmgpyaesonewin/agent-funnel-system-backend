<?php

namespace Modules\Core\Transformers;

use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'sub_categories'
    ];
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($item)
    {
        return [
            'value' => (integer) $item->id,
            'label' => (string) $item->name
        ];
    }
    /**
     * Undocumented function
     *
     * @param Stock $stock
     * @return void
     */
    public function includeSubCategories($category)
    {
        $categories = $category->subCategory;

        return $this->collection($categories, new SubCategoryTransformer);
    }
}

<?php

namespace Modules\Core\Transformers;

use League\Fractal\TransformerAbstract;

class SkillTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($item)
    {
        // dd($item->skill->id);
        return [
            'value' => (integer) $item->skill['id'],
            'label' => (string) $item->skill['name']
        ];
    }
}

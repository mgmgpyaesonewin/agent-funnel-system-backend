<?php

namespace Modules\Core\Transformers;

use League\Fractal\TransformerAbstract;

class IndustryTransformer extends TransformerAbstract
{
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
}

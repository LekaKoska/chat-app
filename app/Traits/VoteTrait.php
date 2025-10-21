<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
trait VoteTrait
{
    public function voting(Relation $modelWithRelation, string $column,  int $value): void
    {
        $existingVote = $modelWithRelation
            ->where('user_id', auth()->id())
            ->where($column, $modelWithRelation->getParent()->id)
            ->first();

        if ($existingVote) {
            if ($existingVote->vote === $value) {
                $existingVote->delete();
                return;
            }
        }

         $modelWithRelation->updateOrCreate([
            'user_id' => auth()->id(),
            $column => $modelWithRelation->getParent()->id,
           ],
             ['vote' => $value]
         );
    }
}

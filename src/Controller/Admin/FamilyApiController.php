<?php

namespace App\Controller\Admin;

use App\Entity\Family;
use App\Repository\FamilyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class FamilyApiController
{

    /**
     * @Route(
     *     name="book_special",
     *     path="/families/{id}/special",
     *     methods={"GET"},
     *     defaults={
     *         "_api_resource_class"=Family::class,
     *         "_api_item_operation_name"="special"
     *     }
     * )
     */
    public function special(Family $family)
    {
        return array('0' => 'yes','1'=>'No');
    }
}